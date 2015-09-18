<?php
require_once("../globals.php");
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
        <title>sentinel alert!</title>
        <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
        <style type="text/css">
        @import "../../library/js/datatables/media/css/demo_page.css";
        @import "../../library/js/datatables/media/css/demo_table.css";
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    </head>
    <body>
        <a href="../reports/appointments_report.php">appointments_report.php</a>
        <h3>ALERT</h3>
        <?php
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
            $sql = "SELECT pid, fname, lname, phone_cell, street, usertext1, date, status FROM patient_data";
            $result = mysqli_query($conn, $sql);
            ?>
        <table class="table striped hovered dataTables">
            <thead>
            <tr>
                <th>ID</th>
                <th>first name</th>
                <th>last name</th>
                <th>contact info</th>
                <th>address</th>
                <th>description</th>
                <th>date</th>                              
                <th>status</th>                              
            </tr>
        </thead>

            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    // output data of each row                    
                    //$moreAlert = 0;    
                    while($row = mysqli_fetch_array($result)) {
                        if (htmlentities($row['status'] == "")){
                      //      $moreAlert = 1;
                            echo "<tr><td>" . htmlentities($row['pid']) . "</td>";
                            echo "<td><a href=\"#\" onClick=\"window.open('../patient_file/summary/demographics.php?set_pid=".htmlentities($row['pid'])."','status_window','width=950,height=600')\" >" . htmlentities($row['fname']) . "</a></td>";
                            echo "<td>" . htmlentities($row['lname']) . "</td>";
                            echo "<td>" . htmlentities($row['phone_cell']) . "</td>";
                            echo "<td>" . htmlentities($row['street']) . "</td>";
                            echo "<td>" . htmlentities($row['usertext1']) . "</td>";
                            echo "<td>" . htmlentities($row['date']) . "</td>";
                            echo "<td>" . "<form method=\"post\" action=\"patientRecord.php?pid=".htmlentities($row['pid'])."\">
                            <select name=\"status\">
                            <option value=\"\">--Select Status--</option>
                            <option value=\"contacted patient\">contacted patient</option>
                            <option value=\"wrote notes\">wrote notes</option>
                            <option value=\"prescribed further tests\">prescribed further tests</option>
                            </select>
                            <input type=\"submit\" >
                            </form>" . "</td></tr>";
                        }
                    }
                }
                else{
                }
                ?>
            </tbody>
        </table>
        <?php
        $sql = "SELECT pid FROM patient_data WHERE status = ''";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
            
        }
        else {
            echo "No more sentinel alert.";
        }
        ?>
        <?php
        $sql = "SELECT MAX(pid) AS maxpid FROM patient_data";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        echo htmlentities($row['maxpid']);
        
        //echo $maxpid;
        ?>
        <!--<a href="../patient_file/summary/demographics.php?set_pid=1" target="main_screen#Main">demographic</a>-->
        <script>
//        var workIsDone = <?php //echo $moreAlert ?>;
//
//        window.onbeforeunload = confirmBrowseAway;
//
//        function confirmBrowseAway()
//        {
//          if (!workIsDone) {
//            return "Are you sure you want to do that? If you leave this page " +
//            "now, you would not be able to check alerts again!";
//          }
//        }

        </script>
        
    </body>
</html>
