<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'usbw';
$DATABASE_NAME = 'svetaine';

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (!$conn)
{
  die("Prisijungimas prie duomenų bazės nutrūko: " . mysqli_connect_error());
}
 ?>
