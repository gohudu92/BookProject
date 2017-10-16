<?php include 'config/config.php' ?>
<html lang="en">
<title>Admin panel</title>
<?php include 'head.php' ?>
<?php include 'nav.php' ?>
<?php
	if(isset($_SESSION['id']) AND $_SESSION['id'] == 5){
		?>
					<div class="container-fluid bg-2 text-center" id="cc">
				<form class="form-horizontal" method="POST">
		  <div class="form-group" >
		    <label class="control-label col-sm-2" for="title">Title:</label>
		    <div class="col-sm-10">
		      <input type="title" class="form-control" name="titler" placeholder="Enter title">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="author">Author:</label>
		    <div class="col-sm-10"> 
		      <input type="author" class="form-control" name="authorr" placeholder="Enter author">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="nb_pages">Page number:</label>
		    <div class="col-sm-10"> 
		      <input type="nb_pages" class="form-control" name="nb_pages" placeholder="Enter nb_pages">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="publisher">Publisher:</label>
		    <div class="col-sm-10"> 
		      <input type="publisher" class="form-control" name="publisher" placeholder="Enter publisher">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="ISBN">ISBN:</label>
		    <div class="col-sm-10"> 
		      <input type="ISBN" class="form-control" name="ISBN" placeholder="Enter ISBN">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="year">Year of release:</label>
		    <div class="col-sm-10"> 
		      <input type="year" class="form-control" name="year" placeholder="Enter year">
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

if(isset($_POST["titler"]) && isset($_POST["authorr"]) && isset($_POST["nb_pages"]) && isset($_POST["publisher"]) && isset($_POST["ISBN"]) && isset($_POST["year"])){
		$title = trim($_POST["titler"]);
		$title = mysqli_real_escape_string($conn, $title);
		$author = trim($_POST["authorr"]);
		$author = mysqli_real_escape_string($conn, $author);
		$nb_pages = trim($_POST["nb_pages"]);
		$nb_pages = mysqli_real_escape_string($conn, $nb_pages);
		$publisher = trim($_POST["publisher"]);
		$publisher = mysqli_real_escape_string($conn, $publisher);
		$ISBN = trim($_POST["ISBN"]);
		$ISBN = mysqli_real_escape_string($conn, $ISBN);
		$year = trim($_POST["year"]);
		$year = mysqli_real_escape_string($conn, $year);



		$req_pre_title = mysqli_prepare($conn, "SELECT title FROM livre WHERE title = ?" );
		mysqli_stmt_bind_param($req_pre_title, "s",$title);
		mysqli_stmt_execute($req_pre_title);
		mysqli_stmt_store_result($req_pre_title);
    	$nb_title = mysqli_stmt_num_rows($req_pre_title);

		$req_pre_author = mysqli_prepare($conn, "SELECT id_author FROM livre AS l, author AS a WHERE l.id_author = a.id AND a.name = ?" );
		mysqli_stmt_bind_param($req_pre_author, "s", $author);
		mysqli_stmt_execute($req_pre_author);
		$id_de_author = mysqli_stmt_execute($req_pre_author);
		mysqli_stmt_store_result($req_pre_author);
    	$nb_author = mysqli_stmt_num_rows($req_pre_author);
    	var_dump($nb_author);

    	//$query = "SELECT id_author FROM livre AS l, author AS a WHERE l.id_author = a.id AND a.name = $author";
    	$query = "SELECT * FROM author WHERE name LIKE \"%$author%\"";
    	$result = mysqli_query($conn, $query);
    	$row = mysqli_fetch_row($result);
		$Nombre = $row[0];
		


		

		if($nb_title <> 0 && $Nombre <> 0){
			echo "books is already in the database, try another one";
		}
		else{
			if($Nombre <> 0){
				$zero = 0;
				$query = "SELECT * FROM author WHERE name LIKE \"%$author%\"";
    			$result = mysqli_query($conn, $query);
				$id_author = "";
				while($donnees = mysqli_fetch_array($result)){
					$id_author = $donnees["id"];
					var_dump($id_author);
				}
				$query = "INSERT INTO `livre`(`title`, `id_author`, `ISBN`, `date`, `edition_number`, `nb_pages`, `publisher`) VALUES (\"$title\",$id_author,\"$ISBN\",$year,$zero,$nb_pages,\"$publisher\")";
				mysqli_query($conn, $query);
				//$req_pre_title = mysqli_prepare($conn, "INSERT INTO `livre`(`title`, `id_author`, `ISBN`, `date`, `edition_number`, `nb_pages`, `publisher`) VALUES (?,?,?,?,?,?,?)" );
				
				//mysqli_stmt_bind_param($req_pre_title, "sssiiis",$title, $id_de_author, $ISBN, $year, $zero, $nb_pages, $publisher);
				//mysqli_stmt_execute($req_pre_title);
				//mysqli_stmt_close($req_pre_title);

				//header('Location: admin.php');

			}
			else{
				$req_pre_author = mysqli_prepare($conn, "INSERT INTO `author`(`name`) VALUES (?)");
				mysqli_stmt_bind_param($req_pre_author, "s",$author);
				mysqli_stmt_execute($req_pre_author);

				$req_pre_author = mysqli_prepare($conn, "SELECT id_author FROM livre AS l, author AS a WHERE l.id_author = a.id AND a.name = ?" );
				mysqli_stmt_bind_param($req_pre_author, "s", $author);
				mysqli_stmt_execute($req_pre_author);
				$id_de_author = mysqli_stmt_execute($req_pre_author);

				$zero = 0;
				
				$query = "INSERT INTO `livre`(`title`, `id_author`, `ISBN`, `date`, `edition_number`, `nb_pages`, `publisher`) VALUES (\"$title\",$id_author,\"$ISBN\",$year,$zero,$nb_pages,\"$publisher\")";
				mysqli_query($conn, $query);

				/*$req_pre_title = mysqli_prepare($conn, "INSERT INTO `livre`(`title`, `id_author`, `ISBN`, `date`, `edition_number`, `nb_pages`, `publisher`) VALUES (?,?,?,?,?,?,?)" );
				$zero = 0;
				mysqli_stmt_bind_param($req_pre_title, "sssiiis",$title, $id_de_author, $ISBN, $year, $zero, $nb_pages, $publisher);
				mysqli_stmt_execute($req_pre_title);
				mysqli_stmt_close($req_pre_title);*/
				//mysqli_stmt_close($req_pre_author);


				//header('Location: admin.php');
			}
			
		}
	}
}
	else{
		echo "You can't access this page";
	}



