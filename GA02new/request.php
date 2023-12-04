<?php
session_start();
$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "my_db";
$conn = mysqli_connect($sname, $uname, $password, $db_name);
if (!$conn) {
    echo "Connection failed";
    exit();
}
$fid=$_SESSION['id'];
$query = "select * from `request` where status='pending' AND fid='$fid'";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Requests</title>
    <link rel="stylesheet" href="mystyle.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
</head>
<body>
    <!-- Code to insert vertical sidebar -->
    <input type="checkbox" id="menu-toggle" checked>
    <div class="menu dflex">
        <div id="logoCSS3" class="text-center">
            <i class="fa fa-css3"></i>
        </div>
        <div class="elements-container dflex">
            
            <a class="element" href="Deshboardf.php">
                <i class="fa fa-leaf"></i> Deshboard
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
    <h1 style="text-align:center">Pending Requests</h1>
    <table>
    <!-- align="center" border="1px" style="color:white; width:800px; line-height:40px;" -->
        <tr>
        <th> Project-Id </th>
        <th> Project-Title </th>
        <th> Requested By </th>
        <th> University Roll </th>
        </tr>
        <?php
        while ($rows = mysqli_fetch_assoc($result)) {
            $id = $rows['id'];
            $innerquery = "SELECT `name` FROM `users` WHERE `id` = '$id'";
            $innerResult = mysqli_query($conn, $innerquery);
            $Sname="";
            if ($innerResult) {
                    $rowa = mysqli_fetch_assoc($innerResult);
                    $Sname = $rowa['name'];
            } else {
                echo "Error in the query: " . mysqli_error($conn);
            }
        
        ?>
            <tr>
                <td><?php echo $rows['pid']; ?></td>
                <td><?php echo $rows['ProjectTitle']; ?></td>
                <td><?php echo $Sname?></td>
                <td><?php echo $rows['Sname']?></td>
                <td style="border:none!important">
                    <form action="request.php" method="POST">
                        <input type="hidden" name="pid" value="<?php echo $rows['pid']; ?>" />
                        <input type="hidden" name="id" value="<?php echo $rows['id']; ?>" />
                        <td style="border:none!important"><input class="btn btn-success m-3" type="submit" name="approve" value="Approve"></td>
                        <td style="border:none!important"><input class="btn btn-danger m-3" type="submit" name="delete" value="Reject"></td>
                    </form>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <?php
    if (isset($_POST['approve'])) {
        $pid = $_POST['pid'];
        $id = $_POST['id'];
        
        $select = "UPDATE `request` SET `status` = 'approved' WHERE `pid` = '$pid' AND `id`=$id";
        $result = mysqli_query($conn, $select);
        
        $select = "UPDATE `student` SET `pid` = '$pid',`progress`=5 WHERE `id` = '$id'";
        $result = mysqli_query($conn, $select);
        if ($result) {    echo '<script>
            document.getElementById("popupMessage").innerHTML = "Request Approved!";
            document.getElementById("myModal").style.display = "block";
        </script>';
            
        } else {
            echo "Error approving request: " . mysqli_error($conn);
        }
        
        $select2 = "UPDATE `record` SET `status` = 0 WHERE `pid` = '$pid' ";
        $result2 = mysqli_query($conn, $select2);
    }

    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $pid = $_POST['pid'];
        $select = "UPDATE `request` SET `status`='rejected' WHERE id = '$id' AND pid='$pid'";
        $result = mysqli_query($conn, $select);
        if ($result) {
            echo '<script>
            document.getElementById("popupMessage").innerHTML = "Request Denied";
            document.getElementById("myModal").style.display = "block";
        </script>';
        } else {
            echo "Error deleting request: " . mysqli_error($conn);
        }
    }
    ?>
</body>
</html>
