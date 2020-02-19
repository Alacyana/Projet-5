<?php
namespace Projet\Model;
session_start();

require_once("model/Manager.php");

class MemberAreaManager extends Manager
{
	public function verifyUser($username)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT * FROM members WHERE pseudo = :user');
		$request->execute(array(
		'user' => $username));
		return $request;
	}
	
	public function verifyMail($mail)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT * FROM members WHERE mail = :mail');
		$request->execute(array(
		'mail' => $mail));
		return $request;
	}
	
	public function addMember($username, $mail, $mdp)
	{
		$dates = $this->datesZone();
		$pass_hache = sha1('*@ufm_-+' . $mdp . '*-+lecture°');
		$token = sha1('G2/:Mà' . $mail . '*-+lecture°');
		$db = $this->dbConnect();
		$request = $db->prepare('INSERT INTO members SET pseudo = :user, mail = :mail, password = :mdp, token = :token, date_creation = :dates');
		$request->execute(array(
		'user' => $username,
		'mail' => $mail,
		'mdp' => $pass_hache,
		'dates' => $dates,
		'token' => $token));
	}
	
	public function mailActivation($token)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('UPDATE members SET activation = :activation WHERE token = :token');
		$request->execute(array(
		'activation' => '1',
		'token' => $token));
	}
	
	public function verifyActivation($token)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT * FROM members WHERE token = :token');
		$request->execute(array(
		'token' => $token));
		return $request;
	}
	
	public function verifyLogs($mail, $mdp)
	{
		$pass_hache = sha1('*@ufm_-+' . $mdp . '*-+lecture°');
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT * FROM members WHERE mail = :mail AND password = :mdp');
		$request->execute(array(
		'mail' => $mail,
		'mdp' => $pass_hache));
		return $request;
	}
	
	public function updateMdp($mdp, $token)
	{
		$pass_hache = sha1('*@ufm_-+' . $mdp . '*-+lecture°');
		$db = $this->dbConnect();
		$request = $db->prepare('UPDATE members SET password = :mdp WHERE token = :token');
		$request->execute(array(
		'token' => $token,
		'mdp' => $pass_hache));
	}
}	