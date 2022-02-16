<?php


class Requetes
{
    public function insert($navigateur, $adresse_ip)
    {
        include "config_db.php";
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

    public function selectAll()
    {
        include "config_db.php";
        if (!($stmt = $mysqli->prepare("SELECT * FROM verification"))) {
            echo "Échec lors de la préparation : (" . $mysqli->errno . ") " . $mysqli->error;
        }
        if (!$stmt->execute()) {
            echo "Échec lors de l'exécution de la requête : (" . $stmt->errno . ") " . $stmt->error;
        }
    }

}