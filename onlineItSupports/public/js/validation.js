$(document).ready(function() {
  $validate1=function(){
      rules:{
           department:required
      },
      messages:{
        department:"fill department"
      },
      errorplacement:function($error,$element){

      }
  }
});
