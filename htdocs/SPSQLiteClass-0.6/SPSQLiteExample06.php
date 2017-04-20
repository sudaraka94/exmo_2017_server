<?php
//	====================================
//	GET INFORMATION ON TABLE AND COLUMNS
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

// get information on table
$table = $sqlite->getTableInfo('test');
echo '<pre>';
print_r($table);
echo '</pre>';

// get specific 'sql' information on table
$col = $sqlite->getTableInfo('test', 'sql');
echo '<pre>';
print_r($col);
echo '</pre>';

// get information on columns of current table
$type = $sqlite->getColsType();
echo '<pre>';
print_r($type);
echo '</pre>';

// get information on column id of current table
$col = $sqlite->getColsType('id');
echo '<pre>';
print_r($col);
echo '</pre>';

// close SQLite connection
$sqlite->close();

// unset the object
unset($sqlite);

// delete the datadase file
unlink($path . 'test.db');
?>
