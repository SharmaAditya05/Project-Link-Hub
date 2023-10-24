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

$query = "select * from `record`";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Fetch Data From Database</title>

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
            
            <a class="element" href="#">
                <i class="fa fa-money"></i> Project Dashboard
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

    <h2 style="text-align:center">Projects</h2>
    <table align="center" border="1px" style="color:white; width:800px; line-height:40px;">
        <tr>
            <th> Faculty-Name </th>
            <th> Project-Id </th>
            <th> Project-Title </th>
            <th> Project-Description </th>
            <th> Status</th>
            <th> Request </th>
        </tr>

        <?php

        while ($row = mysqli_fetch_assoc($result)) {
            $fid = $row['fid'];
            $query = "SELECT `name` FROM `users` WHERE `id` = '$fid'";
            $innerResult = mysqli_query($conn, $query);
            
            if ($innerResult) {
                if (mysqli_num_rows($innerResult) == 1) {
                    $rowa = mysqli_fetch_assoc($innerResult);
                    $name = $rowa['name'];
                } else {
                    echo "Invalid credentials. Please try again.";
                }
            }
            else {
                echo "Error in the query: " . mysqli_error($conn);
            }
            
            
        ?>
    
            <tr>
                <td><?php echo $name; ?></td>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['ProjectTitle']; ?></td>
                <td><?php echo $row['ProjectDesc']; ?></td>
                <td>
                    <?php
                    if ($row['Status'] == 1)
                        echo "Available";
                    else
                        echo "Unavailable";
                    ?>
                </td>
                <td>
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['fid']; ?>" />
                        <input type="submit" name="request_<?php echo $row['fid']; ?>" value="Request">
                    </form>
                    <?php
                    if(isset($_POST["request_".$row['fid']])) {
                        $id = $row['id'];
                        $fid = $row['fid'];
                        $pt = $row['ProjectTitle'];
                        // Ensure to sanitize user inputs before inserting into the database to prevent SQL injection
                        $pt = mysqli_real_escape_string($conn, $pt);
                        $id = mysqli_real_escape_string($conn, $id);
                        $fid = mysqli_real_escape_string($conn, $fid);
                        $sname=$_SESSION['username'];
                        $sql = "INSERT INTO `request` (`id`,`fid`,`Sname`, `ProjectTitle`,`status`) 
                                VALUES('$id','$fid','$sname', '$pt','pending');";
                        $query = mysqli_query($conn, $sql);

                        // You can add more handling or feedback here if needed
                        if ($query) {
                            echo "Request successfully inserted!";
                        } else {
                            echo "Error inserting request: " . mysqli_error($conn);
                        }
                    }
                    ?>
                </td>
            </tr>
        <?php
        }
        ?>

    </table>

</body>

</html>
