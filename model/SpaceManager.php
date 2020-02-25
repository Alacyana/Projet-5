<?php
namespace Projet\Model;
session_start();

require_once("model/Manager.php");

class SpaceManager extends Manager
{
	public function verifySpace($user)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT * FROM space WHERE id_member_crypt = :id');
		$request->execute(array(
		'id' => $user));
		return $request;
	}
	
	public function addSpace($id_crypt)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('INSERT INTO space SET id_member = :id_member, id_member_crypt = :id');
		$request->execute(array(
		'id_member' => $_SESSION['id'],
		'id' => $id_crypt));
	}
	
	public function getMember()
	{
		$db = $this->dbConnect();
		$request = $db->prepare('
		SELECT m.pseudo, m.id, s.id_member
		FROM space AS s
		LEFT JOIN members AS m
		ON m.id = s.id_member
		WHERE s.id_member_crypt = :id_crypt');
		$request->execute(array(
		"id_crypt" => $_GET['user']));
		return $request;
	}
	
	public function updateDescription($new_description)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('UPDATE space SET description = :description WHERE id_member = :id_member');
		$request->execute(array(
		'id_member' => $_SESSION['id'],
		'description' => $new_description));
	}
	
	public function addPost($title, $subtitle, $text, $picture)
	{
		$dates = $this->datesZone();
		$post_crypt = sha1('FrtVL/K.J?'.$_SESSION["id"] . $dates .'g65s4d');
		$db = $this->dbConnect();
		$request = $db->prepare('INSERT INTO posts SET post_crypt = :post_crypt, id_member = :id_member, title = :title, subtitle = :subtitle, picture = :picture, text = :text, date_creation = :date, date_modification = :date');
		$request->execute(array(
		'id_member' => $_SESSION['id'],
		'title' => $title,
		'subtitle' => $subtitle,
		'picture' => $picture,
		'text' => $text,
		'post_crypt' => $post_crypt,
		'date' => $dates));
	}
	
	public function getsPosts()
	{
		$db = $this->dbConnect();
		$request = $db->prepare("
		SELECT p.id, p.post_crypt, p.title, p.subtitle, p.text, DATE_FORMAT(p.date_creation, 'le %d/%m/%Y à %H:%i:%S') AS date_creation, DATE_FORMAT(p.date_modification, 'le %d/%m/%Y à %H:%i:%S') AS date_modification
		FROM posts AS p
		LEFT JOIN space AS s
		ON p.id_member = s.id_member
		WHERE s.id_member_crypt = :member_crypt
		ORDER BY id DESC
		");
		$request->execute(array(
		'member_crypt' => $_GET['user']));
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
	
	public function deletePost($post)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('DELETE FROM posts WHERE post_crypt = :post');
		$request->execute(array(
		'post' => $post));
	}
}	