<?php
namespace Projet\MemberController;
session_start();

require('model/MemberAreaManager.php');

class MemberController
{
	public function register()
	{
		$data_username = $_POST['data_username'];
		$data_mail = $_POST['data_mail'];
		$data_mdp = $_POST['data_mdp'];
		$data_confirm_mdp = $_POST['data_confirm'];
		$username = trim($data_username);
		$mail = trim($data_mail);
		$mdp = trim($data_mdp);
		$confirm_mdp = trim($data_mdp);
		
		if ((strlen($username) > 3) /*&& (preg_match(/^(([a-z0-9!$%&\'+/=?^_`{|}~-]+.?)[a-z0-9!$%&\'+/=?^`{|}~-]+)@(([a-z0-9-]+.?)[a-z0-9-_]+).[a-z]{2,}$/i,$mail))*/ && (strlen($mdp) >= 8) && ($mdp == $confirm_mdp))
		{
			$memberAreaManager = new \Projet\Model\MemberAreaManager();
			$verifyUser = $memberAreaManager->verifyUser($username);
				$resultUser = $verifyUser->fetch();
					if(isset($resultUser['id']))
					{
						$errorUser = true;
					}
					else
					{
						$errorUser = false;
					}
			
			$verifyMail = $memberAreaManager->verifyMail($mail);			
				$resultMail = $verifyMail->fetch();
					if(isset($resultMail['id']))
					{
						$errorMail = true;
					}
					else
					{
						$errorMail = false;
					}
			if(!($errorUser) && !($errorMail))
			{
				$addMember = $memberAreaManager->addMember($username, $mail, $mdp);
				$getMember = $memberAreaManager->verifyMail($mail);
				$resultMember = $getMember->fetch();
					if(isset($resultMember['id']))
					{
						$token = sha1('G2/:Mà' . $mail . '*-+lecture°');
						$to      = $mail;
						$subject = 'Activation de votre compte lecture.nexus';
						$message = 'Bienvenue, veuillez cliquer sur ce lien pour activer votre compte : http://lecture.nexus-archeage.fr/?action=activation&token='.$token;
						$headers = 'From: moderation@nexus-archeage.fr' . "\r\n" .
						'Reply-To: moderation@nexus-archeage.fr' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
						mail($to, $subject, $message, $headers);
					}
			}			
			$errorVerif = false;
		}
		else
		{
			$errorVerif = true;
		}
		$errors = array('errorVerif' => $errorVerif, 'errorUser' => $errorUser, 'errorMail' => $errorMail);
		echo json_encode($errors); 
	}
	
	public function activation()
	{
		$memberAreaManager = new \Projet\Model\MemberAreaManager();
		$token = $_GET['token'];
		$verifyActivation = $memberAreaManager->verifyActivation($token);
		$resultActivation = $verifyActivation->fetch();
			if($resultActivation['activation'] == 1)
			{
				$message_activation = "<p style='color: red'>Votre compte est déjà activé. Redirection en cours...</p>";
				header ("Refresh: 5;URL=http://lecture.nexus-archeage.fr/");
			}
			else
			{
				$mailActivation = $memberAreaManager->mailActivation($token);
				$message_activation = "<p style='color: green'>Votre compte a bien été activé. Redirection en cours...</p>";
				header ("Refresh: 5;URL=http://lecture.nexus-archeage.fr/");
			}
		
		require('view/sampleViewTop.php');
		require('view/activationView.php');
		require('view/sampleViewBot.php');
	}
	
	public function login()
	{
		$mail= $_POST['data_mail'];
		$mdp = $_POST['data_mdp'];
		$memberAreaManager = new \Projet\Model\MemberAreaManager();
		$verifyLogs = $memberAreaManager->verifyLogs($mail, $mdp);
			$resultLogs = $verifyLogs->fetch();
				if(isset($resultLogs['id']))
				{
					if($resultLogs['activation'] == 1)
					{
						$_SESSION['id'] = $resultLogs['id'];
						$_SESSION['pseudo'] = $resultLogs['pseudo'];
						$_SESSION['avatar'] = $resultLogs['avatar'];
						$_SESSION['banner'] = $resultLogs['banner'];
						$errorActivation = false;
					}
					else
					{
						$errorActivation = true;
					}
				}
				else
				{
					$errorLogin = true;
				}
		$errors = array('errorLogin' => $errorLogin, 'errorActivation' => $errorActivation);
		echo json_encode($errors); 
	}
	
	public function mdpForgot()
	{
		$mail= $_POST['data_mail'];
		$memberAreaManager = new \Projet\Model\MemberAreaManager();
		$verifyMail = $memberAreaManager->verifyMail($mail);
			$resultMail = $verifyMail->fetch();
				if(isset($resultMail['id']))
				{
					$token = $resultMail['token'];
					
					$to      = $mail;
					$subject = 'Récupération de mot-de-passe';
					$message = 'Bonjour, si vous avez bien demandé une récupération de mot-de-passe, cliquez sur ce lien : http://lecture.nexus-archeage.fr/?action=mdpUpdateForm&token='.$token;
					$headers = 'From: moderation@nexus-archeage.fr' . "\r\n" .
					'Reply-To: moderation@nexus-archeage.fr' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
					mail($to, $subject, $message, $headers);
					$errorMail = false;
				}
				else
				{
					$errorMail = true;
				}
		echo json_encode($errorMail); 
	}
	
	public function mdpUpdate()
	{
		$token = $_POST['data_token'];
		$data_mdp = $_POST['data_mdp'];
		$data_confirm = $_POST['data_confirm'];
		$mdp = trim($data_mdp);
		$confirm = trim($data_confirm);
		
		if((strlen($mdp) >= 8) && ($mdp == $confirm))
		{
			$memberAreaManager = new \Projet\Model\MemberAreaManager();
			$updateMdp = $memberAreaManager->updateMdp($mdp, $token);
			$errorMdp = false;
		}
		else
		{
			$errorMdp = true;
		}
		echo json_encode($errorMdp); 	
	}
	
	public function disconnection()
	{
		session_destroy();
		exit();
	}
}