<?php
namespace Model;

class HomeManager extends Manager
{
	public function getSpaces()
	{
		$db = $this->dbConnect();
		$request = $db->prepare("SELECT s.id_member_crypt, s.description, m.pseudo
		FROM space AS s
		LEFT JOIN members AS m
		ON m.id = s.id_member
		ORDER BY m.pseudo DESC");
		$request->execute(array());
		return $request;
	}
	
	public function getPosts()
	{
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT p.title, p.subtitle, p.post_crypt, m.pseudo
		FROM posts AS p
		LEFT JOIN members AS m
		ON p.id_member = m.id
		ORDER BY p.id DESC
		LIMIT 0,4');
		$request->execute(array());
		return $request;
	}
	
}	