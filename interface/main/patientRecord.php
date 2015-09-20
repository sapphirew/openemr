<?php
require_once("../globals.php");
include_once("$srcdir/pid.inc");
  setpid($_GET['pid']);
?>
<?php
    session_start();
    if ($_GET['pid'] != ""){
    $_SESSION["id"] = $_GET['pid'];
    }
    ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        echo ("pid: ");
        echo $_SESSION["pid"];
        ?>
        Status Updated As:<br>
        <p>
            <?php
            echo $_POST['status'].".";
            ?>
        </p>
        <br>

        <?php
        //echo $_POST['status']."<br>";
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "openemr";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        if($_POST['status'] != ""){
            $sql = "UPDATE patient_data SET status = '".$_POST['status']."' WHERE pid = ".$_SESSION["id"];
            if (mysqli_query($conn, $sql)) {
                echo "Successfully. ";
            } else {
                echo "Error updating note record: " . $conn->error;
            }    
        }

        ?>
        <a href="sentinel.php">Back</a>
        <a href="../forms/newpatient/new.php">test encounter</a>

        <script>
        <?php
            if($_POST['status'] == "Reviewed and no further action needed"){
                echo (""
                        . "window.open('../forms/newpatient/new.php','Encounter','width=1100,height=300');");
            }
        ?>
        </script>
    </body>
</html>
