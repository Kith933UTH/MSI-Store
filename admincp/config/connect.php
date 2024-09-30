<?php
$mysqli = new mysqli("localhost", "root", "", "msi_store");

// Check connection
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}

// function getCurrentPageURL() {
//   $pageURL = 'http';
//   if (!empty($_SERVER['HTTPS'])) {
//   if ($_SERVER['HTTPS'] == 'on') {
//   $pageURL .= "s";
//   }
//   }
//   $pageURL .= "://";
//   if ($_SERVER["SERVER_PORT"] != "80") {
//   $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
//   } else {
//   $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
//   }
//   return $pageURL;
//   }
