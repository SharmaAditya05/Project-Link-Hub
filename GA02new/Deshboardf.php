
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
session_start();
$fid=$_SESSION['id'];
$query="SELECT * FROM `request`,`student` WHERE student.id=request.id AND request.status='approved' AND fid='$fid'";
$result=mysqli_query($conn,$query); 
?> 
<!DOCTYPE html> 
<html> 
	<head> 
		<title>Faculty-Deshboard</title> 
    <link rel="stylesheet" href="mystyle.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .progress {
            height: 20px;
            margin-top: 20px;
        }

        .progress-bar {
            background-color: #42b883;
        }       
    @media print {
      body * {
        visibility: hidden;
      }

      #printable-content,
      #printable-content * {
        visibility: visible;
      }

      #printable-content {
        position: absolute;
        left: 0;
        top: 0;
      }
    }
  </style>

  <!-- Add this script for the print functionality -->
  <script>
    function printData() {
      window.print();
    }
  </script>

  
	</head> 
	<body> 
  <input type="button" onclick="printData()" style="position: fixed; top: 10px; right: 50px;" value="Print">
    <!--Code to insert vertical sidebar -->

<input type="checkbox" id="menu-toggle" checked>
<div class="menu dflex">
  <div id="logoCSS3" class="text-center">
    <i class="fa fa-css3"></i>
  </div>
  <div class="elements-container dflex">
 
      <a class="element" href="Deshboardf.php">
        <i class="fa fa-leaf"></i> Dashboard
      </a>
    <a class="element" href="suggestions.php">
        <i class="fa fa-gavel"></i> Suggestions
      </a>
    <a class="element" href="AddProject.php">
        <i class="fa fa-cogs"></i> Add Projects
      </a>
      <a class="element" href="request.php">
        <i class="fa fa-cogs"></i> Pending Requests
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

    <h2 style="text-align:center;padding-top:20px;">Assigned Projects</h2>
    <div id="printable-content">
	<table >
  <!-- align="center" border="1px" style="color:white; width:800px; line-height:40px;  -->
			  <tr> 
          <th> Student-Name </th> 
          <th> Project-Id</th> 
          <th> Project-Title </th>
          <th> Synopsis </th>
          <th> SRS</th>
          <th> Final Report</th>
          <th> Work Completion Status</th> 
        </tr>
		 
		
		<?php 
    
    while($rows=mysqli_fetch_assoc($result))  
		{ 
      
		?> 
		<tr> <td><?php echo $rows['StudentName']; ?></td> 
		<td><?php echo $rows['pid']; ?></td> 
		<td><?php echo $rows['ProjectTitle']; ?></td> 
    <td> <?php
    if ($rows['synopsis'] != null) {
      
      echo '<a href="download.php?filename=' . $rows['synopsis_filename'] . '&file_column=synopsis">Download</a>';


  } else {
      echo 'No document available';
  }
    ?></td> 
    <td><?php  if ($rows['srs'] != null) {
      
      echo '<a href="download.php?filename=' . $rows['srs_filename'] . '&file_column=srs">Download</a>';


  } else {
      echo 'No document available';
  } ?></td> 
    <td><?php  if ($rows['finalReport'] != null) {
      
      echo '<a href="download.php?filename=' . $rows['finalReport_filename'] . '&file_column=finalReport">Download</a>';


  } else {
      echo 'No document available';
  } ?></td> 
    <td><div class="progress">
                    <div class="progress-bar" role="progressbar"
                        style="width: <?php echo $rows['progress']; ?>%;" aria-valuenow="<?php echo $rows['progress']; ?>"
                        aria-valuemin="0" aria-valuemax="100"><?php echo $rows['progress']; ?>%</div>
                </div></td> 
    <td style="border:none!important"><a href="edit_progress.php?id=<?php echo $rows['id']; ?>" class="btn btn-primary no-border">Edit Progress</a></td>
        
		</tr> 
	<?php 
               } 
          ?> 

	</table> 
              </div>
	</body> 
	</html>
