<?php
    $db=mysqli_connect("localhost","root","","users");
    if ($db -> connect_errno) {
        echo "Failed to connect to MySQL: " . $db -> connect_error;
        exit();
		}
    $db->set_charset('utf8');
?>