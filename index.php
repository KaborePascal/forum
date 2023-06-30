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

					<!-- <li><a href="forum.php">forum</a></li> -->
					<?php
					if (isset($_SESSION['nom']))
					{
						echo '<li><a href="logout.php">Déconnexion</a></li>';
					}
					else
					{
						echo '<li><a href="index.php">Login</a></li>
					<li><a href="inscription.php">Inscription</a></li>';
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
		<form action="" method="post" id="flogin">
			<input type="text" name="email" placeholder="Votre Email" class="ch"><br>
			<input type="password" name="pw" placeholder="Mot de passe" class="ch"><br>
			<input type="submit" name="valider" value="Valider" class="ch">
		</form>
	</section>
</body>

</html>