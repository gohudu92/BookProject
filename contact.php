<?php include 'config/config.php' ?>
<html lang="en">
<title>Contact</title>
<?php include 'head.php' ?>
<?php include 'nav.php' ?>
<div class="container-fluid bg-3 text-center" id="cc">
<form name="contactform" method="post" action="send_form_email.php">
<table width="450px">
<tr>
 <td valign="top">
  <label for="first_name">First Name *</label>
 </td>
 <td valign="top">
  <input  type="text" name="first_name" maxlength="50" size="30">
 </td>
</tr>
<tr>
 <td valign="top"">
  <label for="last_name">Last Name *</label>
 </td>
 <td valign="top">
  <input  type="text" name="last_name" maxlength="50" size="30">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="email">Email Address *</label>
 </td>
 <td valign="top">
  <input  type="text" name="email" maxlength="80" size="30">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="telephone">Telephone Number</label>
 </td>
 <td valign="top">
  <input  type="text" name="telephone" maxlength="30" size="30">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="comments">Comments *</label>
 </td>
 <td valign="top">
  <textarea  name="comments" maxlength="1000" cols="25" rows="6"></textarea>
 </td>
</tr>
<tr>
 <td colspan="2" style="text-align:center">
  <input type="submit" value="Submit">   
 </td>
</tr>
</table>
</form>
</div>
<?php include 'footer.php' ?>

</html>


<?php 

$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','');
$reponse = $bdd->query('SELECT * FROM jeux_video WHERE possesseur=\'Patrick\'');
while ($donnees = $reponse->fetch())
{
?>
    <p>
    <?php echo $donnees['nom']; ?><br />
    
   </p>
<?php
}

$reponse->closeCursor();

?>