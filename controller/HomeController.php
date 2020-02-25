<?php
namespace Projet\HomeController;
session_start();

//require('model/DashboardManager.php');

class HomeController
{
	public function home()
	{
		require('view/sampleViewTop.php');
		require('view/sampleViewBot.php');
	}
}	