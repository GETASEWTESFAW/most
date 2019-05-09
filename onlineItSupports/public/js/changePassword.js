$(document).ready(function() {
  $('#change-password').on('click',function(e){
    $password=$('#password').val();
    $cpassword=$('#cpassword').val();
    if($password===$cpassword){
    $.ajax({
         type:'post',
         url:'/passwordchg',
         data:{
            'password':$password
         },
         success:function($data){

           swal("","successfully Approve", "success");
           $password=$('#password').val("");
           $cpassword=$('#cpassword').val("");
         }
    });
  }
  else{
    swal("","conformation error","error" );
  }
  });
});
