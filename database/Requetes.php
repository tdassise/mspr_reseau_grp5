<?php

require "config_db.php";

class Requetes
{
    public function insert($navigateur, $adresse_ip)
    {
        if (!($stmt = $mysqli->prepare("INSERT INTO verification (navigateur, adresse_ip) VALUES (?,?)"))) {
            echo "Échec lors de la préparation : (" . $mysqli->errno . ") " . $mysqli->error;
        }

        if (!$stmt->bind_param("ss", $navigateur, $adresse_ip)) {
            echo "Échec lors du liage des paramètres : (" . $stmt->errno . ") " . $stmt->error;
        }
        if (!$stmt->execute()) {
            echo "Échec lors de l'exécution de la requête : (" . $stmt->errno . ") " . $stmt->error;
        }
    }

}