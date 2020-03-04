<?php
session_start();
require_once("config.php");
require_once("configSample.php");
require_once("autoload.php");

	if (isset($_GET['action']))
	{
		switch ($_GET['action'])
		{			
			case 'disconnection':
				$memberAreaController = new \Controller\MemberAreaController();
				$memberAreaController->disconnection();
				break;
			case 'register':
				$memberAreaController = new \Controller\MemberAreaController();
				$memberAreaController->register();
				break;
			case 'activation':
				$memberAreaController = new \Controller\MemberAreaController();
				$memberAreaController->activation();
				break;
			case 'login':
				$memberAreaController = new \Controller\MemberAreaController();
				$memberAreaController->login();
				break;
			case 'mdpForgot':
				$memberAreaController = new \Controller\MemberAreaController();
				$memberAreaController->mdpForgot();
				break;
			case 'mdpUpdate':
				$memberAreaController = new \Controller\MemberAreaController();
				$memberAreaController->mdpUpdate();
				break;
			case 'mdpUpdateForm':
				$homeController = new \Controller\HomeController();
				$homeController->home(); 
				break;
			case 'profil':
				$profilController = new \Controller\ProfilController();
				$profilController->profil(); 
				break;
			case 'showPictures':
				$profilController = new \Controller\ProfilController();
				$profilController->showPictures(); 
				break;
			case 'updatePicture':
				$profilController = new \Controller\ProfilController();
				$profilController->updatePicture(); 
				break;
			case 'deletePicture':
				$profilController = new \Controller\ProfilController();
				$profilController->deletePicture(); 
				break;
			case 'checkMdp' :
				$profilController = new \Controller\ProfilController();
				$profilController->checkMdp(); 
				break;
			case 'updateMdpProfil' :
				$profilController = new \Controller\ProfilController();
				$profilController->updateMdpProfil(); 
				break;
			case 'space' :
				$spaceController = new \Controller\SpaceController();
				$spaceController->space(); 
				break;
			case 'descriptionUpdate' :
				$spaceController = new \Controller\SpaceController();
				$spaceController->descriptionUpdate(); 
				break;
			case 'addPostSpace' :
				$spaceController = new \Controller\SpaceController();
				$spaceController->addPostSpace(); 
				break;
			case 'deletePost' :
				$spaceController = new \Controller\SpaceController();
				$spaceController->deletePost(); 
				break;	
			case 'post' :
				$postController = new \Controller\PostController();
				$postController->post(); 
				break;
			case 'modifyPostSpace' :
				$postController = new \Controller\PostController();
				$postController->modifyPost(); 
				break;
			case 'addCommOnPostSpace' :
				$postController = new \Controller\PostController();
				$postController->addComment(); 
				break;
		}
	}
	else
	{
		$homeController = new \Controller\HomeController();
		$homeController->home(); 
	}	