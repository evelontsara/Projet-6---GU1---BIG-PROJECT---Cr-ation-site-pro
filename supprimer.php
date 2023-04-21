<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=id20634685_projet_6;' , 'id20634685_root', '<[l?AdKm\ptF%{]6');

if (isset($_GET['id'])) {
    $get_id = $_GET['id'];
    $recup = $bdd->prepare ('SELECT * FROM  ajouter WHERE id = ?');
    $recup->execute(array($get_id));
    if($recup->rowCount() > 0){
        $suppr = $bdd->prepare('DELETE FROM ajouter WHERE id = ?');
        $suppr->execute(array($get_id));
        
        header('Location: admin.php');
        exit();


        echo 'article supprimer';
    }
}


?>