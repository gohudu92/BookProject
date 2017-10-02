<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">Books</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="<?php echo ($current_page=='') ? 'active' : NULL ?>"><a href="/">Home</a></li>
      <li class="<?php echo ($current_page=='about_us.php') ? 'active' : NULL ?>"><a href="about_us.php">About Us</a></li>
      <li class="<?php echo ($current_page=='browse_book.php') ? 'active' : NULL ?>"><a href="browse_book.php">Browse Book</a></li>
	  <li class="<?php echo ($current_page=='my_books.php') ? 'active' : NULL ?>"><a href="my_books.php">My Books</a></li>
	  <li class="<?php echo ($current_page=='contact.php') ? 'active' : NULL ?>"><a href="contact.php">Contact</a></li>
    <li class="<?php echo ($current_page=='gallery.php') ? 'active' : NULL ?>"><a href="gallery.php">Gallery</a></li>
    </ul>
    <?php
    if(isset($_SESSION['id'])){
        echo $_SESSION['pseudo'];
        echo "<br> <a href='log_out.php'>Log Out</a>";
    }
    else{
      echo '
    
    <ul class="nav navbar-nav navbar-right">
      <li class="<?php echo ($current_page==\'sign_up.php\') ? \'active\' : NULL ?>"><a href="sign_up.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li class="<?php echo ($current_page==\'log_in.php\') ? \'active\' : NULL ?>"><a href="log_in.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
    ';}
    ?>

  </div>
</nav>