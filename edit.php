<?php
require ('partial/functions.php');
$connect = getConnection();

if (isset($_POST['btnedite']) && isset($_GET['id_inscris'])) {
    $idToEdit = htmlspecialchars(trim($_GET['id_inscris']));
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prénom']));
    $date_naissance = htmlspecialchars(trim($_POST['date_naissance']));
    $genre = htmlspecialchars(trim($_POST['genre']));
    $tel = htmlspecialchars(trim($_POST['tel']));
    $adresse = htmlspecialchars(trim($_POST['adresse']));

    if (empty($nom) || empty($prenom) || empty($date_naissance) || empty($tel) || empty($adresse)) {
        echo '<script>alert("Veuillez remplir tous les champs");</script>';
    } else {
        try {
            $sqlUpdateInscris = "UPDATE `inscris` SET `nom` = :nom, `prénom` = :prenom, `date_naissance` = :date_naissance, `genre` = :genre, `tel` = :tel, `adresse` = :adresse, `section` = :section WHERE `id_inscris` = :id";
            $stmtUpdateInscris = $connect->prepare($sqlUpdateInscris);

            // Calculer l'âge pour déterminer la section
            $age = (date('Y') - date('Y', strtotime($date_naissance)));
            $section = null;

            if ($genre === 'Garçon') {
                if ($age < 10) {
                    $section = 'St Ange';
                } elseif ($age >= 10 && $age <= 12) {
                    $section = 'St Tharcis';
                } elseif ($age > 12) {
                    $section = 'St Joseph';
                }
            } elseif ($genre === 'Fille') {
                if ($age < 10) {
                    $section = 'Antoinette Méo';
                } elseif ($age >= 10 && $age <= 12) {
                    $section = 'Sainte Marie';
                } elseif ($age > 12) {
                    $section = 'Autres Filles';
                }
            }

            $stmtUpdateInscris->bindParam(':nom', $nom);
            $stmtUpdateInscris->bindParam(':prenom', $prenom);
            $stmtUpdateInscris->bindParam(':date_naissance', $date_naissance);
            $stmtUpdateInscris->bindParam(':genre', $genre);
            $stmtUpdateInscris->bindParam(':tel', $tel);
            $stmtUpdateInscris->bindParam(':adresse', $adresse);
            $stmtUpdateInscris->bindParam(':section', $section); // Lier la section
            $stmtUpdateInscris->bindParam(':id', $idToEdit, PDO::PARAM_INT);

            if ($stmtUpdateInscris->execute()) {
                echo '<script>alert("Modification réussie");</script>';
                echo '<script>window.location.href = "home.php";</script>';
                exit();
            } else {
                echo '<script>alert("Aucune modification effectuée ou l\'ID spécifié n\'existe pas.");</script>';
            }

        } catch (PDOException $e) {
            echo '<script>alert("Erreur lors de la modification: ' . htmlspecialchars($e->getMessage()) . '");</script>';
        }
    }
} elseif (!isset($_GET['id_inscris'])) {
    echo '<script>alert("Aucun ID d\'inscription à modifier n\'a été spécifié.");</script>';
}

// Récupérer les informations de l'inscrit à modifier pour pré-remplir le formulaire
if (isset($_GET['id_inscris'])) {
    $idToEdit = htmlspecialchars(trim($_GET['id_inscris']));
    $sqlSelectInscris = "SELECT * FROM `inscris` WHERE `id_inscris` = :id";
    $stmtSelectInscris = $connect->prepare($sqlSelectInscris);
    $stmtSelectInscris->bindParam(':id', $idToEdit, PDO::PARAM_INT);
    $stmtSelectInscris->execute();
    $inscritToEdit = $stmtSelectInscris->fetch(PDO::FETCH_ASSOC);

    if (!$inscritToEdit) {
        echo '<script>alert("L\'inscription à modifier n\'existe pas."); window.location.href = "home.php";</script>';
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Espace de Modification</title>

        <!-- Bootstrap CSS -->
        <link href="st.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <div class="title">
            Modification
            </div>
            <form form action="" method="post">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Nom<strong class="text-danger"></strong>*</span>
                        <input type="text" class="form-control" id="nom" placeholder="Entrer votre nom" name="nom" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Prénom<strong class="text-danger"></strong>*</span>
                        <input type="text" class="form-control" id="prénom" placeholder="Entrer votre prénom" name="prénom" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Date de Naissance<strong class="text-danger"></strong>*</span>
                        <input type="date" class="form-control" id="date_naissance" placeholder="Entrer votre année de naissance" name="date_naissance" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Numéro de téléphone<strong class="text-danger"></strong>*</span>
                        <input type="tel" class="form-control" id="tel" placeholder="Entrer votre numéro de téléphone" name="tel" maxlength="10" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Lieu de résidence<strong class="text-danger"></strong>*</span>
                        <input type="text" class="form-control" id="adresse" placeholder="Entrer votre adresse" name="adresse" required>
                    </div>
                </div>
                <div class="gender-details">
                   <div class="category">
                        <label for="genre" class="gender-title">Genre: <strong class="text-danger"></strong>*</label>
                             <select class="form-select" id="genre" name="genre" required>
                                 <option value="">Sélectionner</option>
                                 <option value="Garçon">Garçon</option>
                                 <option value="Fille">Fille</option>
                             </select>
                    </div>
                </div>
                <div class="button">
                <button type="submit" name="btninscription" class="btn">
                    <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
                    Modifier
                    </button>
                </div>
            </form>
        </div>

        <!-- jQuery -->
        <script src="../Assets/jquery.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="../Assets/js/bootstrap.min.js"></script>
    </body>
</html>