$(document).ready(function() {
   $hosts=$(location).attr('host');
   $protocol=$(location).attr('protocol');
  setInterval(
    function(){
        $.post('/notification',{addedvar : 'anycontent'},function($data,$status,$req){
           $('.totalNotification').text(""+$data.length);
           $li="";
           for($i=0;$i<=$data.length-1;$i++){
             $li+='<li><a href="'+$protocol+'//'+$hosts+'/readNotification/'+$data[$i]['id']+'"><div class="">sender:'+$data[$i]['data']['firstName']+" "+$data[$i]['data']['middleName']+
             '</div><div class="title"> Request Type:'+$data[$i]['data']['requestTitle']+
             '</div><div class="message"> Message:'+$data[$i]['data']['requestMessage']+
             '</div><div class="date">date:'+$data[$i]['data']['sendTime']['date']+'</div></a></li>';
           }
           $('#notificationMenu').html($li);
        });
  },5000);
});
