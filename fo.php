<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="../forum/style2.css">
    <link rel="stylesheet" href="../forum/style.css">
</head>

<body>
    <header>
        <nav>
            <div>
                <div>
                    <div><img class="logo" src="../forum/images/logo digi.jpg" alt=""></div>
                </div>
                <ul>
                    <li><a href="index.php">Login</a></li>
                    <li><a href="inscription.php">Inscription</a></li>
                    <!-- <li><a href="forum.php">forum</a></li> -->
                    <?php
                    if (isset($_SESSION['nom']))
                    {
                        echo '<li><a href="logout.php">Déconnexion</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </header>
    <section>
        <h1 class="titre">Bienvenue à Digital Forum : Login</h1>
    </section>
    <section>
        <?php
        include("connexion.php");

        if (isset($_POST['valider']))
        {
            $email = $_POST['email'];
            $password = $_POST['pw'];

            try
            {
                $db = new PDO("mysql:host=localhost;dbname=forum2023", "root", "");
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $db->prepare("SELECT * FROM utilisateur WHERE email_user = :email AND pw_user = :password");
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                $stmt->execute();

                $nbr = $stmt->rowCount();

                if ($nbr == 1)
                {
                    $data = $stmt->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['id_user'] = $data['id_user'];
                    $_SESSION['nom'] = $data['nom_user'];
                    $_SESSION['prenom'] = $data['prenom_user'];
                    $_SESSION['login'] = $data['email_user'];
                    $_SESSION['mp'] = $data['pw_user'];
                    header("Location: forumg.php");
                    exit();
                }
                else
                {
                    echo 'Login ou mot de passe incorrects';
                    exit();
                }
            }
            catch (PDOException $e)
            {
                echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
                exit();
            }
        }
        ?>

        <!-- Affichage des commentaires -->
        <?php
        $req = $db->query("SELECT * FROM utilisateur, message WHERE utilisateur.id_user = message.id_user ORDER BY id_message DESC");
        while ($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            echo '<div id="div1">';
            echo '<img src="images/' . $data['id_user'] . '.jpg" class="photo" width="30px" height="30px">';
            echo $data['nom_user'] . '<br>' . $data['prenom_user'] . '</div>';

            echo '<div id="div2">Posté le : ' . changedate($data['date_message']) . ' à ' . $data['heure_message'] . '<br>' . $data['texte_message'] . '</div>';

            // Formulaire de réponse
            echo '<form action="" method="post">';
            echo '<textarea name="reponse" placeholder="Votre réponse" id="zmessage"></textarea>';
            echo '<input type="hidden" name="id_message" value="' . $data['id_message'] . '">';
            echo '<input type="submit" name="envoyer_reponse" value="Envoyer" class="btn2">';
            echo '</form>';

            // Traitement de la réponse
            if (isset($_POST['envoyer_reponse']))
            {
                $id_user = $_SESSION['id_user'];
                $id_message = $_POST['id_message'];
                $reponse = $_POST['reponse'];
                $date = date('Y-m-d');
                $heure = date('H:i');

                $stmt = $db->prepare("INSERT INTO reponse (id_user, id_message, texte_reponse, date_reponse, heure_reponse) VALUES (:id_user, :id_message, :reponse, :date, :heure)");
                $stmt->bindParam(':id_user', $id_user);
                $stmt->bindParam(':id_message', $id_message);
                $stmt->bindParam(':reponse', $reponse);
                $stmt->bindParam(':date', $date);
                $stmt->bindParam(':heure', $heure);
                $stmt->execute();
            }
        }
        $req->closeCursor();
        ?>
        <!-- Fin de l'affichage des commentaires -->

        <!-- Formulaire de nouveau commentaire -->
        <form action="" method="post">
            <textarea name="message" placeholder="Votre message" id="zmessage"></textarea>
            <input type="submit" name="envoyer_message" value="Envoyer" class="btn2">
        </form>

        <?php
        // Traitement du nouveau commentaire
        if (isset($_POST['envoyer_message']))
        {
            $id = $_SESSION['id_user'];
            $msg = $_POST['message'];
            $date = date('Y-m-d');
            $heure = date('H:i');

            $stmt = $db->prepare("INSERT INTO message (id_user, texte_message, date_message, heure_message) VALUES (:id, :msg, :date, :heure)");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':msg', $msg);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':heure', $heure);
            $stmt->execute();
        }
        ?>
    </section>
</body>

</html>