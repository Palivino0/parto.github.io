<?php
require ('../partial/functions.php');
$connect = getConnection();

if (isset($_POST['btninscription'])) {
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
            $sqlInsertInscris = "INSERT INTO inscris (nom, prénom, date_naissance, genre, tel, adresse) VALUES (?, ?, ?, ?, ?, ?)";
            $stmtInsertInscris = $connect->prepare($sqlInsertInscris);
            $stmtInsertInscris->execute([$nom, $prenom, $date_naissance, $genre, $tel, $adresse]);
            $inscris = $stmtInsertInscris->fetch(PDO::FETCH_ASSOC);

            // Récupérer l'ID du dernier inscrit
            $lastInsertId = $connect->lastInsertId();

            // Calculer l'âge pour déterminer la section
            $age = (date('Y') - date('Y', strtotime($date_naissance)));
            $section = null;

            if ($genre === 'Garçon') {
                if ($age < 10) {
                    $section = 'St Ange';
                } elseif ($age >= 10 && $age <= 12) {
                    $section = 'St Tharcis';
                } elseif ($age > 12) {
                    $section = 'St Joseph'; // Section par défaut pour les garçons de plus de 12 ans
                    // Vous pouvez ajouter d'autres conditions ici si nécessaire
                }
            } elseif ($genre === 'Fille') {
                if ($age < 10) {
                    $section = 'Antoinette Méo';
                } elseif ($age >= 10 && $age <= 12) {
                    $section = 'Sainte Marie'; // Exemple de section pour les filles de cet âge
                } elseif ($age > 12) {
                    $section = 'Autres Filles'; // Section par défaut pour les filles de plus de 12 ans
                    // Vous pouvez ajouter d'autres conditions ici si nécessaire
                }
            }

            // Si une section a été déterminée, mettre à jour l'enregistrement avec la section
            if ($section !== null) {
                $sqlUpdateSection = "UPDATE inscris SET section = ? WHERE id_inscris = ?"; // Assurez-vous que 'id_inscris' est la clé primaire de 'inscris'
                $stmtUpdateSection = $connect->prepare($sqlUpdateSection);
                $stmtUpdateSection->execute([$section, $lastInsertId]);
            }
            echo '<script>alert("Inscription réussie");</script>';

        } catch (PDOException $e) {
            echo '<script>alert("Erreur lors de l\'inscription: ' . htmlspecialchars($e->getMessage()) . '");</script>';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Formulaire d'inscription</title>

        <!-- Bootstrap CSS -->
        <link href="../Assets/css/style.css" rel="stylesheet">

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
                Inscription
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
                        S'inscrire
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
