<?php
include('security.php');
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

      <form action="userregist.php" method="post" class="login-form text-center" enctype="multipart/form-data">
        <h1 class="mb-5 font-weight-light text-uppercase">Register as a Member</h1>
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
			type="password"
			name="password"
            class="form-control rounded-pill form-control-lg"
            placeholder="Password"
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
			type="text"
			name="address"
            class="form-control rounded-pill form-control-lg"
            placeholder="Address"
          />
		</div>
		<div class="form-group">
          <input
			type="text"
			name="city"
            class="form-control rounded-pill form-control-lg"
            placeholder="City"
          />
		</div>
		<div class="form-group">
          <input
			type="text"
			name="postalcode"
            class="form-control rounded-pill form-control-lg"
            placeholder="PostalCode"
          />
		</div>
        <div class="form-group">
          <input
			type="text"
			name="country"
            class="form-control rounded-pill form-control-lg"
            placeholder="Country"
          />
        </div>
        
        <button
		  type="submit"
		  name="register-btn"
          class="btn mt-5 rounded-pill btn-lg btn-custom btn-block text-uppercase"
        >
          Register
        </button>
         
        
      </form>
	</div>
  
  <?php 

// Get input information 
  if(isset($_POST['register-btn'])){
    $name 	    = $_POST['username'];
    $email 		= $_POST['email'];
    $addr 		= $_POST['address'];
    $city		= $_POST['city'];
    $postalcode = $_POST['postalcode'];
    $country 	= $_POST['country'];
    $pwd 		= $_POST['password'];
    $passwd 	= md5($pwd);
// Insert to the userdata TABLE
  $q = "INSERT INTO tbl_customer (customerName, Email, Address, City, PostalCode, Country, password ) VALUES ('$name', '$email', '$addr', '$city', '$postalcode', '$country', '$passwd') ";

  $result = $conn->query($q);
  if($result){
    $_SESSION['success']="Registered Successfully.";
    header("Location: loginform.html");
  }else{
    $_SESSION['status']="Registered Again.";
    header("Location: userregist.php");
      
  }

}
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
