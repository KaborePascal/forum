<?php
session_start();
include("connexion.php");

if (isset($_SESSION['login']) && isset($_SESSION['mp']))
{
    // Code à exécuter si la session est active
    if (isset($_POST['envoyer']))
    {
        $id = $_SESSION['id_user'];
        $msg = $_POST['message'];
        $date = date('Y-m-d');
        $heure = date('H:i');
        $req1 = mysqli_query($cn, "INSERT INTO message (id_user, texte_message, date_message, heure_message) VALUES ('$id', '$msg', '$date', '$heure')");
        header("Location: forumg.php");
        exit();
    }

    echo '<html>';
    echo '<head>';
    echo '<title>Forum</title>';
    echo '<meta charset="utf-8">';
    echo '<link rel="stylesheet" href="style.css">';
    echo '</head>';
    echo '<body>';
    echo '<header>';
    echo '<nav>';
    echo '<ul>';

    if (isset($_SESSION['nom']))
    {
        echo '<li><a href="logout.php">Déconnexion</a></li>';
    }
    else
    {
        echo '<li><a href="index.php">Login</a></li>';
        echo '<li><a href="inscription.php">Inscription</a></li>';
    }
    echo '</ul>';
    echo '</nav>';
    echo '</header>';
    echo '<section>';
    echo '<h1 class="titre">Bienvenue dans notre forum</h1>';
    echo '</section>';
    echo '<section id="sect1">';

    // Fonction pour changer le format de la date en français
    function changeDate($dt)
    {
        $tab = explode("-", $dt);
        $nd = $tab[2] . "-" . $tab[1] . "-" . $tab[0];
        return $nd;
    }

    $req = mysqli_query($cn, "SELECT * FROM utilisateur JOIN message ON utilisateur.id_user = message.id_user ORDER BY id_message DESC");

    while ($data = mysqli_fetch_assoc($req))
    {
        echo '<div id="div1">';
        echo '<img src="images/' . $data['id_user'] . '.jpg" class="photo" width="30px" height="30px">';
        echo $data['nom_user'];
        echo '<br>' . $data['prenom_user'] . '</div>';
        echo '<div id="div2">Posté le : ' . changeDate($data['date_message']);
        echo ' à ' . $data['heure_message'];
        echo '<br>' . $data['texte_message'] . '</div>';
    }

    echo '<form action="" method="post">';
    echo '<textarea name="message" placeholder="Votre message" id="zmessage"></textarea>';
    echo '<input type="submit" name="envoyer" value="Envoyer" class="btn2">';
    echo '</form>';
    echo '</section>';
    echo '</body>';
    echo '</html>';
}
else
{
    // Redirection vers la page de connexion si la session n'est pas active
    header("Location: index.php");
    exit();
}
?>