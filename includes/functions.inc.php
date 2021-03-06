<?php
/*========================================================================
			Sticky Forms Function
=========================================================================*/
 
 function old($key) {
  	if ( !empty($_REQUEST[$key]) ) {
  		return htmlspecialchars($_REQUEST[$key], ENT_QUOTES, 'UTF-8');
  	}
  	return '';
 }

/*========================================================================
			Uses Built In PHP Email Validation Function
=========================================================================*/
 
 function valid_email($email) {
  	return filter_var($email, FILTER_VALIDATE_EMAIL);
 }

/*========================================================================
      XSS Protection Filter Function
=========================================================================*/

function htmlEncode($input) {
   $input = strip_tags($input);
   return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}

/*========================================================================
			Add registered Users To Mailing_list.php
=========================================================================*/

function add_registered_user($username, $email, $pass) { 
	$order = "username: " .  $username . "\n" . "Email: " .  $email . "\n" . "Password: " .  $pass . "\n\n" ;
    file_put_contents('mailing_list.php', "$order\n", FILE_APPEND);
}

/*========================================================================
			Redirect Function
=========================================================================*/

function redirect_user($location) {
	 $redirect = "<script type='text/javascript'>
      window.location = '$location.php';
      </script>";
   echo $redirect;
}

/*========================================================================
		CHECK DATABASE FOR MATCHING USERNAME AND PASS
=========================================================================*/

function validate_login($login_name, $login_pass) {
 $config['db'] = array(           
    'host'     => 'localhost',  
    'username' => 'root',       
    'password' => '',
    'dbname'   => 'registered_users',
  );
  //CONNECT TO DATABASE
  $conn = new PDO('mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'], 
    $config['db']['username'], $config['db']['password']);
 
  $sql = ("SELECT COUNT(*) FROM players WHERE player_name=:name AND player_password=:pword");
  
  $stmt = $conn->prepare($sql);
  
  $stmt->bindValue(":name", $login_name);
  $stmt->bindValue(":pword", $login_pass);
  $stmt->execute();

  $count = $stmt->fetchColumn();
  
    if ($count > 0) {

    redirect_user(redirect_player);
      
    } else {
      echo "<div class='wrong'>";
      echo " * ". "Incorrect username or password";  
    } echo "</div>";
    
  $stmt->closeCursor();

}

/*========================================================================
      ADD PLAYER TO THE DATABASE
=========================================================================*/

function add_player ($ap_username, $ap_pass, $ap_email) {

  $config['db'] = array(           
    'host'     => 'localhost',  
    'username' => 'root',       
    'password' => '',
    'dbname'   => 'registered_users',
  );

  //CONNECT TO DATABASE
  try {
    $conn = new PDO('mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'], 
        $config['db']['username'], $config['db']['password']);
  } catch (PDOException $e) {
    redirect_user(404);
    //echo $e->getMessage();
  }

  $sql  = "INSERT INTO PLAYERS (player_name, player_password, player_email) 
          VALUES (?, ?, ?)";
  $db = $conn->prepare($sql);

  $db->bindParam(1, $username);
  $db->bindParam(2, $pass);
  $db->bindParam(3, $email);

  $username = $ap_username; 
  $pass     = $ap_pass; 
  $email    = $ap_email; 
        
  $db->execute();
  $db->closeCursor();

}

/*========================================================================
			GAME UI FUNCTION 
=========================================================================*/
function add_gameui() {

    echo "<div class='game-ui'>";
    
    echo      "<p class='game-title'>Shot Count</p>";
    echo      "<p class='my-score'>0</p>";
    echo      "<button id=minus class='minus'style=font-size:18px;>-</button>";     
     echo      "<button id=plus class='plus' style=font-size:18px;>+</button>";    
    echo      "<p class='counter'>Reset Counter</p>";
    
    echo  "</div>";
}
/*========================================================================
      SESSION FUNCTIONS
=========================================================================*/

function session_connect() {
  if(isset($_POST['sendlogin'])) {
    session_start();
  }
}
function session_good() {
  $_SESSION['authenticated'] = "validConnection";
  session_regenerate_id();
}
function session_bad() {
  //create a dedicated login page
  
  //let user know what is going on

  //redirect user to a dedicated login page
}












?>





