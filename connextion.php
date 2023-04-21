<?php

session_start();


$host = "localhost";
$dbname = "id20634685_projet_6";
$username = "id20634685_root";
$password = "<[l?AdKm\ptF%{]6";

try {
   
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $identifiant = $_POST['identifiant'];
        $motdepasse = $_POST['motdepasse'];
        
      
        $motdepasse_hache = password_hash($motdepasse, PASSWORD_DEFAULT);
        
       
        $req = $pdo->prepare("UPDATE utilisateurs SET motdepasse=:motdepasse WHERE identifiant=:identifiant");
        $req->bindParam(':identifiant', $identifiant);
        $req->bindParam(':motdepasse', $motdepasse_hache);
        $req->execute();
        
     
        $req = $pdo->prepare("SELECT motdepasse FROM utilisateurs WHERE identifiant=:identifiant");
        $req->bindParam(':identifiant', $identifiant);
        $req->execute();
        $result = $req->fetch();
        
        if (password_verify($motdepasse, $result['motdepasse'])) {
           
            $_SESSION['identifiant'] = $identifiant;
            header("Location: admin.php");
            exit();
        } else {
            
            echo "Identifiant ou mot de passe incorrect";
        }
    }
} catch (PDOException $e) {

    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}

?>