?>


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
 						$author = $donnees['id_author'];

 						$req_pre_author = mysqli_prepare($conn, "SELECT name FROM author AS a, livre AS l WHERE l.id_author = a.id AND l.id_author = ?" );
						mysqli_stmt_bind_param($req_pre_author, "i", $author);
						mysqli_stmt_execute($req_pre_author);
						$name_author = mysqli_stmt_execute($req_pre_author);


 						
 						$pages = $donnees['nb_pages'];
  						echo '<li class="list-group-item"><b>'.$title.'</b> from <b>'.$name_author.'</b> (<b>'.$pages.'</b> pages) </li>';
  						echo '<a href="delete.php?id='.$id.'" /><button type="submit" class="btn btn-primary btn-block">Delete</button></a>';
 					//}
 				}
			//}
		}
	}
	elseif (($title <> "") && ($author <> "")) {
		$arrayAllAuthors=[];
		$query = "SELECT * FROM author";
 		$result = mysqli_query($conn, $query);
 		while($donnees = mysqli_fetch_array($result)){
 			$arrayAllAuthors[$donnees["id"]]=$donnees["name"];
 		}
 		foreach ($arrayAllAuthors as $key => $value) {
 			if(stristr($value, $author) === FALSE){
 				unset($arrayAllAuthors[$key]);
 			}
 		}


		//$query = "SELECT * FROM livre WHERE title LIKE \"%$title%\" AND author LIKE \"%$author%\"";
		$query = "SELECT * FROM livre WHERE title LIKE \"%$title%\"";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_row($result);
		$Nombre = $row[0];

		if ($Nombre == "0") {
 			echo "<h2>Aucun résultat ne correspond à votre recherche</h2><p>";
		}
		else {
			foreach ($arrayAllAuthors as $key => $value) {

 			$query = "SELECT * FROM livre WHERE title LIKE \"%$title%\" AND id_author = $key ORDER by title ASC";

 			$result = mysqli_query($conn, $query);

 			//foreach ($tab as $key => $book_id) {
 				while($donnees = mysqli_fetch_array($result)){
 					//if($donnees['id'] <> $book_id){
 						$id = $donnees['id'];
 						$title = $donnees['title'];
 						$author = $donnees['id_author'];
 						$pages = $donnees['nb_pages'];
 						$name_author = $value;

  						echo '<li class="list-group-item"><b>'.$title.'</b> from <b>'.$name_author.'</b> (<b>'.$pages.'</b> pages) </li>';
  						echo '<a href="delete.php?id='.$id.'" /><button type="submit" class="btn btn-primary btn-block">Delete</button></a>';
 					//}
 				}
 			}
			//}
		}
	}
	elseif (($title == "") && ($author <> "")){
		$arrayAllAuthors=[];
		$query = "SELECT * FROM author";
 		$result = mysqli_query($conn, $query);
 		while($donnees = mysqli_fetch_array($result)){
 			$arrayAllAuthors[$donnees["id"]]=$donnees["name"];
 		}
 		foreach ($arrayAllAuthors as $key => $value) {
 			if(stristr($value, $author) === FALSE){
 				unset($arrayAllAuthors[$key]);
 			}
 		}

 		

 		

 		if(empty($arrayAllAuthors)){
 			echo "<h2>Aucun résultat ne correspond à votre recherche</h2><p>";
 		}
 		else{
 			
 			foreach ($arrayAllAuthors as $key => $value) {
 				$query2 = "SELECT * FROM livre WHERE id_author = $key";
				$result2 = mysqli_query($conn, $query2);

				while($donnees = mysqli_fetch_array($result2)){
 						$id = $donnees['id'];
 						$title = $donnees['title'];
 						$id_author = $donnees['id_author'];
 						$pages = $donnees['nb_pages'];

 						$name_author = $value;
  						echo '<li class="list-group-item"><b>'.$title.'</b> from <b>'.$name_author.'</b> (<b>'.$pages.'</b> pages) </li>';
  						echo '<a href="delete.php?id='.$id.'" /><button type="submit" class="btn btn-primary btn-block">Delete</button></a>';
 					//}
 				}
 			}

		}
	}
	
	}
	else{

		$arrayAllAuthors=[];
		$query = "SELECT * FROM author";
 		$result = mysqli_query($conn, $query);
 		while($donnees = mysqli_fetch_array($result)){
 			$arrayAllAuthors[$donnees["id"]]=$donnees["name"];
 		}

 		//==================================

		$query = "SELECT * FROM livre ORDER by title";
 		$result = mysqli_query($conn, $query);
 		
 			//foreach ($tab as $key => $book_id) {
 				while($donnees = mysqli_fetch_array($result)){
 					//if($donnees['id'] <> $book_id){
 						$id = $donnees['id'];
 						$title = $donnees['title'];
 						$id_author = $donnees['id_author'];
 						$pages = $donnees['nb_pages'];
 						
 						$name_author=$arrayAllAuthors[$id_author];
  						echo '<li class="list-group-item"><b>'.$title.'</b> from <b>'.$name_author.'</b> (<b>'.$pages.'</b> pages) </li>';
  						echo '<a href="delete.php?id='.$id.'" /><button type="submit" class="btn btn-primary btn-block">Delete</button></a>';
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