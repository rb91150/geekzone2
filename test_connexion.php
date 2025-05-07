<?php
$db = new mysqli("localhost", "root", "", "geekzone_vitrine");

if ($db->connect_error) {
    die("Erreur de connexion : " . $db->connect_error);
}
echo "Connexion réussie à la base de données.";
