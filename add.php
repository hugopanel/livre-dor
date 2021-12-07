<?php

if (isset($_POST['button_submit'])) {
    // Si l'utilisateur accède à cette page avec le formulaire de rempli :
    // On peut poster la citation.

    $db = mysqli_connect("localhost", "root", "", "livre-dor");

    if (!$db) die("Impossible de se connecter à la base de données : " . mysqli_error($db));

    $db->set_charset("utf8");

    if (empty($_POST['quote'])) die("Veuillez saisir une citation.");
    if (empty($_POST['author'])) die("Veuillez saisir un auteur.");
    if (empty($_POST['year'])) die("Veuillez saisir une date.");

    //TODO: Vérifier si la citation n'existe pas déjà dans la base de données.

    // Création de la requête MySQL :
    $quote = mysqli_real_escape_string($db, $_POST['quote']);
    $author = mysqli_real_escape_string($db,  $_POST['author']);
    $year = mysqli_real_escape_string($db, $_POST['year']);

    $insert_quote_query = "INSERT INTO quotes (Text, Author, Date) VALUES ('$quote', '$author', $year)";

    // Exécution de la requête MySQL :
    if (mysqli_query($db, $insert_quote_query) === TRUE) {
        header("Location: /", true);
    } else {
        die("Impossible d'insérer la citation : " . mysqli_error($db));
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Evan ZANZUCCHI, Hugo PANEL, Jeremy SELLAM, Mohamed ZAMMIT CHATTI, Victor BOULET, Wilhem HARAT">
    <title>Le Livre d'Or - Recueil de citations</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="global.css">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


</head>
<body>

<main>
    <div class="container py-4">
        <header class="pb-3 mb-4">
            <div class="container">
                <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
                    <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
<!--                        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>-->
                        <img src="assets/brand/livredor-logo-gold.svg" alt="" style="max-height: 32px;">
                    </a>

                    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="index.php" class="nav-link px-2 link-dark">Accueil</a></li>
                        <li><a href="#" class="nav-link px-2 link-secondary">Ajouter une citation</a></li>
                        <li><a href="about.html" class="nav-link px-2 link-dark">A Propos</a></li>
                    </ul>

                    <div class="col-md-3 text-end">
<!--                        <button type="button" class="btn btn-outline-primary me-2">Login</button>-->
<!--                        <button type="button" class="btn btn-primary">Sign-up</button>-->
                    </div>
                </header>
            </div>
        </header>

        <div class="p-5 mb-4 bg-light border rounded-3">
            <div class="container-fluid">
                <h1 class="display-5 fw-bold">Ajouter une citation</h1>
                <p class="col-md-8 fs-4">Avant d'ajouter une citation, vérifier qu'elle respecte les règles de la communauté. Pour l'auteur, respectez la forme Prénom NOM.</p>
            </div>
        </div>

        <div class="card col-lg-8" style="margin: auto;">
            <div class="card-header">
                Ajouter une citation
            </div>
            <div class="card-body">
                <form action="add.php" method="post">
                    <div class="mb-3">
                        <label for="inputQuote" class="form-label">Citation</label>
                        <input type="text" class="form-control" id="inputQuote" name="quote">
                    </div>
                    <div class="mb-3">
                        <label for="inputAuthor" class="form-label">Auteur</label>
                        <input type="text" class="form-control" id="inputAuthor" name="author">
                    </div>
                    <div class="mb-3">
                        <label for="inputYear" class="form-label">Date (année)</label>
                        <input type="number" class="form-control" id="inputYear" name="year">
                    </div>
                    <button type="submit" class="btn btn-primary" name="button_submit">Publier</button>
                </form>
            </div>
        </div>

        <footer class="pt-3 mt-4 text-muted border-top">
            &copy; 2021, Evan ZANZUCCHI, Hugo PANEL, Jeremy SELLAM, Mohamed ZAMMIT CHATTI, Victor BOULET, Wilhem HARAT.
        </footer>
    </div>
</main>
</body>
</html>
