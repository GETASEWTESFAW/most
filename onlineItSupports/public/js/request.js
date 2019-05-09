$(document).ready(function() {
  $('.delete-request').click(function(event) {
   $id=$(this).data('id');
   $.ajax({
        type:'post',
        url:'/deleteRequest',
        data:{
          'id':$id
        },
        success:function($data){
           $('.item'+$id).remove();
        }

    });
  });
});
