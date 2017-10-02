<?php include 'config/config.php' ?>
<html lang="en">
<title>Upload File</title>
<?php include 'head.php' ?>
<?php include 'nav.php' ?>

<?php 
if (isset($_FILES['upload'])){
	$allowedextensions = array('jpg', 'jpeg', 'gif', 'png');
	$extension = strtolower(substr($_FILES['upload']['name'], strrpos($_FILES['upload']['name'], '.') + 1));
	echo "Your file extension is: ".$extension;
	$error = array ();

	if(in_array($extension, $allowedextensions) === false){
		$error[] = 'This is not an image, upload is allowed only for images.';
	}

	if($_FILES['upload']['size'] > 1000000){
        
        $error[]='The file exceeded the upload limit';
    }

    if(empty($error)){
        move_uploaded_file($_FILES['upload']['tmp_name'], "uploadedfiles/{$_FILES['upload']['name']}");     
    }
    
}

 ?>

 	
		
			   
			   
				   <div>
					   <?php 
					   if (isset($error)){
						   if (empty($error)){
							   echo '<a href="uploadedfiles/' . $_FILES['upload']['name'] . '">Check file';
							   
						   } else {
							   foreach ($error as $err){
								   echo $err;
							   }
							   
						   }
					   }
					   
					   ?>
				   </div>
				   
				   
				   <div  class = 'row' style="text-align: center;">
					   
					   <form action="" method="POST" enctype="multipart/form-data">
						   <input type="file" name="upload" class="myCenterBlock"/></br>
						   <input  type="submit" value="submit" />
					   </form>                   
				   </div>
			   
		
		
		
		
	</html>

	<?php include 'footer.php' ?>

</html>