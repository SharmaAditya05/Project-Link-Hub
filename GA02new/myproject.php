<?php
$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "my_db";
$conn = mysqli_connect($sname, $uname, $password, $db_name);
if (!$conn) {
    echo "Connection failed";
    exit();
}
session_start();
$id = $_SESSION['id'];
$query = "SELECT * FROM student,record where record.pid = student.pid AND student.id=$id";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student-Deshboard</title>

    <link rel="stylesheet" href="mystyle.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
    
        h1{
            text-align:center !important;
            padding:20px;
            font-family: 'Roboto', sans-serif;
        }
        .container {
            width: 80%;
            padding: 20px;
            text-align: center;
            
        }
        .mainbody{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
        }
        .project {
            margin-top:0px;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .project h3 {
            font-size: 24px;
            color: #42b883;
            margin-bottom: 10px;
        }

        .project p {
            font-size: 18px;
            line-height: 1.6;
            color: #f0f0f0;
            margin-bottom: 20px;
        }

        .progress {
            height: 20px;
            margin-top: 20px;
            
        }

        .progress-bar {
            background-color: #42b883;
        }

        .work-completed {
            font-size: 20px;
            color: #42b883;
            margin-bottom: 10px;
        }
    </style>
</head>
 
<body>
    
    
    <!-- Code to insert vertical sidebar -->

    <input type="checkbox" id="menu-toggle" checked>
    <div class="menu dflex">
        <div id="logoCSS3" class="text-center">
            <i class="fa fa-css3"></i>
        </div>

        <div class="elements-container dflex">
            <a class="element" href="myproject.php">
                <i class="fa fa-money"></i> Project Dashboard
            </a>
            <a class="element" href="Dashboard.php">
                <i class="fa fa-money"></i> Project Ideas
            </a>
            <a class="element" href="suggest.php">
                <i class="fa fa-gavel"></i> Give Suggestions
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
    <h1>My Project</h1> 
   <div class="mainbody">
   
    <div class="container">
        <?php while ($rows = mysqli_fetch_assoc($result)) { 
            $fid= $rows['fid'];
            $que="Select `name` from `users` where `id` = $fid";
            $fname=mysqli_query($conn,$que);
            $name=mysqli_fetch_assoc($fname);

            ?>
            
            <div class="project">
                <h3><?php echo $rows['ProjectTitle']; ?></h3>
                <p><?php echo $rows['ProjectDesc']; ?></p>
                <p>Project Supervisor: <?php echo 'Prof. ',$name['name']?></p>
                <div class="work-completed">Work Completed</div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar"
                        style="width: <?php echo $rows['progress']; ?>%;" aria-valuenow="<?php echo $rows['progress']; ?>"
                        aria-valuemin="0" aria-valuemax="100"><?php echo $rows['progress']; ?>%</div>
                </div>
                
            </div>
        <?php } ?>
    </div>
    </div>
</body>

</html>
