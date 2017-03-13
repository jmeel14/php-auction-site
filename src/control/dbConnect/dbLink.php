<?PHP
    $db_gWay = "mysql:host=HOST_VALUE;dbname=DB_NAME";
	$db_uName = 'root';
	$db_pWord = '';
	
	try {
		$conn = new PDO($db_gWay,$db_uName,$db_pWord);

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo "<p>Unfortunately, an error has occurred in establishing a connection to the database.</p>";
		echo "<b>" . $e->getMessage();
	}
