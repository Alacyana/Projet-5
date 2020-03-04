<?php
namespace Controller;

class ProfilController
{
	public function profil()
	{
		if(isset($_POST['submit_file']))
		{
			$file = $_FILES['gallery_file'];
			$category = $_POST['file_category'];
			if(isset($file) AND $file['error'] == 0)
			{
				if($category != "")
				{
					$data_title = $_POST['file_title'];
					$data_description = $_POST['file_description'];
					$title = trim($data_title);
					$description = trim($data_description);
					if($category == "avatar")
					{
						$size = "1000000";
						$img_width = "600";
						$img_height = "600";
					}
					else if($category == "picture")
					{
						$size = "3000000";
						$img_width = "2000";
						$img_height = "600";
					}
					else if($category == "banner")
					{
						$size = "3000000";
							$img_width = "1200";
							$img_height = "600";
					}
					//Si le fichier est inférieure à...
					if ($file['size'] <= $size)
					{
						$image_size = getimagesize($file['tmp_name']);
						if ($image_size[0] <= $img_height OR $image_size[1] <= $img_width)
						{
							$infos_files = pathinfo($file['name']);
							$extension = $infos_files['extension'];
							$extentions_valid = array('png', 'jpeg', 'jpg');

							if (in_array($extension, $extentions_valid))
							{
								$numberPicture = 0;
								$profilManager = new \Model\ProfilManager();
								$verifyPicture = $profilManager->verifyPicture();
								while($resultPicture = $verifyPicture->fetch())
								{
									if($numberPicture < $resultPicture['picture_number'])
									{
										$numberPicture = $resultPicture['picture_number'];
									}
								}
								$numberPicture++;
								$imgCrypt = sha1('*@ofJ_-+' . $numberPicture . $_SESSION['id'] . $category . '*-+img°');
								$renamePicture = $imgCrypt . '.' . $extension;
								move_uploaded_file($file['tmp_name'], 'gallery/'.$renamePicture);
								$addPicture = $profilManager->addPicture($title, $description, $numberPicture, $category, $renamePicture, $extension);
								header('Refresh:0');
							}
						}
					}				
				}
			}
		}
		$category = "avatar";
		$profilManager = new \Model\ProfilManager();
		$getAvatars = $profilManager->getPictures($category);
		$category = "picture";
		$getPictures = $profilManager->getPictures($category);
		$picture = "avatar_default.png";
			$numberPictures = 0;
			while($datas = $getPictures->fetch())
			{
				$tab_pictures[] = $datas;
			}
			$numberPictures = count($tab_pictures);
			if($numberPictures != 0)
			{
				$nb = rand(0, ($numberPictures - 1));
				$picture = $tab_pictures[$nb]['picture'];
			}
		
		require('view/sampleViewTop.php');
		
		if(isset($_SESSION['id']))
		{
			require('view/profilView.php');
		}
		else
		{
			require('view/deconnectView.php');
		}
		require('view/sampleViewBot.php');	
	}
	
	public function showPictures()
	{
		$category = $_POST['data_category'];
		$profilManager = new \Model\ProfilManager();
		$getPictures = $profilManager->getPictures($category);
		while($datasPictures = $getPictures->fetch())
		{
			$datas[] = $datasPictures;
		}
		echo json_encode($datas);
	}
	
	public function updatePicture()
	{
		$picture = $_POST['data_picture'];
		$category = $_POST['data_category'];
		if($picture != "")
		{
			$profilManager = new \Model\ProfilManager();
			$getPictures = $profilManager->getPictures($category);
			$analyse = 0;
			while($pictures = $getPictures->fetch())
			{
				$imgCrypt = sha1('*@ofJ_-+' . $pictures['picture_number'] . $pictures['id_member'] . $category . '*-+img°');
				$pictureBdd = $imgCrypt .'.'. $pictures['extension'];
				if(($picture === $pictureBdd) || ($picture === "avatar_default.png") || ($picture === "banner_default.png"))
				{
					$analyse = 1;
				}
			}
			if($analyse == 1)
			{
				if($category == "avatar")
				{
					$updateAvatar = $profilManager->updateAvatar($picture);
					$error_picture = 1;
					$_SESSION['avatar'] = $picture;
				}
				else if($category == "banner")
				{
					$updateBanner = $profilManager->updateBanner($picture);
					$error_picture = 2;
					$_SESSION['banner'] = $picture;
				}
			}
		}
		else
		{
			$error_picture = 0;
		}
		echo json_encode($error_picture);
	}
	
	public function deletePicture()
	{
		$picture = $_POST['data_picture'];
		$category = $_POST['data_category'];
		$deleteStatus = 0;
		if(($picture != "") && ($picture != "avatar_default.png") && ($picture != "banner_default.png"))
		{
			$profilManager = new \Model\ProfilManager();
			$deletePicture = $profilManager->deletePicture($picture);
			if($category == "avatar")
			{
				$verifyAvatar = $profilManager->verifyAvatar();
				$resultAvatar = $verifyAvatar->fetch();
				$deleteStatus = 2;
				if($picture == $resultAvatar['avatar'])
				{
					$updateAvatar = $profilManager->updateAvatarDefault();
					$_SESSION['avatar'] = "avatar_default.png";
					$deleteStatus = 3;
				}
			}
			else if($category == "picture")
			{
				$deleteStatus = 2;
			}
			else if($category == "banner")
			{
				$verifyBanner = $profilManager->verifyBanner();
				$resultBanner = $verifyBanner->fetch();
				$deleteStatus = 2;
				if($picture == $resultBanner['banner'])
				{
					$updateBanner = $profilManager->updateBannerDefault();
					$_SESSION['banner'] = "banner_default.png";
					$deleteStatus = 4;
				}
			}
		}
		else
		{
			$deleteStatus = 1;
		}
		echo json_encode($deleteStatus);
	}
	
	public function checkMdp()
	{
		$oldMdp = $_POST['data_oldMdp'];
		if($oldMdp != "")
		{
			$profilManager = new \Model\ProfilManager();
			$verifyOldMdp = $profilManager->verifyOldMdp($oldMdp);
			$resultOldMdp = $verifyOldMdp->fetch();
			if(isset($resultOldMdp['id']))
			{
				$error_mdp = false;
			}
			else
			{
				$error_mdp = true;
			}
			echo json_encode($error_mdp);
		}		 
	}
	
	public function updateMdpProfil()
	{
		$oldMdp = $_POST['data_oldMdp'];
		$newMdp = $_POST['data_new_mdp'];
		$confirmMdp = $_POST['data_confirm_new_mdp'];
		if($oldMdp != "")
		{
			$profilManager = new \Model\ProfilManager();
			$verifyOldMdp = $profilManager->verifyOldMdp($oldMdp);
			$resultOldMdp = $verifyOldMdp->fetch();
			if(isset($resultOldMdp['id']))
			{
				if((strlen($newMdp) >= 8) && ($newMdp == $confirmMdp))
				{
					$profilManager = new \Model\ProfilManager();
					$updateMdpProfil = $profilManager->updateMdpProfil($newMdp);
					$error_update_mdp = 3;
				}
				else
				{
					$error_update_mdp = 2;
				}
			}
			else
			{
				$error_update_mdp = 1;
			}
			echo json_encode($error_update_mdp);
		}		 
	}
}