<?php
//	====================================
//			RETURN SPECIFIC ROWS		
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
$rows = $sqlite->selectRows(0, null, 'num');
echo '<pre>';
print_r($rows);
echo '</pre>';

// return a rowset with column names index
$rows = $sqlite->selectRows(1, 3);
echo '<pre>';
print_r($rows);
echo '</pre>';

// return a rowset with numeric index (but row 4 do not exist)
$rows = $sqlite->selectRows(2, 4, 'assoc');
echo '<pre>';
print_r($rows);
echo '</pre>';

// close SQLite connection
$sqlite->close();

// unset the object
unset($sqlite);

// delete the datadase file
unlink($path . 'test.db');
?>
