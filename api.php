<?php
    session_start();

    $bdd = new PDO('mysql:host=localhost;dbname=arene','root','root',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $id_personnage = $_SESSION['id_personnage'];
    $id_personnage_deux = $id_personnage + 3;

    try{
        $req = $bdd->prepare("SELECT * from joueur JOIN personnage ON joueur.id_joueur = personnage.id_joueur WHERE personnage.id_personnage >= ? && personnage.id_personnage <= ?");

        $req->bindParam(1,$id_personnage,PDO::PARAM_INT);
        $req->bindParam(2,$id_personnage_deux,PDO::PARAM_INT);

        $req->execute();

        $data = $req->fetchAll();

        header('Content-Type: application/json','Access-Control-Allow-Origin : *');
        $result = json_encode($data, JSON_PRETTY_PRINT);
        echo $result;

        $_SESSION['id_personnage'] = $_SESSION['id_personnage'] + 4;

        return $result;
    }
    catch(Exception $error){
        die('Error :'.$error->getMessage());
    }
?>