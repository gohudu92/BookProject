<?php include 'config/config.php' ?>
<html lang="en">
<title>Gallery</title>
<?php include 'head.php' ?>
<?php include 'nav.php' ?>

<div class="row">

<?php

$directory = 'uploadedfiles/';

$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

while($it->valid()) {

    if (!$it->isDot()) {
    	$nameImage = $it->getSubPathName();
    	echo "<div class ='col-xs-2'><img class = 'img-responsive' src='uploadedfiles/".$nameImage."' alt='".$nameImage."'></div>";
    }

    $it->next();
}

?>
</div>

<?php include 'footer.php' ?>

</html> 