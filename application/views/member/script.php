<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "order": [[ 0, "desc" ]]
    });
    /*
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    */
  });

function editSave(id) {
  //alert("#form​Edit"+id+" input[name='member']"); 
  var chk = true;
  //protection
  if($("#myModalEdit"+id+" input[name='name']").val()=='') {
    sweetAlert('danger','กรุณากรอกข้อมูล ชื่อ ให้ถูกต้อง !');
    $("#myModalEdit"+id+" input[name='name']").focus();
    chk = false;
    return false;
  }
  if($("#myModalEdit"+id+" input[name='card_idnumber']").val()=='' || $("#myModalEdit"+id+" input[name='card_idnumber']").val().length!=13 || !isNumeric($("#myModalEdit"+id+" input[name='card_idnumber']").val())) {
    sweetAlert('danger','กรุณากรอกข้อมูล เลขประจำตัว ประชาชน ให้ถูกต้อง !');
    $("#myModalEdit"+id+" input[name='card_idnumber']").focus();
    chk = false;
    return false;
  }

  if(chk) {
      //protection
      $.ajax({
      type: "POST",
      url: '<?php echo base_url('member/update');?>',
      data: $("#formEdit"+id).serialize(), // serializes the form's elements.
      success: function(data)
      {
        
        if(data.status=='success') {
          sweetAlert('success',data.message);
          location.reload();
        }else {
          sweetAlert('danger',data.message);
          //$("#myModal0").modal("toggle");
        }
      }
    });
      //console.log($("#formAdd").serialize());
      //alert('saved!');
  }
}

$("#bt_addSubmit").click(function(){
  var chk = true;
  //protection
  if($("#formAdd input[name='name']").val().length<1) {
    sweetAlert('danger','กรุณากรอกข้อมูล ชื่อ ให้ถูกต้อง !');
    $("#formAdd input[name='name']").focus();
    chk = false;
    return false;
  }
  if($("#formAdd input[name='card_idnumber']").val()=='' || $("#formAdd input[name='card_idnumber']").val().length!=13 || !isNumeric($("#formAdd input[name='card_idnumber']").val())) {
    sweetAlert('danger','กรุณากรอกข้อมูล เลขประจำตัว ประชาชน ให้ถูกต้อง !');
    $("#formAdd input[name='card_idnumber']").focus();
    chk = false;
    return false;
  }


  if(chk) {
      //protection
      $.ajax({
      type: "POST",
      url: '<?php echo base_url('member/save');?>',
      data: $("#formAdd").serialize(), // serializes the form's elements.
      success: function(data)
      {
        
        if(data.status=='success') {
          sweetAlert('success',data.message);
          
          socket.emit('noti message',data.rs);

          location.reload();
        }else {
          sweetAlert('danger',data.message);
          //$("#myModal0").modal("toggle");
        }
      }
    });
      //console.log($("#formAdd").serialize());
      //alert('saved!');
  }
});

function dlt(id) {
  $.ajax({
      type: "POST",
      url: '<?php echo base_url('member/delete');?>',
      data: 'id='+id, // serializes the form's elements.
      success: function(data)
      {
        //alert(data.message);
        if(data.status=='success') {
          sweetAlert('success',data.message);
          location.reload();
        }else {
          sweetAlert('danger',data.message);
          //$("#myModal0").modal("toggle");
        }
      }
    });
}

function isNumeric(str) {
  if (typeof str != "string") return false // we only process strings!  
  return !isNaN(str) && // use type coercion to parse the _entirety_ of the string (`parseFloat` alone does not do this)...
        !isNaN(parseFloat(str)) // ...and ensure strings of whitespace fail
}

socket.on('new message', function(msg) {
  console.log("new message!");
  update(msg);
});

function update(msg) {
  if(msg.length) {
    $('#example1').DataTable().destroy();
      var c = "even";
    if($("#example1 tbody tr:last-child").hasClass("odd")) {
      c = "odd";
    }

   $('#example1').find('tbody').prepend('<tr class="'+c+'"><td class="dtr-control" tabindex="0">'+msg[0].id+'</td><td align="center" class="sorting_1">'+msg[0].card_idnumber+'</td><td>'+msg[0].title_name+'</td><td>'+msg[0].name+'</td><td>'+msg[0].lastname+'</td><td align="center">'+msg[0].telno+'</td><td align="center">'+msg[0].date_ofbirth.substr(8,2)+'/'+msg[0].date_ofbirth.substr(5,2)+'/'+msg[0].date_ofbirth.substr(0,4)+'</td><td align="center">'+msg[0].idhouse+'</td><td align="center">'+msg[0].mod_date.substr(8,2)+'/'+msg[0].mod_date.substr(5,2)+'/'+msg[0].mod_date.substr(0,4)+msg[0].mod_date.substr(10,5)+'<br/>'+msg[0].mod_user+'</td></tr>');
   
   $("#example1").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "order": [[ 0, "desc" ]]
    }).draw();
  }
}

</script>


