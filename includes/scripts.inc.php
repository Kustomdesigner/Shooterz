
<script type="text/javascript">

/*==========================================
    CHAT BOX SCRIPT
===========================================*/  
  var $s = jQuery.noConflict();
  $s('chatForm').on('submit', function(e){
      console.log('submitted');
      e.preventDefault();

  });

/*====================================================================
    CHATBOX SUBMIT MESSAGE WITH ENTER BUTTON
/*===================================================================*/

function enterMessage() {
  //createfunction to enter message when enter is pressed
  //must trigger same button that is clicked
  var $j = jQuery.noConflict();
}

/*==========================================
    SHOT CUP SCRIPT
===========================================*/    

//hit Shift then press ctrl to increase shot count
//USB teensy controller hooked into event
	
var $j = jQuery.noConflict(),
score = 0;

$j(document).on('keydown', function(event) {       
  if( event.which === 17 && event.shiftKey ) {         
     $j(".my-score").text(++score);
    }
}); 
  

/*==========================================
      SCRIPT
===========================================*/  


</script>