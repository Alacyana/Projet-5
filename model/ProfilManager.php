<?php
namespace Projet\Model;
session_start();

require_once("model/Manager.php");

class ProfilManager extends Manager
{
	public function verifyPicture()
	{
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT * FROM gallery WHERE id_member = :id_member');
		$request->execute(array(
		'id_member' => $_SESSION['id']));
		return $request;
	}
	
	public function addPicture($title, $description, $numberPicture, $category, $renamePicture, $extension)
	{
		$dates = $this->datesZone();
		$db = $this->dbConnect();
		$request = $db->prepare('INSERT INTO gallery SET id_member = :id_member, picture_title = :picture_title, picture_description = :picture_description, picture_number = :picture_number, picture = :picture, category = :category, extension = :extension, date_creation = :dates');
		$request->execute(array(
		'id_member' => $_SESSION['id'],
		'picture_title' => $title,
		'picture_description' => $description,
		'picture_number' => $numberPicture,
		'picture' => $renamePicture,
		'category' => $category,
		'extension' => $extension,
		'dates' => $dates));
	}
	
	public function getPictures($category)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT * FROM gallery WHERE id_member = :id_member AND category = :category');
		$request->execute(array(
		'id_member' => $_SESSION['id'],
		'category' => $category));
		return $request;
	}
	
	public function updateAvatar($picture)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('UPDATE members SET avatar = :avatar WHERE id = :id');
		$request->execute(array(
		'avatar' => $picture,
		'id' => $_SESSION['id']));
	}
	
	public function updateBanner($picture)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('UPDATE members SET banner = :banner WHERE id = :id');
		$request->execute(array(
		'banner' => $picture,
		'id' => $_SESSION['id']));
	}
	
	public function deletePicture($picture)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('DELETE FROM gallery WHERE id_member = :id AND picture = :picture');
		$request->execute(array(
		'picture' => $picture,
		'id' => $_SESSION['id']));
	}
	
	public function verifyAvatar()
	{
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT avatar FROM members WHERE id = :id');
		$request->execute(array(
		'id' => $_SESSION['id']));
		return $request;
	}
	
	public function verifyBanner()
	{
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT banner FROM members WHERE id = :id');
		$request->execute(array(
		'id' => $_SESSION['id']));
		return $request;
	}
	
	public function updateAvatarDefault()
	{
		$db = $this->dbConnect();
		$request = $db->prepare('UPDATE members SET avatar = :avatar WHERE id = :id');
		$request->execute(array(
		'avatar' => "avatar_default.png",
		'id' => $_SESSION['id']));
	}
	
	public function updateBannerDefault()
	{
		$db = $this->dbConnect();
		$request = $db->prepare('UPDATE members SET banner = :banner WHERE id = :id');
		$request->execute(array(
		'avatar' => "banner_default.png",
		'id' => $_SESSION['id']));
	}
	
	public function verifyOldMdp($oldMdp)
	{
		$db = $this->dbConnect();
		$pass_hache = sha1('*@ufm_-+' . $oldMdp . '*-+lecture°');
		$request = $db->prepare('SELECT * FROM members WHERE password = :password AND id = :id');
		$request->execute(array(
		'password' => $pass_hache,
		'id' => $_SESSION['id']));
		return $request;
	}
	
	public function updateMdpProfil($newMdp)
	{
		$db = $this->dbConnect();
		$pass_hache = sha1('*@ufm_-+' . $newMdp . '*-+lecture°');
		$request = $db->prepare('UPDATE members SET password = :password WHERE id = :id');
		$request->execute(array(
		'password' => $pass_hache,
		'id' => $_SESSION['id']));
	}
}	