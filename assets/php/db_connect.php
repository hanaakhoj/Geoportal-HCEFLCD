<?php

/* Connexion à notre base de données */
$dbconn = pg_connect("host=localhost dbname=geoportail user=postgres password=ladygaga005@") or die('Connexion impossible : ' . pg_last_error());

?>
