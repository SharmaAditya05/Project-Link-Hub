
<?php
$sname="localhost";
$uname="root";
$password="";
$db_name="my_db";
$conn=mysqli_connect($sname,$uname,$password,$db_name);
if(!$conn){
    echo "Connection failed";
    exit();
}
$query="select * from `record`"; 
$result=mysqli_query($conn,$query); 
?> 
<!DOCTYPE html> 
<html> 
	<head> 
		<title> Fetch Data From Database </title> 
        
    <link rel="stylesheet" href="mystyle.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	</head> 
	<body style="background-color:black;"> 

    <!--
    Code to insert vertical sidebar 
-->

<input type="checkbox" id="menu-toggle" checked>
<div class="menu dflex">
  <div id="logoCSS3" class="text-center">
    <i class="fa fa-css3"></i>
  </div>
  <div class="elements-container dflex">
    <a class="element" href="home.php">
        <i class="fa fa-leaf"></i> Home
      </a>
    <a class="element" href="#">
        <i class="fa fa-money"></i>  Project Deshboard
      </a>
    <a class="element" href="#">
        <i class="fa fa-gavel"></i> Request Form
      </a>
    <a class="element" href="logout.php">
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

<div class="tab">
	<table align="center" border="1px" style="color:white; width:800px; line-height:40px;"> 
	<tr> 
		<th colspan="4" style="padding-left:32%;color:#e0dbc1"><h2>Student Record</h2></th> 
		<tr> 
			  <th style="padding-left:15px;"> ID </th> 
			  <th> Title </th> 
			  <th> Description </th> 
			  <th> Status </th> 
			  
		</tr> 
		
		<?php 
    $i=0;
    while($rows=mysqli_fetch_assoc($result))  
		{ 
      $i++;
		?> 
		<tr style="color:rgb(186, 255, 186);"> <td style="padding-left:15px;"><?php echo $rows['fid']; ?></td> 
		<td ><?php echo $rows['ProjectTitle']; ?></td> 
		<td><?php echo $rows['ProjectDesc']; ?></td> 
		<td><?php echo $rows['Status'] ?></td> 
    <td><input class="btn btn-success m-4" type="button" name="<?php echo 'apply'.$i ?>" value="Apply"></td> 
		</tr> 
	<?php 
               } 
          ?> 

	</table> 
  </div>
	</body> 
	</html>