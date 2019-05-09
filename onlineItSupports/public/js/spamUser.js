$(document).ready(function() {
  $('#checkedAll').click(function(event) {
    $checked=$('#checkedAll').attr('checked');
    if(!$checked){
    $('#checkedAll').attr('checked', true);
  }
  else{
    $('#checkedAll').attr('checked', false);
  }
    if($('#checkedAll').attr('checked')){
        $('.checkbox').attr('checked', true);
    }else{
    $('.checkbox').attr('checked', false);
  }
  });
 $('#deleteSelected').click(function(event) {
   $length=$( "input:checked" ).length;
   $checked=$( "input:checked" )
   $checkedArray=[];
   $checkedIndex=0;
$checked.each(function(){
  if($(this).val()!="all"){
      $checkedArray[$checkedIndex]=$(this).val();
      $checkedIndex++;
  }
});
     $.ajax({
       type:'post',
       url:'/deleteSpamUser',
       data:{
          'checkedIdes':$checkedArray
           },
       success:function($data){
          for($i=0;$i<=$data.length-1;$i++){
             $('.item'+$data[$i]).remove();
          }
       }
     });
 });
});
