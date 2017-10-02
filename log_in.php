<?php include 'config/config.php' ?>
<?php 
  if(isset($_POST["pseudo"]) && isset($_POST["pwd"])){

    $pseudo = trim($_POST["pseudo"]);
    $pseudo = mysqli_real_escape_string($conn, $pseudo);
    $pass = trim($_POST["pwd"]);
    $pass = mysqli_real_escape_string($conn, $pass);
    $stmt = mysqli_prepare($conn, "SELECT pseudo, email, id, pass FROM membre WHERE pseudo = ?");
    mysqli_stmt_bind_param($stmt, 's', $pseudo);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $donnees['pseudo'], $donnees['email'], $donnees['id'], $donnees['pass']);
    mysqli_stmt_store_result($stmt);
    $nb = mysqli_stmt_num_rows($stmt);
    if($nb <> 0){
      mysqli_stmt_fetch($stmt);
      $real_pass = sha1($pass);
      if($real_pass == $donnees["pass"]){
        $_SESSION['id'] = $donnees["id"];
        $_SESSION['pseudo'] = $donnees["pseudo"];
        $_SESSION['email'] = $donnees["email"];
        header('Location: /upload_files.php');

        
            // include de la connexion SQL.

            /*$req_pre = mysqli_prepare($conn, 'SELECT * FROM membre WHERE pseudo LIKE \"%$pseudo%\"');
            mysqli_stmt_bind_param($req_pre, "s", $pseudo);
            mysqli_stmt_execute($req_pre);
            mysqli_stmt_bind_result($req_pre, $donnees['id'], $donnees['pseudo'], $donnees['email']);
            while(mysqli_stmt_fetch($req_pre))
            {
              $_SESSION['id'] = $donnees["id"];
              $_SESSION['pseudo'] = $donnees["pseudo"];
              $_SESSION['email'] = $donnees["email"];
            }*/
        

      }
      else{
        echo "Wrong password !";
      }


    }
    else{
      echo "Wrong pseudo !";
    }

  }
?>
<html lang="en">
<title>Log In</title>
<?php include 'head.php' ?>
<?php include 'nav.php' ?>
	
	<div class="container-fluid bg-2 text-center" id="cc">
		<form class="form-horizontal" method="POST">
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Pseudo:</label>
    <div class="col-sm-10"> 
      <input type="pseudo" class="form-control" name="pseudo" placeholder="Enter pseudo">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Password:</label>
    <div class="col-sm-10"> 
      <input type="password" class="form-control" name="pwd" placeholder="Enter password">
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label><input type="checkbox"> Remember me</label>
      </div>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>
</div>



	 
	<?php include 'footer.php' ?>

</html>
