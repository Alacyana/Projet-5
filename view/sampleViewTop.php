<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
		rel="stylesheet">
		<link rel="stylesheet" href="public/css/main.css" />
		<link rel="stylesheet" href="public/css/navigation.css" />
		<link rel="stylesheet" href="public/css/profil.css" />
		<link rel="stylesheet" href="public/css/space.css" />
		<link rel="stylesheet" href="public/css/post.css" />
		<link rel="stylesheet" href="public/css/home.css" />
		<title>Site de lecture</title>
	</head>
	<body>
		<nav>
			<div id="nav_top" class="navs">
				<span id="open_nav_left" class="material-icons nav_icons">menu</span>
				<a id="home" href="http://lecture.nexus-archeage.fr">
					<span>Accueil</span>
				</a>				
				<?php 
				if (isset($_SESSION['id']))
				{
				?>
				<a href="http://lecture.nexus-archeage.fr/?action=space&user=<?php echo sha1('FrtVL/K.J?'.$_SESSION["id"].'g65s4d'); ?>">
					<span id="my_space" class="material-icons nav_icons">house</span>
				</a>	
				<?php				
				}
				?>
			</div>
			<div id="nav_left" class="navs">
				<span id="close_nav_left" class="material-icons nav_icons">clear</span>				
				<?php 
				if (isset($_SESSION['id']))
				{
					
				?>
					<p>Bienvenue <?php echo $_SESSION['pseudo'];?> !</p>
					<div id="avatar_nav_left">
						<a href="http://lecture.nexus-archeage.fr/?action=profil">
							<img src="../gallery/<?php echo $_SESSION['avatar'];?>" class="avatar" alt="avatar"/>
						</a>
					</div>
					<a id="disconnection">Déconnexion</a>
				<?php				
				}
				else
				{
					if($_GET['action'] == "mdpUpdateForm")
					{
					?>
						<div id="mdp_update" class="blocks_logs_css" name="<?php echo $_GET['token']; ?>">
							<label for="mdp_update_mdp">Mot-de-passe :</label>
							<input id="mdp_update_mdp" class="champs_mdp champs_css" name="mdp_update_mdp" type="password"/>
							<label for="mdp_update_confirm_mdp">Confirmez le mot-de-passe :</label>
							<input id="mdp_update_confirm_mdp" class="champs_mdp champs_css" name="mdp_update_confirm_mdp" type="password"/>
							<p id="errors_mdp_update"></p>
							<input id="mdp_update_submit" class="btns_submit" name="mdp_update_submit" type="submit" value="Valider le mot-de-passe"/>
						</div>
					<?php
					}
					else
					{
					?>	
						<div id="block_login" class="blocks_logs_css">
							<span id="login" class="btns_login">Connexion</span>
							<span id="register" class="btns_login">Inscription</span>
						</div>
						<div id="register_form" class="hide blocks_logs_css">
							<label for="register_username">Pseudo :</label>
							<input id="register_username" class="champs champs_css" name="register_username" type="text"/>
							<label for="register_mail">Email :</label>
							<input id="register_mail" class="champs champs_css" name="register_mail" type="email"/>
							<label for="register_mdp">Mot-de-passe :</label>
							<input id="register_mdp" class="champs champs_css" name="register_mdp" type="password"/>
							<label for="confirm_mdp">Confirmez le mot-de-passe :</label>
							<input id="confirm_mdp" class="champs champs_css" name="confirm_mdp" type="password"/>
							<p id="errors_register"></p>
							<input id="register_submit" class="btns_submit" name="register_submit" type="submit" value="Valider l'inscription"/>
						</div>
						<div id="login_form" class="hide blocks_logs_css">
							<label for="login_mail">Email :</label>
							<input id="login_mail" class="champs_css" name="login_mail" type="email"/>
							<label for="login_mdp">Mot-de-passe :</label>
							<input id="login_mdp" class="champs_css" name="login_mdp" type="password"/>
							<p id="errors_login"></p>
							<input id="login_submit" class="btns_submit" name="login_submit" type="submit" value="Connexion"/>
							<a id="mdp_forgot" >Mot-de-passe oublié ?</a>
						</div>
						<div id="mdp_forgot_form" class="hide blocks_logs_css">
							<label for="mdp_forgot_mail">Email :</label>
							<input id="mdp_forgot_mail" class="champs_css" name="mdp_forgot_mail" type="email"/>
							<p id="errors_mdp_forgot"></p>
							<input id="mdp_forgot_submit" class="btns_submit" name="mdp_forgot_submit" type="submit" value="Récupération"/>
						</div>
				<?php
					}
				}
				?>
			</div>
		</nav>