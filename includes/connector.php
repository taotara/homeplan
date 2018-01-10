<?php
$con = new mysqli("localhost", "root", "root", "mlm03");
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>