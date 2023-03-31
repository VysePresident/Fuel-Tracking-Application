<?php

  $dbhost = "gasco-server.mysql.database.azure.com";
  $dbuser = "isaac";
  $dbpass = "team53server";
  $dbname = "gasco";

  if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
  {
    die("failed to connect to database");
  }

?>