$(document).ready(function() {
  $('.done-button').on('click',function(e){
  $id=$(this).data('id');
  $done=2;
  $.ajax({
        type:'post',
        url:'/done',
        data:{
          'id':$id,
          'status':$done
        },
        success:function($data){

                  $('#request-'+$id).remove();
                  // $('#done-'+$id).attr({
                  //    "class":"btn btn-success notdone",
                  //    "style":"margin-left: 4px",
                    //  "id":"notdone-"+$id
                  //});

                     }

  });
});


  $('#commentModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;
    $("#modal-comment").text(" ");
    var id = button.data('id');
     var title=$("#title-"+id).text();
     var body=$("#body-"+id).text();
     $("#id").val(id);
    $("#comment").val("");
    var modal = $(this)
    modal.find('#title').text(title)
    modal.find('#body').text(body);
  });
  $('#modal-send').on('click',function(e){

    var comment=$("#modal-comment").val();
    var id=$("#id").val();
     $.ajax({
        type:'post',
        url:'/comment',
        data:{
          'id':id,
          'comment':comment
        },
        success:function($data){

        }


  });
});
});
