<html>
    <body>
        
        <
<?php
try{
	$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=music_store_project','root','');
	echo "Connection is established...<br/>";
	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
        $query=$dbhandler->query('select * from music');
		while($r=$query->fetch()){
			//echo specific attributes
			//echo $r['message'], '<br/>';
			//echo all data in both format: numeric and associative
			echo $r['music_name'];
			echo "<br>";
		}
}
catch(PDOException $e){
	echo $e->getMessage();
	die();
}

echo "The rest of our page..."
?>
    </body>
</html>