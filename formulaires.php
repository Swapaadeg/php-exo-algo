<?php
ob_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaires</title>
</head>
<body>
<!-- EXO 1 -->
    <h2>1. Requête GET via URL</h2>

    <?php
    if(isset($GET ['ville']) && isset($_GET['transport'])) {
        $ville = $_GET['ville'];
        $email = $_GET['transport'];
        echo '"La ville choisie est ' . htmlspecialchars($_GET["ville"]) . ' et le voyage se fera en ' . htmlspecialchars($_GET["transport"]) . ' !"';
    }
    // echo '"La ville choisie est ' . htmlspecialchars($_GET["ville"]) . ' et le voyage se fera en ' . htmlspecialchars($_GET["transport"]) . ' !"';
    ?>

    <!-- if(isset($_POST ['nom']) && isset($_POST['email'])) {   On peut remplacer isset par !empty (attention 0 et un " " sont considérés comme empty)
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    
    echo $nom . " " . $email;
} -->

<!-- EXO 2 -->
    <h2>2. Requête GET via Formulaire</h2>
    <form action="formulaires.php" method = "get">
        <input type="text" name = "animal">
        <button>valider</button>
    <?php
    echo '"Votre animal choisi est ' . htmlspecialchars($_GET["animal"]);
    ?>
    </form>

    <!-- EXO 3 -->
    <h2>3. Requête POST</h2>

    <form action="formulaires.php" method = "post">
        <input type="text" name = "name" placeholder = "écrire votre pseudo">
        <input type="color" name="color">
        <button>valider</button>
    </form>
    <style>
        <?php
        echo "body { background-color: ".$_POST["color"].";}";
        ?>
    </style>
    <?php
    echo '"Bonjour ' . htmlspecialchars($_POST["name"]) . ' "';
    ?>
    </form>

    <!-- EXO 4  -->
    <h2>4. Dés numériques</h2>

    <form action="formulaires.php" method="post">
        <input type="number" name="max" placeholder="Entrez une valeur multiple de 6" required>
        <button type="submit" name="submit">Lancer le dé</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
        $max = $_POST['max'];

        if (!is_numeric($max) || $max <= 0) {
            header("Location: formulaires.php?error=invalide");
            exit();
        }

        if ($max % 6 !== 0) {
            header("Location: formulaires.php?error=notmultiple");
            exit();
        }

        $resultat = rand(1, $max);
        echo "Résultat : $resultat";
    }

    if (isset($_GET['error'])) {
        if ($_GET['error'] === 'notmultiple') {
            echo "<p style='color:red;'>Erreur : la valeur doit être un multiple de 6.</p>";
        }
        if ($_GET['error'] === 'invalide') {
            echo "<p style='color:red;'>Erreur : veuillez entrer un nombre valide supérieur à 0.</p>";
        }
    }
    ?>

