<html>
<head>
	  <link href="../css/print.css" rel="stylesheet" type="text/css" media="print" /> <!-- siehe screen.css -->
    <link href="../css/screen.css" rel="stylesheet" type="text/css" media="screen, projection" /> 
    <!--[if lte IE 6]><link rel="stylesheet" href="../css/ielte6.css" type="text/css" media="screen" /><![endif]--> 
</head>
<body>
  <div id="container">
  	<div id="main">
        This sample PHP script shows how to use a MySQL database with Server2Go. 
        <br><br>
        <table style="font-size: 9pt;">
        	<tr>
        		<td style="background-color:#C9C8C8">Name</td>
                <td style="background-color:#C9C8C8">Quantity</td>
        		<td style="background-color:#C9C8C8">Price</td>
        	</tr>
			 <?php 
                $nConnection = mysql_connect("localhost", "root", "");
	
            	if ($nConnection)
            	{
            		//--- get maximum count of users
            		if (mysql_select_db("Server2Go", $nConnection))
            		{
            			$query = "select * from items";
            			$nResult = mysql_query($query, $nConnection);
            
            			if ($nResult)
            			{
            				if (mysql_num_rows($nResult) > 0)
            				{
            				    $nIndex = 0;
            					while (	$arrRow = mysql_fetch_array($nResult))
            					{
					    		 	$strColor = ($nIndex % 2 == 0) ? "#E1E1E1" : "#F4f3f3";
                 	
                                    echo "<tr style=\"background-color: $strColor;\">";
                                    echo "<td>".$arrRow["name"]."</td>";
                                    echo "<td>".$arrRow["quantity"]."</td>";
                                    echo "<td>".$arrRow["price"]."</td>";
                                    echo '</tr>'; 
                                    
                                    $nIndex++;
                                }
                            }
                        }
                    }
                }
             ?> 
   				
   	 </div>
   </div>
</body>
</html>