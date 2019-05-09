$(document).ready(function() {
  $('.edit-modal').on('click', function(e) {
        $('.modal-title').text('Edit');
        $('#id_edit').val($(this).data('id'));
        $('#title_edit').val($(this).data('name'));
        $id = $('#id_edit').val();
        $('#editModal').modal('show');
    });
  $('.modal-footer').on('click', '.edit', function() {
     // $('.lol').validate( function(){rules:{
     //            department:"required"
     //       },
     //       messages:{
     //         department:"fill department"
     //       }
     //     });
     if($('#title_edit').val() !="" && $('#floor_edit').val() !="" && $('#direction_edit').val() != "" ){
      $.ajax({
          type: 'post',
          url: '/editDepartment',
          data: {
              'id': $("#id_edit").val(),
              'department': $('#title_edit').val(),
              'floor': $('#floor_edit').val(),
              'direction': $('#direction_edit').val()
          },
          success: function($data) {
            //swal('','successfully edit department','success');
            $('.item' + $data[0].id).replaceWith("<tr class='item" + $data[0].id + "'><td>" + $data[0].id + "</td><td>" + $data[0].departmentName + "</td><td>" + $data[0].flo + "</td> <td>" + $data[0].dir + "</td><td> <button class='edit-modal btn btn-info' data-id='" + $data[0].id + "' data-name='" +$data[0].departmentName + "' ><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + $data[0].id + "' data-name='" +$data[0].departmentName + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
          }
      });
    }
    else{
      swal("",'please Enter and select all required input',"warning");
    }
  });
  $('.add-modal').on('click', function(e) {
    $('.modal-title').text('Add');
    $('#addModal').modal('show');
});
$('.modal-footer').on('click', '.add', function() {
  if($('#title_add').val() !="" && $('#floor_edit').val() !="" && $('#direction_edit').val() != "" ){
    $.ajax({
        type: 'POST',
        url: '/addDepartment',
        data: {
            'department': $('#title_add').val(),
            'floor': $('#floor_add').val(),
            'direction': $('#direction_add').val()
        },
        success: function($data) {
          //swal('','successfully Added a department','success');
          $('#departmentTable').append("<tr class='item" + $data[0].id + "'><td>" + $data[0].id + "</td><td>" + $data[0].departmentName + "</td><td>" + $data[0].flo + "</td> <td>" + $data[0].dir + "</td><td><button class='edit-modal btn btn-info' data-id='" + $data[0].id + "' data-name='" +$data[0].departmentName + "' ><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" +
           $data[0].id + "' data-name='" +$data[0].departmentName + "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
        },
    });
  }
  else {
    swal("",'please Enter and select all required input',"warning");
  }
});

$('.delete-modal').on('click', function(e) {
          $('.modal-title').text('Delete');
          $('#id_delete').val($(this).data('id'));
          $('#title_delete').val($(this).data('name'));
          $('#deleteModal').modal('show');
          $id = $('#id_delete').val();
      });
$('.modal-footer').on('click', '.delete', function() {
  $.ajax({
      type: 'post',
      url: '/deleteDepartment',
      data: {
          'id':$id
      },
      success: function($data) {
          //swal('','successfully delete department','success');
          $('.item' + $data.id).remove();
      }
  });
});


});