<!-- EXO 5 -->
    <h2>5. Authentification</h2>
    <form action="formulaires.php" method="POST">
    <input type="text" name="admin" placeholder="Nom d'utilisateur" required>
    <input type="password" name="password" id="password" placeholder="Mot de Passe" required >
    <button name="connexion">Connexion</button>
    </form>

    <?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['connexion'])) {

        if (empty($_POST['admin'])) {
            echo "Mettez votre nom d'utilisateur";
        }

        if (empty($_POST['password'])) {
            echo "Insérez votre mot de passe";
        }

        if (!empty($_POST['admin']) && !empty($_POST['password'])) {
            $valid_username = 'admin';
            $stored_hash = '$2y$10$BqWXs4YKCmyMWT7DkRkjze76qzEzpKKQCynnnprVw.A/zV3wp8tFq';
            $username = $_POST['admin'];
            $password = $_POST['password'];

            if ($username === $valid_username && password_verify($password, $stored_hash)) {
                $_SESSION['connected'] = true;
                header("Location: index.php");
                exit();
            } else {
                echo "Identifiants incorrects";
            }
        }
    }
    ?>

    <!-- EXO 6 -->
    <h2>6.Calculatrice</h2>
    <form action="formulaires.php" method="post">
        <input type="number" name="nombre1" placeholder="Nombre 1" required>
        <input type="number" name="nombre2" placeholder="Nombre 2" required>
        
        <select name="operation" required>
            <option value="">-- Choisir une opération --</option>
            <option value="+">Addition (+)</option>
            <option value="-">Soustraction (-)</option>
            <option value="x">Multiplication (x)</option>
            <option value="÷">Division (÷)</option>
        </select>
        
        <button type="submit" name="calculer">Calculer</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["calculer"])) {
        $n1 = $_POST["nombre1"];
        $n2 = $_POST["nombre2"];
        $op = $_POST["operation"];
        $resultat = null;

        switch ($op) {
            case "+":
                $resultat = $n1 + $n2;
                break;
            case "-":
                $resultat = $n1 - $n2;
                break;
            case "x":
                $resultat = $n1 * $n2;
                break;
            case "÷":
                if ($n2 == 0) {
                    echo "<p style='color:red;'>Erreur : division par zéro impossible.</p>";
                    return;
                }
                $resultat = $n1 / $n2;
                break;
            default:
                echo "<p style='color:red;'>Opération non valide.</p>";
                return;
        }
        echo "Résultat : $resultat";
    }
    ?>

    <!-- EXO 7 -->
    <h2>7.Convertisseur d'Euros</h2>
    <form action="formulaires.php" method="post">
        <input type="number" name="euros" step="0.01" placeholder="Montant en €" required>
        <select name="devise" required>
            <option value="">-- Choisir une devise --</option>
            <option value="usd">Dollars</option>
            <option value="gbp">Livres</option>
            <option value="yen">Yen</option>
        </select>
        <button type="submit" name="convertir">Convertir</button>
    </form>

    <?php
    if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['convertir'])) {
        $euros= floatval($_POST['euros']);
        $devise = $_POST['devise'];
        $resultat = null;

        $taux = [
            'usd' => 1.13,
            'gbp' => 0.84,
            'yen' => 163.40,
        ];

        if(isset($taux[$devise])) {
            $resultat = $euros * $taux[$devise];
            echo "<p>$euros € = <strong>" . round($resultat, 2) . " " . strtoupper($devise) . "</strong></p>";
        } else {
            echo "<p style='color:red;'>Devise inconnue.</p>";
        }
    }
    ?>

    <!-- EXO 8 -->
    <h2>8.Quizz</h2>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $score = 0;

        $reponses_correctes = [
            'q1' => 'C',
            'q2' => 'A',
            'q3' => 'B',
        ];

        $explications = [
            'q1' => "C. Un événement où la Peintresse efface les personnes atteignant un certain âge",
            'q2' => "A. Lune",
            'q3' => "B. Détruire la Peintresse pour mettre fin au Gommage",
        ];

        echo "<h2>Résultats du quiz</h2>";

        foreach ($reponses_correctes as $question => $bonne_reponse) {
            echo strtoupper($question);

            if (isset($_POST[$question])) {
                $reponse_utilisateur = $_POST[$question];

                if ($reponse_utilisateur === $bonne_reponse) {
                    echo "<p style='color: green;'> Bonne réponse !</p>";
                    $score++;
                } else {
                    echo "<p style='color: red;'> Mauvaise réponse. Vous avez répondu : $reponse_utilisateur</p>";
                    echo "<p> La bonne réponse était : " . $explications[$question] . "</p>";
                }
            }
        }
        echo "<h2> Score final : $score / " . count($reponses_correctes) . "</h2>";
        echo "<p><a href=''>Rejouer le quiz</a></p>";
    } else {
    ?>

    <form action="" method="post">
        <!-- Question 1 -->
        <div class="question">
            <p>1. Quel est le principe du "Gommage" dans l'univers de Clair Obscur: Expedition 33 ?</p>
            <label><input type="radio" name="q1" value="A"> A. Une épreuve de purification pour les membres de l'expédition</label><br>
            <label><input type="radio" name="q1" value="B"> B. Un rituel de renaissance célébré chaque année</label><br>
            <label><input type="radio" name="q1" value="C"> C. Un événement où la Peintresse efface les personnes atteignant un certain âge</label><br>
            <label><input type="radio" name="q1" value="D"> D. Une cérémonie de promotion des soldats de Lumière</label>
        </div>

        <!-- Question 2 -->
        <div class="question">
            <p>2. Quel personnage est reconnu pour ses talents de mage et de soutien dans l'équipe de l'Expédition 33 ?</p>
            <label><input type="radio" name="q2" value="A"> A. Lune</label><br>
            <label><input type="radio" name="q2" value="B"> B. Sciel</label><br>
            <label><input type="radio" name="q2" value="C"> C. Maelle</label><br>
            <label><input type="radio" name="q2" value="D"> D. Verso</label>
        </div>

        <!-- Question 3 -->
        <div class="question">
            <p>3. Quelle est la mission principale de l'Expédition 33 ?</p>
            <label><input type="radio" name="q3" value="A"> A. Explorer les ruines de Lumière</label><br>
            <label><input type="radio" name="q3" value="B"> B. Détruire la Peintresse pour mettre fin au Gommage</label><br>
            <label><input type="radio" name="q3" value="C"> C. Capturer des créatures mythiques pour les étudier</label><br>
            <label><input type="radio" name="q3" value="D"> D. Trouver un remède à une maladie mystérieuse</label>
        </div>

        <button type="submit">Valider mes réponses</button>
    </form>

    <?php } ?>

    <!-- Exo 9 -->
    <h2>9.Jeux : nombre mystère</h2>
    <form action="formulaires.php"method="post">
        <input type="number" name="nombre" min="0" max="1000" required>
        <button type="submit">Valider</button>
    </form>
    <?php
    if(!isset($_SESSION['mystere'])) {
        $_SESSION['mystere'] = rand(0, 1000);
    }

    $message="";

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $proposition = (int)($_POST['nombre'] ?? null);
        if($proposition < $_SESSION['mystere']) {
            $message = "C'est plus!";
        } elseif ($proposition > $_SESSION['mystere']) {
            $message = "C'est moins!";
        } else {
            $message = "BRAVO!";
        }
    }
    ?>
    <?php if ($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
</body>
</html>