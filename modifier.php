<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=id20634685_projet_6;' , 'id20634685_root', '<[l?AdKm\ptF%{]6');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $get_id = $_GET['id'];

    $recup = $bdd->prepare('SELECT * FROM ajouter WHERE id = ?');
    $recup->execute(array($get_id));
    if($recup->rowCount() > 0){
        $info = $recup->fetch();
        $titre = $info['titre'];
        $contenu = str_replace('<br />', '', $info['contenu']);

        if (isset($_POST['modifier'])) {
            $modif_titre = htmlspecialchars($_POST['titre']);
            $modif_contenu = nl2br(htmlspecialchars($_POST['contenu']));

            $modifier = $bdd->prepare('UPDATE ajouter SET titre = ?, contenu = ? WHERE id = ?');
            $modifier->execute(array($modif_titre, $modif_contenu, $get_id));

            header('Location: admin.php');
            exit();
        }
    }
}
?>

<html>
<head>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="css/perso.css" media="screen" type="text/css" />
    <style>
        label {
            display: block;
            margin-bottom: 10px;
        }
        textarea {
            width: 100%;
            height: 150px; 
            resize: vertical; 
        }
    </style>
</head>
<body>
<div id="container">
    <!-- zone de connexion -->

    <form action="" method="POST">
        <h1>Modifier</h1>

        <label><b>Titre</b></label>
        <input type="text" placeholder="Modifier le titre" name="titre" id="titre" value="<?php echo $titre; ?>" required>

        <label for="contenu"><b>Contenu</b></label>
        <textarea name="contenu" id="contenu" placeholder="Modifier le contenu" required><?php echo $contenu; ?></textarea>

        <input type="submit" id='submit' value='modifier' name='modifier'>
        
    </form>
</div>
</body>
</html>


