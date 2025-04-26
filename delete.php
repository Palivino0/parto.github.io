<?php
include 'partial/functions.php';

if (isset($_GET['id_inscris'])) {
    $idToDelete = $_GET['id_inscris'];
    $connect = getConnection(); // Obtenez la connexion PDO

    $sql = "DELETE FROM `inscris` WHERE `id_inscris` = :id";
    $stmt = $connect->prepare($sql); // Utilisez $connect pour préparer la requête
    $stmt->bindParam(':id', $idToDelete, PDO::PARAM_INT); // Liez le paramètre en toute sécurité
    $stmt->execute(); // Exécutez la requête préparée

    header('Location: home.php');
    exit;
}
?>