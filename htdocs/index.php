<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Server2Go - Selfconfigurating WAMP Stack</title>
	<link rel="stylesheet" href="format.css" type="text/css">
</head>
<body>
	<div id="main">
		<div id="headline">
			<img style="float: left" src="images/logo.png" alt="Server2Go"/>
			<div style="float: right; text-align: right; padding-right: 6px; position: relative; top: 60px;">
				<h2><?php echo str_replace("Server2Go", "Version", $_ENV["S2G_SERVER_SOFTWARE"]);?></h2>
				<h2>Selfconfigurating Webserver</h2>
				
			</div>	
		</div>
		<div id="stylefour">
			<ul>
				<li><a class="current" href="index.php">Home</a></li>
				<li><a href="http://www.server2go-web.de/wiki" target="_blank">Documentation (Online)</a></li>
			</ul>
		</div>		
		<div id="content">
			<h2>Congratulations</h2>
			Reading this means you are running Server2Go successfully. Your installed version supports the following software:
			
			<div class="help">
			<?php
                            $arrParts = explode(" ", $_SERVER["SERVER_SOFTWARE"]);
                        ?>
                       <li><?php echo $arrParts[0]." ".$arrParts[1];?></li>
                   	   <li><?php echo $arrParts[2];?></li>
                   	   <li>SQLite 2</li>
                   	   <?php 
                   	   		 if ( ($_ENV["S2G_EDITION"] == "PSM") || ($_ENV["S2G_EDITION"] == "PSMP") )
                   	   		 {
                                $nConnection = mysql_connect("localhost", "root", "");
                                if ($nConnection)
                                {
                                    echo "<li>";
                                    echo "MySQL ".mysql_get_server_info();
                                    echo "</li>";
                                }
                   	   		 }
                   	   		 
                   	   		 if ($_ENV["S2G_EDITION"] == "PSMP")
                   	   		 {
                   	   		  	echo "<li>Perl 5.8</li>";
                   	   		 }
                   	   ?>
			</div>
		 If you need another version of Server2Go(i.e. with MySQL or a different Apache-Version) you can get it under <a href="http://www.server2go-web.de" target="_blank">www.server2go-web.de</a>
		 
			<h2>Main Features</h2>
			<ul style="margin-top: 2px; ">
				<li>Free! No royalties</li>
			       <li>Complete WAMPP Server</li>
				   <li>Runs directly from CD-ROM, USB Stick or Harddisk without installation</li>
				   <li>Full featured webserver (based on apache)</li>
				   <li>PHP 5.x support with many extensions installed (i.e. gd)</li>
				   <li>Supports SQLite databases</li>
				   <li>Running on all Windows Win 98 and newer</li>
				   <li>Support for MySQL 5 Databases</li>
				   <li>Supports many PHP extensions (GD-Lib, PDO...) by default</li>
				   <li>Support for Perl 5.8</li>

			</ul>
			<h2>License</h2>
			   Server2Go is Donationware. That means you can download and use it for free and you don't have to pay
			   any royalty charges when distribute an application on CD-ROM that uses Server2Go. But if you use it 
			   commercially or just want to say "thank you" you should donate to the project. How to donate? Just take
			   a look at the <a href="http://www.server2go-web.de/donation/donation.html" target="_blank">donation</a> page. There are a lot of inexpensive possibilities
			   to help.<br />
			   <a href="http://www.server2go-web.de/donation/donation.html" target="_blank"><img src="images/donate.png" /></a><br />
			   Every donator is getting a user id and password with that he can download additional software that is not public 
			   available. Take a look at .the Server2Go <a href="http://www.server2go-web.de/download/download.html" target="_blank">download</a> page for more information about the VIP downloads
		</div>
		<div id="rightbar">
			<div class="barcrumb">
				<h3>Samples PHP</h3>
				<a href="phpinfo.php">PHP Informations</a><br />
				<a href="gdlib.php">GD-Lib Test</a><br />
				<a href="sqlitedb.php">SQLite Test</a><br />
				<?php 
						 if ( ($_ENV["S2G_EDITION"] == "PSM") || ($_ENV["S2G_EDITION"] == "PSMP") )
						 {
							echo "<a href=\"mysql.php\">MySQL Test</a>";
						 }
						 else
						 {
							 echo "MySQL Test <strong>(MySQL not installed)</strong>";
						 }
				   ?>
			</div>
			<div class="barcrumb">
				<h3>Samples Perl</h3>
				<?php 
						 if ( $_ENV["S2G_EDITION"] == "PSMP") 
						 {
							echo "<a href=\"/cgi-bin/printenv.pl\">Environment Variables</a>";
						 }
						 else
						 {
							 echo "Environment Variables <strong>(Perl not installed)</strong>";
						 }
				   ?>	
			</div>
			<div class="barcrumb">
				<h3>Tools</h3>
				MySQL: <a href="phpmyadmin">phpMyAdmin</a><br />
			</div>
			<div class="barcrumb">
				<h3>License</h3>
				License: Donationware<br />
				<a href="http://www.server2go-web.de/donation/donation.html" target="_blank">Make a donation</a><br />
				
			</div>
			<div class="barcrumb">
				<h3>Links</h3>
				Forum: <a href="http://www.server2go-web.de/forum" target="_blank">Forum</a><br />
				Wiki: <a href="http://www.server2go-web.de/wiki" target="_blank">Dokumentation &amp; Tutorials</a>
			</div>
		</div>
		<div id="footer">
			<a href="http://validator.w3.org/check/referer">XHTML 1.1</a> |
			Copyright by Timo Haberkern
		</div>
	</div>
</body>
</html>
