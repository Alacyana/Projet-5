<?php
namespace Controller;

class SpaceController
{
	public function space()
	{
		$user = $_GET['user'];
		$id_crypt = sha1('FrtVL/K.J?'.$_SESSION["id"].'g65s4d');
		$id = $_SESSION['id'];
		$spaceManager = new \Model\SpaceManager();
			$verifySpace = $spaceManager->verifySpace($user);
			$resultSpace = $verifySpace->fetch();
			if(!isset($resultSpace["id"]))
			{
				if($user == $id_crypt)
				{
					$addSpace = $spaceManager->addSpace($id_crypt);
				}
			}
			else
			{
				$getMember = $spaceManager->getMember();
				$resultMember = $getMember->fetch();
			}
			$getsPosts = $spaceManager->getsPosts();
			$getsPictures = $spaceManager->getsPictures();
		require('view/sampleViewTop.php');
			require('view/spaceView.php');
		require('view/sampleViewBot.php');	
	}
	
	public function descriptionUpdate()
	{
		$new_description = $_POST["data_new_description"];
		$spaceManager = new \Model\SpaceManager();
			$updateDescription = $spaceManager->updateDescription($new_description);
	}
	
	public function addPostSpace()
	{
		$data_title = $_POST["data_title"];
		$subtitle = $_POST["data_subtitle"];
		$data_text = $_POST["data_text"];
		$picture = $_POST["data_picture"];
		$title = trim($data_title);
		$text = trim($data_text);
		
		if($title != "" && $text != "")
		{
			if($picture == "none")
			{
				$picture = "";
			}
			$spaceManager = new \Model\SpaceManager();
				$addPost = $spaceManager->addPost($title, $subtitle, $text, $picture);
			$status = 1;
		}
		else
		{
			$status = 0;
		}
		echo json_encode($status);
	}
	
	public function deletePost()
	{
		$post = $_POST['data_post'];
		if(isset($post))
		{
			$spaceManager = new \Model\SpaceManager();
				$deletePost = $spaceManager->deletePost($post);
			$status = 1;
		}
		else
		{
			$status = 0;
		}
		echo json_encode($status);
	}
}