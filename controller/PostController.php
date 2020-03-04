<?php
namespace Controller;

class PostController
{
	public function post()
	{
		$postManager = new \Model\PostManager();
			$getPost = $postManager->getPost();
			$post = $getPost->fetch();
			$getsPictures = $postManager->getsPictures();
			$getComments = $postManager->getComments();
			
		require('view/sampleViewTop.php');
			require('view/postView.php');
		require('view/sampleViewBot.php');	
	}
	
	public function modifyPost()
	{
		$data_title = $_POST["data_title"];
		$subtitle = $_POST["data_subtitle"];
		$data_text = $_POST["data_text"];
		$post = $_POST["data_post"];
		$picture = $_POST["data_picture"];
		$title = trim($data_title);
		$text = trim($data_text);
		
		if(($title != "") && ($text != ""))
		{
			if($picture == "none")
			{
				$picture = "";
			}
			$postManager = new \Model\PostManager();
				$modifyPost = $postManager->modifyPost($title, $subtitle, $text, $post, $picture);
			$status = 1;
		}
		else
		{
			$status = 0;
		}
		echo json_encode($status);
	}
	
	public function addComment()
	{
		$data_comm = $_POST["data_text_comment"];
		$post = $_POST["data_post"];
		$comment = trim($data_comm);
		
		if($comment != "")
		{
			$postManager = new \Model\PostManager();
				$addComment = $postManager->addComment($comment, $post);
			$status = 1;
		}
		else
		{
			$status = 0;
		}
		echo json_encode($status);
	}
}