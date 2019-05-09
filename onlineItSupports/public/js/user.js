$(document).ready(function() {

  $('.delete-user').click(function(event) {
   $id=$(this).data('id');
   $.ajax({
        type:'post',
        url:'/deleteUser',
        data:{
          'id':$id
        },
        success:function($data){
          $('.item'+$id).remove();
        }

    });
  });
});
