<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=id20634685_projet_6;' , 'id20634685_root', '<[l?AdKm\ptF%{]6');

// Vérification de la session
if (!isset($_SESSION['identifiant'])) {
    // Utilisateur non connecté : redirection vers la page de connexion
    header("Location: connextion.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		
		<title></title>
    
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
			crossorigin="anonymous"
		/>
		<link rel="stylesheet" href="css/style.css" />
    
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
							<a class="nav-link active rounded-0" href="ajouter.php">Ajouter</a>
						</li>
                        <li class="nav-item pe-4">
							<a class="nav-link active rounded-0" href="index.php">Revenir vers le site</a>
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
                    <h1 class="text-capitalize py-3 redressed text-light">Bienvenue sur la page d'administration</h1>
                    <p class="redressed text-light font-weight-normal">
                    </p>                                       
                   </div> 
                </div>
            </div>

        </section>
        
        <section class="card my-5 border-0 rounded-0">          
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Modifier, Supprimer, Ajouter</h2>
                <div class="block">
                    <table class="data display datatable" id="example">
                        <thead>
                            <tr>
                                <th width="13%">Titre</th>
                                <th width="25%">Contenu</th>
                                <th width="10%">Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $recuperer = $bdd->query('SELECT id, titre, contenu, img FROM ajouter');
                            while($article = $recuperer->fetch()) {
                            ?>
                            <tr class="odd gradeX">
                                <td><?= substr($article['titre'], 0, 50); ?></td>
                                <td><?= substr($article['contenu'], 0, 50); ?></td>
                                <td>
                                    <img src="data:image/jpeg;base64,<?= base64_encode($article['img']); ?>" alt="Article Image" width="100" height="100">
                                <td>
                                    <a href="supprimer.php?id=<?= $article['id']; ?>">
                                    <button style="color:white; background-color:red; margin-bottom: 10px" class="styled" type="button">Supprimer</button>
                                    </a>
                                    <a href="modifier.php?id=<?= $article['id']; ?>">
                                    <button style="color:white; background-color:blue; margin-bottom: 10px" class="styled" type="button">Modifier</button>
                                    </a>
                                </td>

                                <!-- Ajouter le code pour afficher l'image de l'article -->
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>        
        </section>       

		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
			crossorigin="anonymous"
		></script>
	</body>
</html>

