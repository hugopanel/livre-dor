<?php

// On se connecte à la base de données.
$db = mysqli_connect("localhost", "root", "", "livre-dor");

$result = "";

if (!$db) {
    // On affiche un message d'erreur
    $result = '<div class="card bg-danger" style="color: white">
            <div class="card-header">
                Erreur
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>Une erreur est survenue lors de la connexion avec la base de données. Veuillez réessayer plus tard.</p>
                </blockquote>
            </div>
        </div>';
} else {
    $db->set_charset("utf8");

    $query = "SELECT * FROM quotes ORDER BY Id DESC;";
    $query_result = mysqli_query($db, $query);

    if ($query_result) {
        if (mysqli_num_rows($query_result) == 0) {
            $result = '<div class="card bg-light" style="color: black">
                <div class="card-header">
                    Hmmmmm... 
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>Il n\'existe actuellement aucune citation dans la base de données.</p>
                    </blockquote>
                </div>
            </div>';
        } else {
            $random_num = rand(1, mysqli_num_rows($query_result));
            $i = 0;
            $random_quote = null;

            // On charge toutes les citations
            foreach ($query_result as $quote) {
                $i += 1;
                if ($i == $random_num) {
                    $random_quote = $quote;
                }
                $result .= '<div class="card card-quote">
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p>' . $quote["Text"] . '</p>
                            <footer class="blockquote-footer">' . $quote["Author"] . ', ' . $quote["Date"] . '</footer>
                        </blockquote>
                    </div>
                </div><br>';
            }

            $random_quote = '<div class="card card-quote">
                    <div class="card-header">
                        Citation aléatoire pour vous porter chance
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p>' . $random_quote["Text"] . '</p>
                            <footer class="blockquote-footer">' . $random_quote["Author"] . ', ' . $random_quote["Date"] . '</footer>
                        </blockquote>
                    </div>
                </div><br>';
        }
    } else {
        $result = '<div class="card bg-danger" style="color: white">
            <div class="card-header">
                Erreur
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>Une erreur est survenue lors de la connexion avec la base de données. Veuillez réessayer plus tard.</p>
                </blockquote>
            </div>
        </div>';
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
                        <img src="assets/brand/livredor-logo-gold.svg" alt="" style="max-height: 32px;">
                    </a>

                    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="#" class="nav-link px-2 link-secondary">Accueil</a></li>
                        <li><a href="add.php" class="nav-link px-2 link-dark">Ajouter une citation</a></li>
                        <li><a href="about.html" class="nav-link px-2 link-dark">A Propos du Livre d'or</a></li>
                        <li><a href="contact.html" class="nav-link px-2 link-dark">Contact</a></li>
                    </ul>

                    <div class="col-md-3 text-end">
                    </div>
                </header>
            </div>
        </header>

        <div class="p-5 mb-4 bg-light border rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Le Livre d'Or</h1>
                <p class="col-md-8 fs-4">Bienvenue sur le site du Livre d'Or ! Parcourez une réel <i>mine d'or</i> de citations toutes plus inspirantes les unes que les autres ! Surprise ! Vous pouvez même ajouter vos propres citations à la base de données !</p>
                <a class="btn btn-primary btn-lg" href="add.php">Ajouter une citation</a>
            </div>
        </div>

        <?php echo $random_quote; ?>
        <br>
        <?php echo $result; ?>

        <footer class="pt-3 mt-4 text-muted border-top">
            &copy; 2021, Evan ZANZUCCHI, Hugo PANEL, Jeremy SELLAM, Mohamed ZAMMIT CHATTI, Victor BOULET, Wilhem HARAT.
        </footer>
    </div>
</main>



</body>
</html>
