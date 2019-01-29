<?php
//pripojeni do db na serveru eso.vse.cz
$db = new PDO('mysql:host=127.0.0.1;dbname=navd00;charset=utf8', 'navd00', 'AySNicKFCf0QjrbZzU');

//vyhazuje vyjimky v pripade neplatneho SQL vyrazu
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION)

?>