<?php
namespace Controller;

class HomeController
{
	public function home()
	{
		$homeManager = new \Model\HomeManager();
			$getSpaces = $homeManager->getSpaces();
			$getPosts = $homeManager->getPosts();
		
		require('view/sampleViewTop.php');
		require('view/homeView.php');
		require('view/sampleViewBot.php');
	}
}	