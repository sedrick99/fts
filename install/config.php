<?php
Session_start();
$db = new mysqli("localhost", "root","","new");

If ($db->connect_error) {
    Die("Connection failed: " . $db->connect_error);
}
?>
