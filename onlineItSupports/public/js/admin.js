$(document).ready(function() {

  setInterval(function(){
    $.ajax({
         type:'post',
         url:'/count',
         data:{
           'addedvar' : 'anycontent'
         },
        success:function($data){
         $('#done-year').text($data.year);
         $('#done-month').text($data.month);
         $('#done-yourself').text($data.yourself);
         $('#done-withteam').text($data.withteam);
         $('#done-total').text($data.total);
        }

    });},5000
  );
  $('#senderModal').on('show.bs.modal', function (event) {

    $('.senderAddress').text("");
      $button = $(event.relatedTarget) ;
        $sender= $button.data('sender');
       $.ajax({
          type:'post',
          url:'/sender',
          dataType:'json',
          data:{
            'sender':$sender
          },
          success:function($data){
            $('#name').text("Name: "+$data[0].firstName+" "+$data[0].middleName);
            $('#dep').text("Department: "+$data[0].department);
            $('#floor').text("Floor: "+$data[0].floor);
            $('#dir').text("Direction: "+$data[0].direction);
          }

      });
  });

  $('#feedbackModal').on('show.bs.modal', function (event) {
    $('#feedback').text("");
      $button = $(event.relatedTarget) ;
          $id= $button.data('id');
          $.ajax({
            type:'post',
            url:'/feedback',
            dataType:'json',
            data:{
              'id':$id
            },
            success:function($data){
              $('#feedback').text($data.feedback);
            }
           });
  });
});
