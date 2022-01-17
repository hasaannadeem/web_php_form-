<?php
session_start();

$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
	$error = true;
  } else {
    $name = test_input($_POST["name"]);

    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
	  $error = true;
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
	$error = true;
  } else {
    $email = test_input($_POST["email"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
	  $error = true;
    }
  }
   

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
	$error = true;
  } else {
    $gender = test_input($_POST["gender"]);
  }
  
  if(!$error){
	$_SESSION['userinfo']['name'] = $_POST["gender"];
	$_SESSION['userinfo']['email'] = $_POST["email"];
	$_SESSION['userinfo']['gender'] = $_POST["gender"];
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<?php
include "includes/header.php";
?>

  <h2>PHP Form Validation </h2>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="name" class="form-control" id="name" placeholder="Enter name" name="name" value="<?php echo $name;?>">
	  <?php if(!empty($nameErr)): ?>
	  <div class="alert alert-danger">
	    <strong>Error!</strong> <?php echo $nameErr;?>
	  </div>
	  <?php endif; ?>
    </div>
	
	<div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $email;?>">
	  <?php if(!empty($emailErr)): ?>
	  <div class="alert alert-danger">
	    <strong>Error!</strong> <?php echo $emailErr;?>
	  </div>
	  <?php endif; ?>
    </div>
	
    <div class="form-group">
      <label for="gender">Gender:</label>
      <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
	  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
	  <?php if(!empty($genderErr)): ?>
	  <div class="alert alert-danger">
	    <strong>Error!</strong> <?php echo $genderErr;?>
	  </div>
	  <?php endif; ?>
    </div>
	
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
  <?php
  if(isset($_SESSION['userinfo'])):
	echo "<pre>";
	print_r($_SESSION['userinfo']);
	echo "</pre>";
  endif;
?>
  
</div>

</body>
</html>