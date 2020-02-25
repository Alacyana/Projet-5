<?php
require_once("config.php");
require_once('controller/MemberAreaController.php');
require_once('controller/HomeController.php');
require_once('controller/ProfilController.php');
require_once('controller/SpaceController.php');
require_once('controller/PostController.php');

	if (isset($_GET['action']))
	{
		switch ($_GET['action'])
		{			
			case 'disconnection':
				$memberAreaController = new \Projet\MemberController\MemberController();
				$memberAreaController->disconnection();
				break;
			case 'register':
				$memberAreaController = new \Projet\MemberController\MemberController();
				$memberAreaController->register();
				break;
			case 'activation':
				$memberAreaController = new \Projet\MemberController\MemberController();
				$memberAreaController->activation();
				break;
			case 'login':
				$memberAreaController = new \Projet\MemberController\MemberController();
				$memberAreaController->login();
				break;
			case 'mdpForgot':
				$memberAreaController = new \Projet\MemberController\MemberController();
				$memberAreaController->mdpForgot();
				break;
			case 'mdpUpdate':
				$memberAreaController = new \Projet\MemberController\MemberController();
				$memberAreaController->mdpUpdate();
				break;
			case 'mdpUpdateForm':
				$homeController = new \Projet\HomeController\HomeController();
				$homeController->home(); 
				break;
			case 'profil':
				$profilController = new \Projet\ProfilController\ProfilController();
				$profilController->profil(); 
				break;
			case 'showPictures':
				$profilController = new \Projet\ProfilController\ProfilController();
				$profilController->showPictures(); 
				break;
			case 'updatePicture':
				$profilController = new \Projet\ProfilController\ProfilController();
				$profilController->updatePicture(); 
				break;
			case 'deletePicture':
				$profilController = new \Projet\ProfilController\ProfilController();
				$profilController->deletePicture(); 
				break;
			case 'checkMdp' :
				$profilController = new \Projet\ProfilController\ProfilController();
				$profilController->checkMdp(); 
				break;
			case 'updateMdpProfil' :
				$profilController = new \Projet\ProfilController\ProfilController();
				$profilController->updateMdpProfil(); 
				break;
			case 'space' :
				$spaceController = new \Projet\SpaceController\SpaceController();
				$spaceController->space(); 
				break;
			case 'descriptionUpdate' :
				$spaceController = new \Projet\SpaceController\SpaceController();
				$spaceController->descriptionUpdate(); 
				break;
			case 'addPostSpace' :
				$spaceController = new \Projet\SpaceController\SpaceController();
				$spaceController->addPostSpace(); 
				break;
			case 'deletePost' :
				$spaceController = new \Projet\SpaceController\SpaceController();
				$spaceController->deletePost(); 
				break;	
			case 'post' :
				$postController = new \Projet\PostController\PostController();
				$postController->post(); 
				break;
			case 'modifyPostSpace' :
				$postController = new \Projet\PostController\PostController();
				$postController->modifyPost(); 
				break;
			case 'addCommOnPostSpace' :
				$postController = new \Projet\PostController\PostController();
				$postController->addComment(); 
				break;
		}
	}
	else
	{
		$homeController = new \Projet\HomeController\HomeController();
		$homeController->home(); 
	}	