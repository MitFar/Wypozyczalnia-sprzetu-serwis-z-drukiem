<html>
<head>
<meta charset="UTF-8">
   <link href="style3.css" rel="stylesheet">
	
</head>
<body>
	<?php include 'menu_bez_css.php'; ?>
	<?php
	include 'polacz_z_baza.php';

	$sql = "SELECT * FROM klient";
	$result = mysqli_query($conn, $sql);
	//tabela
	if (mysqli_num_rows($result) > 0) {
	    echo "<table>";
	    echo "<tr><th>ID</th><th>Imię</th><th>Nazwisko</th><th>Email</th><th>Dowód/Nip</th><th>firma</th><th>Ulica</th><th>Miejscowość</th><th>Kod pocztowy</th><th>Miasto</th><th>Numer tel</th><th>Email</th><th>kto wydał?</th><th>Uwagi</th></tr>";
	        while($row = mysqli_fetch_assoc($result)) {
	        echo "<tr><td>".$row["id_klienta"]."</td><td>".$row["imie"]."</td><td>".$row["nazwisko"]."</td><td>".$row["email"]."</td><td>".$row["numer_dowodu_nip"]."</td><td>".$row["firma"]."</td>
			<td>".$row["ulica"]."</td><td>".$row["miejscowosc"]."</td><td>".$row["kod_pocztowy"]."</td><td>".$row["miasto"]."</td><td>".$row["numer_tel"]."</td><td>".$row["email"]."</td><td>".$row["kto_wydal"]."</td><td>".$row["uwagi"]."</td></tr>";
	    }
	    echo "</table>";
	} else {
	    echo "Brak wyników.";
	}
	mysqli_close($conn);

	//wyszukiwanie po nazwisku
	if(isset($_POST['submit'])) {
		$host = "localhost";
		$username = "root";
		$password = "";
		$dbname = "Baza";
		$conn = mysqli_connect($host, $username, $password, $dbname);
		if (!$conn) {
		    die("Nie udało się połączyć z bazą danych: " . mysqli_connect_error());
		}
	    $nazwisko = $_POST['nazwisko'];
		$sql = "SELECT * FROM klient WHERE nazwisko LIKE '%$nazwisko%'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			//tabela
			echo "<h2>Wyniki wyszukiwania:</h2>";
		    echo "<table class='result'>";
		    echo "<tr><th>ID</th><th>Imię</th><th>Nazwisko</th><th>Email</th><th>Numer tel</th></tr>";
		        while($row = mysqli_fetch_assoc($result)) {
		        echo "<tr><td>".$row["id_klienta"]."</td><td>".$row["imie"]."</td><td>".$row["nazwisko"]."</td><td>".$row["email"]."</td><td>".$row["numer_tel"]."</td></tr>";
		    }
		    echo "</table>";
		} else {
		    echo "Brak wyników.";
		}
		mysqli_close($conn);
	}
	?>

	<!-- formularz do wyszukiwania klienta po nazwisku -->
	<form method="post">
		<label for="nazwisko">&nbsp Wyszukaj klienta po nazwisku:</label>
		<input type="text" name="nazwisko" placeholder="wpisz nazwisko">
		<button type="submit" name="submit">Szukaj</button>
	</form>

</body>

</html>




