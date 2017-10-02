<?php include 'config/config.php' ?>
<html lang="en">
<title>Sign Up</title>
<?php include 'head.php' ?>
<?php include 'nav.php' ?>
	<div class="container-fluid bg-2 text-center" id="cc">
		<form class="form-horizontal" method="POST">
  <div class="form-group" >
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email" placeholder="Enter email">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Password:</label>
    <div class="col-sm-10"> 
      <input type="password" class="form-control" name="pwd" placeholder="Enter password">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Pseudo:</label>
    <div class="col-sm-10"> 
      <input type="pseudo" class="form-control" name="pseudo" placeholder="Enter pseudo">
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>
</div>
<?php

	

	if(isset($_POST["email"]) && isset($_POST["pwd"]) && isset($_POST["pseudo"])){
		$email = trim($_POST["email"]);
		$email = mysqli_real_escape_string($conn, $email);
		$pass = trim($_POST["pwd"]);
		$pass = mysqli_real_escape_string($conn, $pass);
		$real_pass = sha1($pass);
		$pseudo = trim($_POST["pseudo"]);
		$pseudo = mysqli_real_escape_string($conn, $pseudo);


		$req_pre_pseudo = mysqli_prepare($conn, "SELECT pseudo FROM membre WHERE pseudo = ?" );
		mysqli_stmt_bind_param($req_pre_pseudo, "s",$pseudo);
		mysqli_stmt_execute($req_pre_pseudo);
		mysqli_stmt_store_result($req_pre_pseudo);
    	$nb_pseudo = mysqli_stmt_num_rows($req_pre_pseudo);

		$req_pre_email = mysqli_prepare($conn, "SELECT email FROM membre WHERE email = ?" );
		mysqli_stmt_bind_param($req_pre_email, "s", $email);
		mysqli_stmt_execute($req_pre_email);
		mysqli_stmt_store_result($req_pre_email);
    	$nb_email = mysqli_stmt_num_rows($req_pre_email);
		

		if($nb_pseudo <> 0 || $nb_email <> 0 ){
			echo "pseudo or email already used on this site, try another one";
		}
		else{
			$req_pre_pseudo = mysqli_prepare($conn, "INSERT INTO `membre`(`pseudo`, `pass`, `email`, `date_inscription`) VALUES (?,?,?,?)" );
			$date = date("y.m.d");
			mysqli_stmt_bind_param($req_pre_pseudo, "ssss",$pseudo, $real_pass, $email, $date);
			mysqli_stmt_execute($req_pre_pseudo);
			header('Location: /');
		}



		
	}
	else{
		
	}
	

	
?>
	
	<?php include 'footer.php' ?>

</html>
