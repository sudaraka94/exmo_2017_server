<?php
//	====================================
//			ADD FUNCTIONS TO SQLite		
//	====================================

// include the library
include_once 'SPSQLite.class.php';

// set a path for a dabase file
$path = 'C:/AppServ/www/';

// define simple function to expand SQLite
function joke($a)
{
	unset($a);
	return 'HeHeHe';
}

function SQLiteMD5($a)
{
	return md5($a);
}

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

// add the user function to SQLite
$sqlite->addFunction('joke', 'joke', 1);
$sqlite->addFunction('md5', 'SQLiteMD5', 1);

// use the new function in a query
// call the PHP function with: php('functionName', param, param, ...)
$sqlite->query("SELECT joke(name) AS nS, md5(name) AS md5, php('substr', price, -2) AS split FROM test");

$row = $sqlite->returnRows();
echo '<pre>';
print_r($row);
echo '</pre>';

// close SQLite connection
$sqlite->close();

// unset the object
unset($sqlite);

// delete the datadase file
unlink($path . 'test.db');
?>
