<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=id20634685_projet_6;' , 'id20634685_root', '<[l?AdKm\ptF%{]6');

if (isset($_POST['envoi'])) {
    if(!empty($_POST['titre']) && !empty($_POST['contenu'])) {
        $titre = htmlspecialchars($_POST['titre']);
        $contenu = nl2br(htmlspecialchars($_POST['contenu']));

       
        if(isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
            $image = 'uploads/' . $_FILES['img']['name'];
            move_uploaded_file($_FILES['img']['tmp_name'], $image);
        } else {
            $image = null;
        }

        $inserer = $bdd->prepare('INSERT INTO ajouter(titre, contenu, img) VALUES(?, ?, ?)');
        $inserer->execute(array($titre, $contenu, $image));

        echo 'Terminé !';
    } else {
        echo "Il faut remplir tous les champs svp";
    }
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"/>
		<link rel="stylesheet" href="css/perso.css" />
	</head>
	<body>
    <nav class="cc-navbar navbar navbar-expand-lg position-fixed navbar-dark w-100">
			<div class="container-fluid">
				<div class="container">
                    
                  </div>
				<button
					class="navbar-toggler"
					type="button"
					data-bs-toggle="collapse"
					data-bs-target="#navbarSupportedContent"
					aria-controls="navbarSupportedContent"
					aria-expanded="false"
					aria-label="Toggle navigation"
				>
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item pe-4">
							<a class="nav-link active rounded-0" href="admin.php">Retour</a>
						</li>
					</ul>
					</form>
				</div>
			</div>
		</nav>
        
		<section class="bgt-gris banner d-flex align-items-center pt-5">
			<div id="presentation" class="container my-5 py-5">
				<div class="row">
					<div class="col-md-6">
						<h1 class="text-capitalize py-3 redressed text-light">Ajouter</h1>
						<form class="redressed text-light font-weight-normal" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="titre">Titre :</label>
                                <input type="text" name="titre" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="contenu">Contenu :</label>
                                <textarea name="contenu" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Image :</label>
                                <input type="file" name="img" class="form-control">
                            </div>
                            <button type="submit" name="envoi" class="btn btn-primary">Créer</button>
                        </form>                                     
					</div> 
				</div>
			</div>
		</section>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
	</body>
</html>

<!--

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=projet_6;' , 'root', '');

if (isset($_POST['envoi'])) {
    if(!empty($_POST['titre']) && !empty($_POST['contenu'])) {
        $titre = htmlspecialchars($_POST['titre']);
        $contenu = nl2br(htmlspecialchars($_POST['contenu']));

        // Vérifier si une image a été uploadée
        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image_path = 'uploads/' . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
        } else {
            $image_path = null;
        }

        $inserer = $bdd->prepare('INSERT INTO ajouter(titre, contenu, image_path) VALUES(?, ?, ?)');
        $inserer->execute(array($titre, $contenu, $image_path));

        echo 'Terminé !';
    } else {
        echo "Il faut remplir tous les champs svp";
    }
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"/>
		<link rel="stylesheet" href="css/perso.css" />
	</head>
	<body>
		<section class="bgt-gris banner d-flex align-items-center pt-5">
			<div id="presentation" class="container my-5 py-5">
				<div class="row">
					<div class="col-md-6">
						<h1 class="text-capitalize py-3 redressed text-light">Ajouter</h1>
						<form class="redressed text-light font-weight-normal" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label for="titre">Titre :</label>
								<input type="text" name="titre" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="contenu">Contenu :</label>
								<textarea name="contenu" class="form-control" required></textarea>
							</div>
							<div class="form-group">
								<label for="image">Image :</label>
								<input type="file" name="image" class="form-control-file">
							</div>
							<button type="submit" name="envoi" class="btn btn-primary">Créer</button>
						</form>                                       
					</div> 
                </div>
			</div>
		</section>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
	</body>
</html>
-->			
