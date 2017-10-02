<?php include 'config/config.php' ?>
<html lang="en">
<title>Browse Books</title>
<?php include 'head.php' ?>
<?php include 'nav.php' ?>

<div class="container-fluid bg-1 text-center" id="cc">
			<h3>Browse a Book</h3>
			<img src="img/search.jpg" class="img-circle" >
			<h3></h3>
			
</div>

<?php //var_dump($_SESSION);?>

<!--
<form method="post">

Entrez un mot clé:<br>

<input type="text" name="Mot">

<input type="submit" value="Rechercher" alt="Lancer la recherche!">

</form> 
-->


<div class="container-fluid bg-2 text-center" id="cc">
			<h3>Enter your research</h3>
			<form method="post">
			<div class="form-group">
				<label for="title"> Title : </label>
				<input type="text" class="form-control" name="title">
			</div>
			
			<div class="form-group">
				<label for="author"> Author : </label>
				<input type="text" class="form-control" name="author">
			</div>
			<button type="submit" class="btn btn-primary btn-block">Search</button>
			</form>
			
</div>

<div class="container-fluid bg-3 text-center" id="cc">
			<h3>Result</h3>
			<ul class="list-group">
<?php
	$request = "SELECT * FROM users_books WHERE id_user=".$_SESSION['id'];
	$resultat = mysqli_query($conn, $request);
	$tab=array();
	while($gg = mysqli_fetch_array($resultat)){
		array_push($tab,$gg['id_book']);
	}
	if(isset($_SESSION['id'])){

	if(isset($_POST["title"]) || isset($_POST["author"])){

	$author = trim($_POST["author"]);

	$author = mysqli_real_escape_string($conn, $author);


	$title = trim($_POST["title"]);

	$title = mysqli_real_escape_string($conn, $title);

	if (($title == "") && ($author == "")) {
	echo "Veuillez entrer un mot clé s'il vous plaît!<p>";
	}
	elseif(($title <> "") && ($author == "")){
		$query = "SELECT * FROM livre WHERE title LIKE \"%$title%\"";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_row($result);
		$Nombre = $row[0];


		
		if ($Nombre == "0") {
 			echo "<h2>Aucun résultat ne correspond à votre recherche</h2><p>";
		}
		else {
 			$query = "SELECT * FROM livre WHERE title LIKE \"%$title%\" ORDER by title ASC";

 			$result = mysqli_query($conn, $query);
 			//foreach ($tab as $key => $book_id) {
 				while($donnees = mysqli_fetch_array($result)){
 					//if($donnees['id'] <> $book_id){
 						$id = $donnees['id'];
 						$title = $donnees['title'];
 						$author = $donnees['author'];
 						$pages = $donnees['nb_pages'];
  						echo '<li class="list-group-item"><b>'.$title.'</b> from <b>'.$author.'</b> (<b>'.$pages.'</b> pages) </li>';
  						echo '<a href="reserve.php?id='.$id.'" /><button type="submit" class="btn btn-primary btn-block">Reserve</button></a>';
 					//}
 				}
			//}
		}
	}
	elseif (($title <> "") && ($author <> "")) {
		$query = "SELECT * FROM livre WHERE title LIKE \"%$title%\" AND author LIKE \"%$author%\"";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_row($result);
		$Nombre = $row[0];

		if ($Nombre == "0") {
 			echo "<h2>Aucun résultat ne correspond à votre recherche</h2><p>";
		}
		else {
 			$query = "SELECT * FROM livre WHERE title LIKE \"%$title%\" AND author LIKE \"%$author%\" ORDER by title ASC";

 			$result = mysqli_query($conn, $query);

 			//foreach ($tab as $key => $book_id) {
 				while($donnees = mysqli_fetch_array($result)){
 					//if($donnees['id'] <> $book_id){
 						$id = $donnees['id'];
 						$title = $donnees['title'];
 						$author = $donnees['author'];
 						$pages = $donnees['nb_pages'];
  						echo '<li class="list-group-item"><b>'.$title.'</b> from <b>'.$author.'</b> (<b>'.$pages.'</b> pages) </li>';
  						echo '<a href="reserve.php?id='.$id.'" /><button type="submit" class="btn btn-primary btn-block">Reserve</button></a>';
 					//}
 				}
			//}
		}
	}
	elseif (($title == "") && ($author <> "")){
		$query = "SELECT * FROM livre WHERE author LIKE \"%$author%\"";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_row($result);
		$Nombre = $row[0];

		if ($Nombre == "0") {
 			echo "<h2>Aucun résultat ne correspond à votre recherche</h2><p>";
		}
		else {
 			$query = "SELECT * FROM livre WHERE author LIKE \"%$author%\" ORDER by title ASC";

 			$result = mysqli_query($conn, $query);

 			//foreach ($tab as $key => $book_id) {
 				while($donnees = mysqli_fetch_array($result)){
 					//if($donnees['id'] <> $book_id){
 						$id = $donnees['id'];
 						$title = $donnees['title'];
 						$author = $donnees['author'];
 						$pages = $donnees['nb_pages'];
  						echo '<li class="list-group-item"><b>'.$title.'</b> from <b>'.$author.'</b> (<b>'.$pages.'</b> pages) </li>';
  						echo '<a href="reserve.php?id='.$id.'" /><button type="submit" class="btn btn-primary btn-block">Reserve</button></a>';
 					//}
 				}
			//}
		}
	}
	
	}
	else{
		$query = "SELECT * FROM livre ORDER by title";

 		$result = mysqli_query($conn, $query);
 		
 			//foreach ($tab as $key => $book_id) {
 				while($donnees = mysqli_fetch_array($result)){
 					//if($donnees['id'] <> $book_id){
 						$id = $donnees['id'];
 						$title = $donnees['title'];
 						$author = $donnees['author'];
 						$pages = $donnees['nb_pages'];
  						echo '<li class="list-group-item"><b>'.$title.'</b> from <b>'.$author.'</b> (<b>'.$pages.'</b> pages) </li>';
  						echo '<a href="reserve.php?id='.$id.'" /><button type="submit" class="btn btn-primary btn-block">Reserve</button></a>';
 					//}
 				}
			//}
 		
 	}
 }
 	else{
 		echo "You have to be connected";
 		sleep(2);
 		header('Location: /log_in.php');
 	}


 		
	

	mysqli_close($conn);



?>	
			</ul>
</div>






<?php include 'footer.php' ?>

</html>

