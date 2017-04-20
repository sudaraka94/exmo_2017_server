<?php
//	====================================
//			TRANSACTION MECHANISM		
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

// create a query
$query = 'SELECT * FROM test';
$sqlite->query($query);

// return a rowset with num and assoc index
$rows = $sqlite->returnRows();
echo '<pre>';
print_r($rows);
echo '</pre>';

// create a transaction 
$sqlite->beginTransaction();
$sqlite->addQuery("UPDATE test SET name='castoro' WHERE id = 1;");
$sqlite->addQuery("UPDATE test SET price=300.00 WHERE id = 2;");
$sqlite->addQuery("INSERT INTO test VALUES(NULL, 'asino', 1, 1000.00);");
$sqlite->commitTransaction();

// verify the transaction modification
$query = 'SELECT name, price FROM test;';
// unbuffered query
$sqlite->query($query, false);
$rows = $sqlite->returnRows('assoc');
echo '<pre>';
print_r($rows);
echo '</pre>';

// create a new transaction
$sqlite->beginTransaction();
// escape string with escapeString()
$sqlite->addQuery("UPDATE test SET name='" . $sqlite->escapeString("alan l'è bel") . "' WHERE id = 1;");
$sqlite->addQuery("UPDATE test SET price=300.00 WHERE id = 2;");
// bad query: id 1 alredy exists -> rollback start
$sqlite->addQuery("INSERT INTO test VALUES(1, 'asino', 1, 1000.00);");
$sqlite->commitTransaction();

// verify the transaction modification (none)
$query = 'SELECT name, price FROM test;';
$sqlite->query($query, false);
$rows = $sqlite->returnRows('assoc');
echo '<pre>';
print_r($rows);
echo '</pre>';

// delete all data
$query = 'DELETE FROM test;';
$sqlite->query($query);

// close SQLite connection
$sqlite->close();

// unset the object
unset($sqlite);

// delete the datadase file
unlink($path . 'test.db');
?>
