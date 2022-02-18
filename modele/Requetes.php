<?php

class Requetes
{
    // requête qui insère une ligne dans la table 'verification' composée de l'username, de son navigateur et de son IP
    public function insert($username, $navigateur, $adresse_ip)
    {
        require "config_db.php";
        if (!($stmt = $mysqli->prepare("INSERT INTO verification (username, navigateur, adresse_ip) VALUES (?, ?, ?)"))) {
            echo "Échec lors de la préparation : (" . $mysqli->errno . ") " . $mysqli->error;
        }

        if (!$stmt->bind_param("sss", $username, $navigateur, $adresse_ip)) {
            echo "Échec lors du liage des paramètres : (" . $stmt->errno . ") " . $stmt->error;
        }
        if (!$stmt->execute()) {
            echo "Échec lors de l'exécution de la requête : (" . $stmt->errno . ") " . $stmt->error;
        }
    }

    // permet de retourner tout le contenu de la table 'verification'
    public function selectAll(): mysqli_result
    {
        require "config_db.php";
        return mysqli_query($mysqli, 'SELECT username, navigateur, adresse_ip FROM verification');
    }

}