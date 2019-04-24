<?php

include('includes/dbconnect.php');

//$sqlData = mysqli_query("SELECT * FROM `wp_ip` WHERE `status` = 'disallow'");
//echo $sqlData;
//exit();

$sqlData = "SELECT * FROM `ipblock` WHERE `website`='epson' AND `status` = 'disallow'";
$result = mysqli_query($conn, $sqlData);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $array = Array();
    while($row = mysqli_fetch_assoc($result)) {
        //echo "ID: " . $row["id"]. " - IP: " . $row["ip"]. " " . $row["status"]. "<br>";
         //$array[] = $row['ip'];
         //print_r($array);
         $deny = array($row['ip']);
         //print_r($deny);

if(in_array($_SERVER['REMOTE_ADDR'], $deny) || in_array($_SERVER["HTTP_X_FORWARDED_FOR"], $deny)) {

    echo "<h1>Your Are Blocked From Visiting This Website</h1>";

    exit();

}

    }
} else {
    //echo "";
}


/*
 * get data from remote database table
 */
$sql = "SELECT * FROM ipblock WHERE `website`='epson' AND `status`='disallow'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "IP: " . $row["ip"]. "<br>";
    }
} else {
    echo "0 results";
}

?>




<html>
<body>
<div id="wrapper">
<h1>Block User From Visiting Your Website Using PHP</h1>

<div>
 Your Website Content
</div>

</div>
</body>
</html>

