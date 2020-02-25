<?php
namespace Projet\Model;
session_start();

require_once("model/Manager.php");

class PostManager extends Manager
{
	public function getPost()
	{
		$db = $this->dbConnect();
		$request = $db->prepare("SELECT id, post_crypt, id_member, title, subtitle, picture, text, DATE_FORMAT(date_modification, 'le %d/%m/%Y à %H:%i:%S') AS date_modification FROM posts WHERE post_crypt = :post_crypt");
		$request->execute(array(
		'post_crypt' => $_GET['id_post']));
		return $request;
	}
	
	public function getsPictures()
	{
		$db = $this->dbConnect();
		$request = $db->prepare("SELECT picture FROM gallery WHERE id_member = :id_member AND category = :category");
		$request->execute(array(
		'id_member' => $_SESSION['id'],
		'category' => 'picture'));
		return $request;
	}
	
	public function getComments()
	{
		$db = $this->dbConnect();
		$request = $db->prepare("SELECT m.pseudo, m.avatar, m.banner, c.post_crypt, c.comment_text, DATE_FORMAT(c.date_creation, 'le %d/%m/%Y à %H:%i:%S') AS date_creation
		FROM comments AS c
		LEFT JOIN members AS m
		ON m.id = c.id_member
		WHERE c.post_crypt = :post_crypt
		ORDER BY c.id DESC");
		$request->execute(array(
		'post_crypt' => $_GET['id_post']));
		return $request;
	}
	
	public function modifyPost($title, $subtitle, $text, $post, $picture)
	{
		$dates = $this->datesZone();
		$db = $this->dbConnect();
		$request = $db->prepare('UPDATE posts SET title = :title, subtitle = :subtitle, picture = :picture, text = :text, date_modification = :date WHERE id_member = :id_member AND post_crypt = :post_crypt');
		$request->execute(array(
		'id_member' => $_SESSION['id'],
		'title' => $title,
		'subtitle' => $subtitle,
		'picture' => $picture,
		'text' => $text,
		'date' => $dates,
		'post_crypt' => $post));
	}
	
	public function addComment($comment, $post)
	{
		$dates = $this->datesZone();
		$db = $this->dbConnect();
		$request = $db->prepare('INSERT INTO comments SET post_crypt = :post_crypt, id_member = :id_member, comment_text = :comment, date_creation = :date');
		$request->execute(array(
		'id_member' => $_SESSION['id'],
		'comment' => $comment,
		'date' => $dates,
		'post_crypt' => $post));
	}
}	