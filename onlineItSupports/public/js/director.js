$(document).ready(function(){
// $('.sc').scroll(function(ev){
//      $x=$(this).scrollTop();
//      if($x>=410){
//        //alert($x);
//      }
//
// });

	$('.approve').on('click',function(e){
	$id=$(this).data('id');
  $role=$(this).data('role');
  $team=$('#Eteam-'+$id).val();
  if($role==2 && $team==null){
    swal("","please select the team of the administrator...","warning");
  }
  else{
    	$.ajax({
            type:'post',
            url:'/approve',
            data:{
            	'id':$id,
              'team':$team
            },
            success:function($data){
              swal("","successfully Approve", "success");
              $('#employee'+$id).remove();
              //$('#employee'+$id).replaceWith('<tr id="employee{{$req->id}}"> <td colspan="3"><p class="alert alert-success" role="alert">' +$data.firstName+" "+$data.middleName+" is successfully approved,he/she can login" +'</p></td></tr>');
            }

    	});
   }
   });
	$('.cancel').on('click',function(e){
	$id=$(this).data('id');
	$.ajax({
        type:'post',
        url:'/cancel',
        data:{
        	'id':$id
        },
        success:function($data){
					alert($data);
          // swal("","successfully Cancel ", "error");
          // $('#employee'+$data.id).remove();
    //$('#employee'+$data.id).replaceWith('<tr id="employee{{$req->id}}"> <td colspan="3"><p class="alert alert-danger" role="alert">' +$data.firstName+" "+$data.middleName+" is successfully cancel..." +'</p></td></tr>');
  }
	});
});

  $('.assign').on('click',function(e){

      $id=$(this).data('id');
      $team=$('#Rteam-'+$id).val();
      $admin=$('#admin-'+$id).val();
      if($team || $admin){
        $.ajax({
              type:'post',
              url:'/assign',
              data:{
                'id':$id,
                'team':$team,
                'admin':$admin
              },
              success:function($data){
                swal("","successfully assign", "success");
               $('#select-'+$id).replaceWith('<span>this is assigned to'+$data.team+"  "+ $data.firstName+ " "+$data.middleName+'</span>');

              }
            });
      }
      else{
        swal("","please assign adiminstrator,Team or both!!", "warning");
        //alert("please assign adiminstrator,Team or both!!!");
      }
   });

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
