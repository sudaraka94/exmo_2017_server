<html>
<head>
	  <link href="../css/print.css" rel="stylesheet" type="text/css" media="print" /> <!-- siehe screen.css -->
    <link href="../css/screen.css" rel="stylesheet" type="text/css" media="screen, projection" /> 
    <!--[if lte IE 6]><link rel="stylesheet" href="../css/ielte6.css" type="text/css" media="screen" /><![endif]--> 
</head>
<body>
  <div id="container">
  	<div id="main">
        This sample PHP script shows how to use a SQLite database with Server2Go. 
        <br><br>
        <table style="font-size: 9pt;">
        	<tr>
        		<td style="background-color:#C9C8C8">Name</td>
                <td style="background-color:#C9C8C8">Quantity</td>
        		<td style="background-color:#C9C8C8">Price</td>
        	</tr>
			 <?php 
                include_once 'SPSQLiteClass-0.6\SPSQLite.class.php'; 
                
                $strDatabaseFile = str_replace("\\", "/", $_ENV["S2G_DB_PATH"]);
                                
                $sqlite =& new SPSQLite($strDatabaseFile."sqlitedb.db"); 
                
                // use the new function in a query 
                $sqlite->query("SELECT name, quantity, price FROM test"); 
                
                $rs = $sqlite->returnRows(); 
                
                $nIndex = 0;
                foreach($rs as $row)
                {
                 	$strColor = ($nIndexb % 2 == 0) ? "#E1E1E1" : "#F4f3f3";
                 	
                    echo "<tr style=\"background-color: $strColor;\">";
                    echo "<td>".$row["name"]."</td>";
                    echo "<td>".$row["quantity"]."</td>";
                    echo "<td>".$row["price"]."</td>";
                    echo '</tr>'; 
                    
                    $nIndex++;
                }
                
                $sqlite->close(); 
                unset($sqlite); 
             ?> 
   				
   	 </div>
   </div>
</body>
</html>