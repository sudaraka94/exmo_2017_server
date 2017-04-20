<?php
//	====================================
//		CONNECT/CREATE AND POPULATE			
//	====================================

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
    name VARCHAR(25),
    quantity INTEGER,
    price NUMERIC(5,2)
);
QRY;

$sqlite->query($query);

// insert data
$queries = array(
            "INSERT INTO test (name, quantity, price) VALUES('toro', 10, 500.00);",
            "INSERT INTO test (name, quantity, price) VALUES('gallo', 5, 200.00);",
            "INSERT INTO test (name, quantity, price) VALUES('rana', 20, 100.00);",
            "INSERT INTO test (name, quantity, price) VALUES('cane', 3, 500.00);"
            );

foreach($queries as $query){
    $sqlite->query($query);
}

// close SQLite connection
$sqlite->close();

// unset the object
unset($sqlite);

// delete the datadase file
unlink($path . 'test.db');
?>
