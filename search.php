<?php
addslashes(str);
trim($_GET[fnirnfirn]);
$mysqli = new mysqli("localhost", "root", "", "test");
//mysql_connect("localhost", "root", "") or die ("Connexion au serveur impossible");

// on choisit la bonne base
//mysql_select_db("test") or die ("Connexion a la base impossible");

echo "
<html>

<head>

<title>Résultat de la recherche</title>

</head>

<body>";

if (($Mot == "")||($Mot == "%")) {
// Si aucun mot clé n'a été saisi,
// le script demande à l'utilisateur
// de bien vouloir préciser un mot clé

 echo "
 Veuillez entrer un mot clé s'il vous plaît!
 <p>";

}

else {
// On selectionne les enregistrements contenant le mot clé
// dans les keywords ou le titre
 $query = "SELECT * FROM livre
 WHERE title LIKE \"%$Mot%\"
 ";

 $result = mysql_query($query);

 $row = mysql_fetch_row($result);

 $Nombre = $row[0];

// Si aucun enregistrement n'est retourné,
// on affiche un message adéquat
if ($Nombre == "0") {
 echo "
 <h2>Aucun résultat ne correspond à votre recherche</h2>

 <p>

 ";

}

// Sinon, on affiche le nombre d'enregistrements correspondant
// et les résultats eux-mêmes
else {
 $query = "SELECT * FROM livre
 WHERE title LIKE \"%$Mot%\" ORDER by title ASC";

 $result = mysql_query($query);

 // Si un seul enregistrement est trouvé, on affiche un message au singulier
 if ($Nombre == "1") {
 echo "
 <a name=\"#resultat\"><h2>Résultat: Un article trouvé</h2></a>

 <p>";

 }
 // Dans le cas contraire le message est au pluriel...
 else {
 echo "
 <a name=\"#resultat\"><h2>Résultat: $Nombre articles trouvés</h2></a>

 <p>";

 }
 while($row = mysql_fetch_row($result))
 {
  echo "
  <p>\n
  <b>$row[2]</b>\n
  <br><a href=\"../$row[0]\">Visualiser l'article</a>\n
  <p>\n
  ";

 }
}

}

// on ferme la base
//mysql_close();

?>

</body>

</html>