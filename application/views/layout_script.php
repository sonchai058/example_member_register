<script>

  $.widget.bridge('uibutton', $.ui.button);
  $(document).ready(function(){

  });



  var Toast = null;
  $(function() {
    Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
  });


  var sweetAlert = function(txt,msg) {
    if(Toast==null) {
      Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
      });
    }
      if(txt=='success') {
        Toast.fire({
          icon: 'success',
          title: "&nbsp;&nbsp;"+msg
        });
      }else if(txt=='info') {
          Toast.fire({
            icon: 'info',
            title: "&nbsp;&nbsp;"+msg
          });
      }else if(txt=='danger') {
          Toast.fire({
            icon: 'error',
            title: "&nbsp;&nbsp;"+msg
          });
      }else if(txt=='warning') {
          Toast.fire({
            icon: 'warning',
            title: "&nbsp;&nbsp;"+msg
          });
      }else if(txt=='question') {
          Toast.fire({
            icon: 'question',
            title: "&nbsp;&nbsp;"+msg
          });
      }

    }

</script>