<?php
session_start();
//connexion à la base de bonnée
function getConnection(){
    $host = 'localhost';
    $dbname = 'patro_db';
    $user = "root";
    $pwd = "";
    $url = "mysql:host=$host;dbname=$dbname";
    // $url = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $connect = null;
    // $connect = new PDO($url, $user, $pwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"));
    try{
        $connect = new PDO($url, $user, $pwd);
    }
    catch(\Throwable $th){
    die("Erreur de connexion à la base de donnée: ".$th->getMessage());
}
return $connect; 
}

function loginAdmin($u,$p){
    $connect = getConnection();
    $result = [];
    $sql = "SELECT * FROM admin WHERE username = ? AND pwd = ?";
    try{
       $stmt = $connect->prepare($sql);
//exécution de la requete
         $stmt->execute([$u,$p]);
         if($stmt->rowCount() > 0){
             $result = $stmt->fetch(PDO::FETCH_ASSOC);
         }
    }
    catch(\Throwable $th){
        die("Erreur de connexion à la base de donnée: ".$th->getMessage());
    }
    return $result; 
}


function getGarconList($table, $section = null){
    $result = [];
    $sql = "SELECT * FROM $table";
    $conditions = [];
    $params = [];

    if ($section !== null) {
        $conditions[] = "section = ?";
        $params[] = $section;
    }

    if (!empty($conditions)) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    try{
        $stmt = getConnection() -> prepare($sql);
        $stmt -> execute($params);
        if($stmt->rowCount() > 0){
            $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }
    }
    catch(\Throwable $th){
        die("Erreur de selection: ".$th->getMessage()); // Correction: Utiliser getMessage() pour l'erreur PDO
    }
    return $result;
}

function Existe($table, $field, $value, $type ="one"){
    $result = [];
    $sql = "SELECT * FROM $table WHERE $field = ?";
    try{
       $stmt = getConnection()->prepare($sql);
//exécution de la requete
         $stmt->execute([$value]);
         if($stmt->rowCount() > 0){
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($type == "all"){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
         }
    }
    catch(\Throwable $th){
        die("Erreur de selection: ".$th->getMessage());
    }
    return $result; 
}

?>