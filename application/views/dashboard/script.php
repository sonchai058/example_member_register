<script>
var reader_name = JSON.parse('<?php echo json_encode($reader_name);?>');
var table = null;      
$(document).ready(function(){
  /*
  table = $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "order": [[ 1, "desc" ]],
      "searching": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    */
    table = $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "order": [[ 1, "desc" ]],
      "searching": false,
    });


   //init();
   update(null);



});



var data = <?php echo json_encode($dataListTable);?>;
//console.log(data);
$(function () {
    function newData(newVal) {
        data = data.slice(1);
        data.push(newVal);
                // Zip the generated y values with the x values
        var res = [];
        for (var i = 0; i < data.length; ++i) {
            res.push([i, data[i]]);
        }
        return res;
    }
    socket.on('new_data', function(msg) {
        console.log('new message data update '+msg);
        // console.log(msg);
        // console.log(msg.database);
        // console.log(msg.fields);
        sweetAlert('info','New data.');
        //newData(msg);
        update(msg.fields);
        //location.reload();
    });
    //socket.on('request_data', function(msg) {
    //    console.log(msg);
        //newData(msg);
   // });

});
function update(soket_row) {
  //console.log(soket_row.reader_id);
  if(soket_row!=null){
    $('#example1').DataTable().destroy();
    var c = "even";
    if($("#example1 tbody tr:last-child").hasClass("odd")) {
      c = "odd";
    }
    var reader_str = soket_row.reader_id;
    $.each(reader_name, function( index, value ) {
      if(value.reader_id==soket_row.reader_id) {
        reader_str = reader_str+'<br/>'+value.reader_name;
      }
    });

    $('#example1').find('tbody').prepend('<tr class="'+c+'"><td class="dtr-control" tabindex="0">'+soket_row.log_date.substr(8,2)+'/'+soket_row.log_date.substr(5,2)+'/'+soket_row.log_date.substr(0,4)+'</td><td align="center" class="sorting_1">'+soket_row.trans_code+'</td><td align="center">'+soket_row.trans_type+'</td><td align="center">'+soket_row.refid+'</td><td align="center">'+reader_str+'</td><td>'+soket_row.amount.toFixed(0)+'</td><td>'+soket_row.balance.toFixed(0)+'</td><td align="center">'+soket_row.sys_ref_code+'</td><td align="center">'+soket_row.timestamp.substr(8,2)+'/'+soket_row.timestamp.substr(5,2)+'/'+soket_row.timestamp.substr(0,4)+soket_row.timestamp.substr(10,5)+'</td><td align="center">'+soket_row.api_result+'</td></tr>');
    $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "order": [[ 1, "desc" ]],
        "searching": false,
    }).draw();
  }

    $.ajax({
      type: "POST",
      url: '<?php echo base_url('welcome/ajax_data');?>',
      data: '', // serializes the form's elements.
      success: function(data)
      {
        //alert(data.message);
        //console.log(data);
        if(data.status=='success') {
         // sweetAlert('info','New');
          //location.reload();
          $("#head_00").html(data.rs.head_00); $("#head_01").html(data.rs.head_01);
          $("#head_10").html(data.rs.head_10); $("#head_11").html(data.rs.head_11);
          
          $(".headList").html("");
          var html = "";
          //console.log(data.rs.arrHeadlist);
          $.each(data.rs.arrHeadlist, function( index, value ) {
            html+='<tr><td align="center">'+index+'</td><td align="">'+value[0]+'</td><td align="">'+value[1]+'</td><td align="">'+value[4]+'</td><td align="">'+value[2]+'</td><td align="">'+value[3]+'</td></tr>';
          });
          $(".headList").html(html);

          /*
          $(".node0_0").html('เข้า ' +data.rs.node0.ADD+' บาท');
          $(".node0_1").html('ออก ' +data.rs.node0.PAY+' บาท');

          $(".node1_0").html('จำนวน ' +data.rs.node1.cnt+' ครั้ง');
          $(".node1_1").html('เติม/ตัด ' +data.rs.node1.ADD+'/'+data.rs.node1.PAY+' บาท');
          */

          $(".ListItem").remove();
          var html = "";
          $(".DataList").html("");
          $.each(data.rs.dataList, function( index, value ) {
            html+='<div class="col-lg-3 col-6 ListItem"><div class="small-box bg-gradient-warning"><div class="inner"><p style="font-weight:bold; ">'+value.are_name+'</p><h6 id="0">จำนวน '+Math.abs(value.cnt).toFixed(0)+' ครั้ง</h6><h6 id="">ยอดเงิน '+Math.abs(value.balance_sum).toFixed(0)+' บาท</h6></div><div class="icon"><i class="fas fa-torii-gate"></i></div></div></div>';
            //console.log(html);
            $(".DataList").html(html);
          });
          

        }else {
          //sweetAlert('danger',data.message);
          //$("#myModal0").modal("toggle");
        }
      }
    });
}

$(document).on('keypress',function(e) {
    if(e.which == 13) {
        return false;
    }
});

</script>