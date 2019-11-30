<?php
require_once('connect.php');
?>
<!DOCTYPE html>
<html>
	<head>
	

	</head>
<body>
	
<?php
require_once("connect.php");
session_start();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="logstyle.css" />
    <title>SuperFast ISP</title>
  </head>

  <body>
    <div
      class="d-flex justify-content-center align-items-center login-container"
	>

      <form action="forgot_password.php" method="post" class="login-form text-center" enctype="multipart/form-data">
        <h1 class="mb-5 font-weight-light text-uppercase">Reset Password</h1>
        <div class="form-group">
          <input
			type="text"
			name="username"
            class="form-control rounded-pill form-control-lg"
            placeholder="Username"
          />
    </div>
    <div class="form-group">
          <input
			type="email"
			name="email"
            class="form-control rounded-pill form-control-lg"
            placeholder="Email Address"
          />
</div>
		<div class="form-group">
          <input
			type="password"
			name="password"
            class="form-control rounded-pill form-control-lg"
            placeholder="New Password"
          />
		</div>
	
	
		<div class="form-group">
          <input
			type="password"
			name="cpassword"
            class="form-control rounded-pill form-control-lg"
            placeholder="Confirm Password"
          />
		</div>
		
        
        <button
		  type="submit"
		  name="userupdate-btn"
          class="btn mt-5 rounded-pill btn-lg btn-custom btn-block text-uppercase"
        >
          Reset Password
        </button>
         
        
      </form>
	</div>
  
  <?php
	// Take the username and search in userdata table if found him/her, give them the password
	
	if (isset($_POST['userupdate-btn'])){
		$username = $_POST['username'];
		
		$q="select * from tbl_customer where customerName='".$username."'" ;
		
		$result = $conn->query($q);
		if (!$result){
			die('Error: '.$q." ". $mysqli->error );
		}
		
		$count = $result->num_rows;
		
		if($count == 1){
			
			// without using hash pass method
			
				$row = $result->fetch_array();
				$password = $row["password"];
				//echo "your password is ".$password."<br>";
			
			
		
			   // Hass this pass
				$password = md5($password);
			   // Update this pass to the data table
			   
				$q="update tbl_customer set password ='".$password."'
								where customerName='".$username."'" ;
								
				//Show the new pass to user
				
				if ($conn->query($q)){
          //echo "Your password is reset to $passwd";
          
          header("Location: loginform.html");
				}else{
					die('updating password failed: ' .$mysqli->error);
				}	
			//*/
		}else{
			echo "No such username in the system. please try again!";
		}
	}
	// Show url to go back to login page!
	echo '<a href = "loginform.html> Back to login page </a>' ;

	?>
	

    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

   
	
	
