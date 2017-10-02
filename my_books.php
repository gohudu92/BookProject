<?php include 'config/config.php' ?>
<html lang="en">
<title>My Books</title>
<?php include 'head.php' ?>
<?php include 'nav.php' ?>

<div class="container-fluid bg-1 text-center" id="cc">
			<h3>My Books</h3>
			<img src="img/bookstack4.jpg" class="img-circle" id="mybook">
			<h3></h3>
			
</div>

<div class="container-fluid bg-3 text-center" id="cc">
			<h3>Result</h3>
			<ul class="list-group">
				<?php
					if(isset($_SESSION['id'])){
						$id_user = $_SESSION['id'];
						$req_pre1 = mysqli_prepare($conn, "SELECT id_book, id_user, id FROM users_books WHERE id_user = ?");
			            mysqli_stmt_bind_param($req_pre1, "s", $id_user);
			            mysqli_stmt_execute($req_pre1);
			            mysqli_stmt_bind_result($req_pre1, $donnees['id_book'], $donnees['id_user'], $donnees['id']);
						$tab=array();
						$i = 0;
						while(mysqli_stmt_fetch($req_pre1)){
							array_push($tab, $donnees['id_book']);
							$i++;
						}
						foreach ($tab as $key => $book_id) {
							$req_pre2 = mysqli_prepare($conn, 'SELECT id, title, author, nb_pages FROM livre WHERE id LIKE ?');
							mysqli_stmt_bind_param($req_pre2, "i", $book_id);
							mysqli_stmt_execute($req_pre2);
			            	mysqli_stmt_bind_result($req_pre2, $donnees['id'], $donnees['title'], $donnees['author'], $donnees['nb_pages']);
			            	mysqli_stmt_store_result($req_pre2);
    						$nb = mysqli_stmt_num_rows($req_pre2);
							if($nb <> 0){
								while(mysqli_stmt_fetch($req_pre2)){
									$id = $donnees['id'];
 									$title = $donnees['title'];
 									$author = $donnees['author'];
 									$pages = $donnees['nb_pages'];
									echo '<li class="list-group-item"><b>'.$title.'</b> from <b>'.$author.'</b> (<b>'.$pages.'</b> pages) </li> <a href="return.php?id='.$id.'"><button type="button" class="btn">Return</button></a>';
								}
							}
						}


						


						/*for ($j=0; $j<=$i; $j++) {
							var_dump($tab[$j]);
    						$query = "SELECT * FROM livre WHERE id LIKE \"%$tab[$j]%\"";
    						$my_books = mysqli_query($conn, $query);
							if($my_books <> NULL){
								while($donnees = mysqli_fetch_array($my_books)){
 									$title = $donnees['title'];
 									$author = $donnees['author'];
 									$pages = $donnees['nb_pages'];
									echo '<li class="list-group-item"><b>'.$title.'</b> from <b>'.$author.'</b> (<b>'.$pages.'</b> pages)" </li> <button type="button" class="btn">Return</button>';
								}
							}
						}*/
						

						
					}
				?>
			</ul>
</div>

<?php include 'footer.php' ?>

</html>
