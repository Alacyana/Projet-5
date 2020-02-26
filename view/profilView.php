<div id="block_page">
	<span id="page_title">Votre Profil</span>
	<div id="avatar_user" data-category="avatar" class="block_nav_picture index_3">
		<img src="../gallery/<?php echo $_SESSION['avatar'];?>" class="avatar nav_picture" alt="avatar"/>
	</div>
	<div id="banner_user" data-category="banner" class="block_nav_picture index_1">
		<img src="../gallery/<?php echo $_SESSION['banner']; ?>" class="banner nav_picture" alt="banniere"/>
	</div>
	<div id="picture_user" data-category="picture" class="block_nav_picture index_1">
			<img src="../gallery/<?php echo $picture; ?>" class="nav_picture" alt="picture"/>
	</div>
	<div id="block_gallery">
		<span id="category_pictures">Avatars</span>
		<div id="block_top_gallery_shadow">
			<div id="top_gallery_shadow" class="shadow_gallery"></div>
		</div>
		<div id="block_pictures" data-category="avatar">
			<div id="zone_pictures_1" class="zone_pictures">
				<img src="../gallery/avatar_default.png" class="select_picture avatars_css" data-file ="avatar_default.png" data-category="avatar" alt="avatar"/>
			</div>
			<div id="zone_pictures_2" class="zone_pictures">
				
			</div>
			<div id="zone_pictures_3" class="zone_pictures">
				
			</div>
		</div>
		<div id="select_btn_pictures">
				<div id="bot_gallery_shadow" class="shadow_gallery"></div>
				<span id="error_picture"></span>
				<span id="btn_modify_picture" class="btn_profil">Choisir cette image</span>
				<span id="btn_delete_picture" class="btn_profil">Supprimer cette image</span>
		</div>
	</div>
	<div id="forms_params">
		<div id="addPicture" class="zones">
			<form method="post" enctype="multipart/form-data">
				<div id="selectPicture">
					<label for="gallery_file" class="btn_profil">Choisissez une image <span id="icon_photo" class="material-icons">insert_photo</span></label>
					<input type="file" id="gallery_file" name="gallery_file"/>
					<p id="nameFile"></p>
				</div>
				<div>
					<label for="file_category">Choisissez la catégorie de votre image : </label><br/>
					<select id="file_category" class="inputs_profil warning_border" name="file_category">
						<option value=""></option>
						<option value="avatar">Avatar</option>
						<option value="picture">Image</option>
						<option value="banner">Bannière</option>
					</select><br/>
					<label for="file_title">Choisissez un titre (facultatif) : </label><br/>
					<input type="text" id="file_title" class="inputs_profil" name="file_title"/>
					<br/>
					<label for="file_description">Descrivez votre image (facultatif) : </label><br/>
					<textarea id="file_description"  class="inputs_profil" name="file_description"></textarea>					
				</div>
				<span id="error_add_picture" class="warning_background">Aucune image n'a été sélectionnée</span>
				<input type="submit" id="submit_file" class="btn_profil" name="submit_file" value="Ajoutez cette image à votre galerie"/>
			</form>
		</div>
		<div class="zones">
			<div id="updatePassword">
					<span id="button_form_mdp" class="btn_profil">Modifier votre mot-de-passe</span>
					<div id="form_old_mdp">
						<label for="old_mdp">Entrez votre ancien mot-de-passe :</label><br/>
						<input type="password" id="old_mdp" class="inputs_profil" name="old_mdp"/><br/>
						<input type="submit" id="submit_old_mdp" class="btn_profil" name="submit_old_mdp" value="Confirmer"/>
					</div>
					<div id="form_new_mdp">
						<label for="new_mdp">Entrez votre nouveau mot-de-passe :</label><br/>
						<input type="password" class="champs_new_mdp inputs_profil" id="new_mdp" name="new_mdp"/><br/>
						<label for="confirm_new_mdp">Confirmez votre nouveau mot-de-passe :</label><br/>
						<input type="password" class="champs_new_mdp inputs_profil" id="confirm_new_mdp" name="confirm_new_mdp"/><br/>
						<input type="submit" id="submit_new_mdp" class="btn_profil" name="submit_new_mdp" value="Confirmer"/>
					</div>
					<p id="error_new_mdp"></p>
			</div>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="public/js/profil.js"></script>