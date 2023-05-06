<?php 

$mysql = new mysqli (
	'localhost', // locatia serverului (aici, masina locala)
	'root',       // numele de cont
	'',    // parola (atentie, in clar!)
	'users'   // baza de date
	);

    if (mysqli_connect_errno()) {
        die ('Conexiunea a esuat...');
    }
?>