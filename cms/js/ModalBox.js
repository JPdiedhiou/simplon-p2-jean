$(document).ready(function(e)
{

    $(".close").click(function(e)
   {
   	console.log('click');
      $(".bkgr , .Mymodal").hide();
     
   });

    $("#liste-emp").click(function()
       {
          console.log('click');
          $("#read-emp").fadeIn(3000);
         
       });

});