<?php
$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "my_db";
$conn = mysqli_connect($sname, $uname, $password, $db_name);
session_start();
if (!$conn) {
    echo "Connection failed";
    exit();
}
$sname= $_SESSION['username'];
$query = "select * from `student`";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="mystyle.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
    <style>
          form {
            margin: 0;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .men{
            font-size:20px;
            color:white;
        } 

        </style>
</head>

<body>
    <div class="background-container">
    <input type="checkbox" id="menu-toggle" checked>
    <div class="menu dflex">
        <div id="logoCSS3" class="text-center">
            <i class="fa fa-css3"></i>
        </div>
        <div class="elements-container dflex">
            <a class="element" href="DashboardA.php">
                <i class="fa fa-money"></i> Student Record
            </a>
            <a class="element" href="requestDetail.php">
                <i class="fa fa-money"></i> Request Details
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
    <div id="myModal" class="modal1">
  <div class="modal-content">
    <span class="close" id="closeModal">&times;</span>
    <p id="popupMessage">Sorry! The Project is Unavailable</p>
  </div>
</div>
<script>
    // Function to close the modal
    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }
    document.getElementById("closeModal").addEventListener("click", closeModal);
  window.addEventListener("click", function(event) {
        if (event.target == document.getElementById("myModal")) {
            closeModal();
        }
    });
</script>

        <h2 style="text-align:center;padding-top:20px;">Students Record</h2>
        <table>
        <tr class="table-info">
            <th>Student Id</th>
            <th>Student Name</th>
            <th>Email</th>
            <th>Sec</th>
            <th>Semester</th>
            <th>Currently Working-On</th>
            
        </tr>

        <?php
            while ($row = mysqli_fetch_assoc($result)) {
                
            ?>
             <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['StudentName']; ?></td>
                <td><?php echo $row['mailId']; ?></td>
                <td><?php echo $row['sec']; ?></td>
                <td><?php echo $row['sem']; ?></td>
                <td style="background-color: <?php echo ($row['pid'] == null) ? 'rgb(255, 127, 127)' : 'lightgreen'; ?>;">
                    <?php
                    if ($row['pid'] == null)
                        echo "Not Working";
                    else{
                        $pid=$row['pid'];
                        $innerquery = "SELECT `ProjectTitle` FROM `record` WHERE `pid` = '$pid'";
                        $innerResult = mysqli_query($conn, $innerquery);
                        $name="";
                        if ($innerResult) {
                        $rowa = mysqli_fetch_assoc($innerResult);
                        $name = $rowa['ProjectTitle'];
                        echo $name;
                    }
                    else {
                        echo "Error in the query: " . mysqli_error($conn);
                    }
                }
            

                    ?>
                </td>
<?php } ?>
        </table>
    </div>
</body>

</html>
