$(document).ready(function() {
  $('.edit-modal').on('click', function(e) {
        $('.modal-title').text('Edit');
        $('#id_edit').val($(this).data('id'));
        $('#title_edit').val($(this).data('title'));
        $id = $('#id_edit').val();
        $('#editModal').modal('show');
    });
  $('.modal-footer').on('click', '.edit', function() {
   if($('#title_edit').val() !="" && $('#id_edit').val() !=""){
      $.ajax({
          type: 'post',
          url: '/editTeam',
          data: {
              'id': $("#id_edit").val(),
              'team': $('#title_edit').val()
          },
          success: function($data) {
            //swal('','successfully edit floor','success');
                        $('.item' + $data[0].id).replaceWith("<tr class='item" + $data[0].id + "'><td>" + $data[0].id + "</td><td>" + $data[0].teamName + "</td><td> <button class='edit-modal btn btn-info' data-id='" + $data[0].id + "' data-title='" + $data[0].teamName + "' ><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + $data[0].id + "' data-title='" + $data[0].teamName + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
          }
      });
    }else{
      swal("",'please Enter and select all required input',"warning");
    }
  });
  $('.add-modal').on('click', function(e) {
    $('.modal-title').text('Add');
    $('#addModal').modal('show');
});
$('.modal-footer').on('click', '.add', function() {
   if($('#title_add').val() !=""){
    $.ajax({
        type: 'POST',
        url: '/addTeam',
        data: {
            'team': $('#title_add').val()
        },
        success: function($data) {
          //swal('','successfully Added a floor','success');
            $('#teamTable').append("<tr class='item" + $data[0].id + "'><td>" + $data[0].id + "</td><td>" + $data[0].teamName + "</td> <td><button class='edit-modal btn btn-info' data-id='" + $data[0].id + "' data-title='" + $data[0].teamName + "' ><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" +
             $data[0].id + "' data-title='" + $data[0].teamName + "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
        },
    });
  }else{
    swal("",'please Enter and select all required input',"warning");
  }
});

$('.delete-modal').on('click', function(e) {
          $('.modal-title').text('Delete');
          $('#id_delete').val($(this).data('id'));
          $('#title_delete').val($(this).data('title'));
          $('#deleteModal').modal('show');
          $id = $('#id_delete').val();
      });
$('.modal-footer').on('click', '.delete', function() {

  $.ajax({
      type: 'post',
      url: '/deleteTeam',
      data: {
          'id':$id
      },
      success: function($data) {
          //swal('','successfully delete floor','success');
          $('.item' + $data.id).remove();
      }
  });
});


});
