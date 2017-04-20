<?php
//	===============================
//			   BINARY DATA
//	===============================

// include the library
include_once 'SPSQLite.class.php';

// set a path for a dabase file
$path = 'C:/AppServ/www/';

// create the object and connect to the database
$sqlite =& new SPSQLite($path . 'test.db');

// create table
$query =<<<QRY
CREATE TABLE test(
	id INTEGER PRIMARY KEY,
	image BLOB,
	type VARCHAR(25)
);
QRY;

$sqlite->query($query);

// encode and store on database 'alan01.jpg' image
$data = $sqlite->encodeBinary('./alan01.jpg');
$query = "INSERT INTO test (image, type) VALUES('" . $data . "', 'image/jpeg');";
$sqlite->query($query);

// encode and store on database 'alan03.jpg' image
$data = $sqlite->encodeBinary('./alan03.jpg');
$query = "INSERT INTO test (image, type) VALUES('" . $data . "', 'image/jpeg');";
$sqlite->query($query);

// select from database
$query = "SELECT image, type FROM test WHERE id = 2";
$sqlite->query($query);
$row = $sqlite->returnRows();

// print the second image
header('Content-type: image/jpeg');
echo $sqlite->decodeBinary($row['image']);

// close SQLite connection
$sqlite->close();

// unset the object
unset($sqlite);

// delete the datadase file
unlink($path . 'test.db');
?>
