<?php
//	====================================
//			ALTER TABLE EMULATION		
//	====================================
//	Note: the changement of type not 
//	influence the values of table.
//	SQLite is TYPELESS!!
//	http://www.sqlite.org/datatypes.html
//	Basically any sequence of names 
//	optionally followed by one or two 
//	signed integers in parentheses will 
//	do (not try ENUM('y','n') ecc ...)
//	And if you ever port your code to 
//	another database engine type is good.
//	------------------------------------

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

// define name and type to new altered table (all colums)
$newColsDefinition = array('id' => 'INTEGER PRIMARY KEY', 
						   'name' => 'VARCHAR(10)', 
						   'quantity' => 'SMALLINT', 
						   'price' => 'INT(3)'
						   );

// modify the type of columns (test table)
$sqlite->alterTable('test', $newColsDefinition);

// verify modification
$table = $sqlite->getTableInfo('test');
echo '<pre>';
print_r($table);
echo '</pre>';

// modify type, name of columns
$newColsDefinition = array('id_pet' => 'INTEGER PRIMARY KEY',
						   'nome' => 'VARCHAR(5)', 
						   'prezzo' => 'INT(5)'
						   );

// copy only this old columns in the new altered table
// Es: id->id_pet, name->nome, price->prezzo (delete column quantity)
$sourceCols = array('id', 'name', 'price');

// define a columns target
$targetCols = array_keys($newColsDefinition);

// alter table structure
$sqlite->alterTable('test', $newColsDefinition, $sourceCols, $targetCols);

// verify the result
$table = $sqlite->getTableInfo('test');
echo '<pre>';
print_r($table);
echo '</pre>';

// close SQLite connection
$sqlite->close();

// unset the object
unset($sqlite);

// delete the datadase file
unlink($path . 'test.db');
?>
