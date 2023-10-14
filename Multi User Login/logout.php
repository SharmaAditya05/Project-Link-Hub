
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="mystyle.css" type="text/css">
</head>
<body>
    

<input type="checkbox" id="menu-toggle" checked>
<div class="menu dflex">
  <div id="logoCSS3" class="text-center">
    <i class="fa fa-css3"></i>
  </div>
  <div class="elements-container dflex">
    <a class="element" href="#">
        <i class="fa fa-leaf"></i> Home
      </a>
    <a class="element" href="Deshboard.php">
        <i class="fa fa-money"></i>  Project Deshboard
      </a>
    <a class="element" href="#">
        <i class="fa fa-gavel"></i> Request Form
      </a>
   
    <a class="element" href="#">
        <i class="fa fa-cogs"></i> Logout
      </a>
  </div>
  <div class="menu-container-btn">
    <div class="menu-toggle-btn">
      <label class="menu-btn text-center" for="menu-toggle">
          <i class="fa fa-close"></i>
          <i class="fa fa-bars"></i>
        </label>
    </div>
  </div>
</div>
<form action="" method="POST"> 
    <label for="out">Do you want to logout?</label>
  <input type="submit" name="Logout" value="Logout" id="out"> 
</form> 
<?php 

if(isset($_POST['Logout']))
{
  session_unset();
  session_destroy(); 
  header("Location: index.php"); 
  exit; 
}
?> 


</body>
</html>