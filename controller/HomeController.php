<?php
namespace Projet\HomeController;
session_start();

require('model/HomeManager.php');

class HomeController
{
	public function home()
	{
		$homeManager = new \Projet\Model\homeManager();
			$getSpaces = $homeManager->getSpaces();
			$getPosts = $homeManager->getPosts();
		
		require('view/sampleViewTop.php');
		require('view/homeView.php');
		require('view/sampleViewBot.php');
	}
}	