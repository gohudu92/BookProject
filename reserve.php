<?php
	include "config/config.php";
	if($_SESSION['id'] <> NULL){
		$monid = mysqli_real_escape_string($conn, $_GET['id']);

		$req_pre = mysqli_prepare($conn, 'SELECT id_book, id_user, id FROM users_books WHERE id_user = ?');
		mysqli_stmt_bind_param($req_pre, "i", $_SESSION['id']);
		mysqli_stmt_execute($req_pre);
		mysqli_stmt_bind_result($req_pre, $donnees['id_book'], $donnees['id_user'], $donnees['id']);
		$tab=array();
		$i = 0;
		while(mysqli_stmt_fetch($req_pre)){
			array_push($tab,$donnees['id_book']);
		}

		
		foreach ($tab as $key => $book_id) {
			if($book_id == $monid){
				$i = 1;
			}
		}

		if($i == 0){
			$req_pre = mysqli_prepare($conn, "INSERT INTO `users_books`(`id_user`, `id_book`) VALUES (?, ?)");
			mysqli_stmt_bind_param($req_pre, "ii", $_SESSION['id'], $monid);
			mysqli_stmt_execute($req_pre);
			header('Location: /my_books.php');
		}
		else{
			echo "<script>alert(\"You already have this book in your book\")</script>"; 
			header('Location: /my_books.php');
		}
		
	}
	else{
		header('Location: /log_in.php');
	}
	
?>


<?php
// include de la connexion SQL.

$req_pre = mysqli_prepare($bdd, 'SELECT id_book, id_user, id FROM users_books WHERE id_user = ?');
mysqli_stmt_bind_param($req_pre, "i", $_SESSION['id']);
mysqli_stmt_execute($req_pre);
mysqli_stmt_bind_result($req_pre, $donnees['pseudo'], $donnees['age'], $donnees['email']);
while(mysqli_stmt_fetch($req_pre))
{
	echo $donnees['pseudo'] . ", " . $donnees['age'] . " ans, " . $donnees['email'];
}
?>
