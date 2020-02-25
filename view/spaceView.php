<div id="block_page">
	<?php
	if(!isset($resultSpace["id"]))
	{
		if(isset($_SESSION['id']))
		{
?>
		<p id="add_space" data-id="<?php echo $_GET['user'];?>">
			Création de l'espace en cours...
		</p>
<?php		
		} 
	}
	else
	{
?>		
		
		<span id="title">L'espace de <?php echo htmlspecialchars($resultMember['pseudo']); ?></span>
		<br/>
		<span id="block_description">
			<span id="description" class="areas_space">
<?php 
			if($resultSpace['description'] == "")
			{
				$description = "description";
			}
			else
			{
				$description = $resultSpace['description'];
			}
			echo $description;
?>		
			</span>
<?php	
		if($resultMember['id_member'] == $_SESSION['id'])
		{
?>			
			<span id="modify_description" class="material-icons modify_space">settings</span>	
				<br/>
				<textarea id="new_description"  class="forms_space form_description"><?php echo htmlspecialchars($description); ?></textarea>
				<br/>
		
				<span id="update_description"  class="forms_space form_description btn_forms_space">Modifier</span>
				<span class="cancel forms_space form_description btn_forms_space">Annuler</span>
				
				
			
			<span id="error_description"></span>
<?php 
		}
?>			
		</span>
<?php 
	if($resultMember['id_member'] == $_SESSION['id'])
	{
?>		
		<div id="area_pictures_space">
				<span class="pictures_add_post" data-picture="none">
					<img src="" alt="image"/>
				</span>
<?php
		while($picturesSpace = $getsPictures->fetch())
		{
?>		
				<span class="pictures_add_post" data-picture="<?php echo $picturesSpace['picture']; ?>">
					<img src="gallery/<?php echo $picturesSpace['picture']; ?>" alt="image"/>
				</span>
<?php
		}
?>	
		</div>
		<div id="area_add_post">
			<span id="btn_add_post" class="material-icons areas_space modify_space">add</span>
			<span id="form_add_post" class="forms_space" style="display:none">
				<label for="title_add_post">Titre du sujet :</label><br/>
				<input type="text" id="title_add_post" class="forms_posts_space"/>
				<label for="subtitle_add_post">Sous-titre du sujet :</label><br/>
				<input type="text" id="subtitle_add_post" class="forms_posts_space"/>
				<label for="picture_add_post">Sélectionnez votre image :</label>
				<span id="btn_add_picture_post" class="material-icons">add_photo_alternate</span><br/>
				<img id="previewPicture" src=""/>				
				<label for="text_add_post">Contenu du sujet :</label><br/>
				<textarea id="text_add_post" class="forms_posts_space"></textarea>
				<span id="add_post" class="btn_forms_space">Ajouter</span>
				<span class="cancel btn_forms_space">Annuler</span>
				<span id="error_add_post_space"></span>	
			</span>
		</div>
<?php 
	}
?>		
		
		<div id="block_posts">
			
<?php
	while($postsSpace = $getsPosts->fetch())
	{
?>
			<div class="posts_space">
				<a href="/?action=post&id_post=<?php echo htmlspecialchars($postsSpace['post_crypt']);?>" class="area_posts">
					<span class="title_posts"><?php echo htmlspecialchars($postsSpace['title']);?></span>
					<span class="subtitle_posts"><?php echo htmlspecialchars($postsSpace['subtitle']);?></span>
					<span class="text_posts"><?php echo nl2br(htmlspecialchars($postsSpace['text']));?></span>
					<span class="dates_creation"><?php echo htmlspecialchars($postsSpace['date_creation']);?></span>
				</a>
<?php 
	if($resultMember['id_member'] == $_SESSION['id'])
	{
?>					
				<span class="btns_delete_post material-icons areas_space">clear</span>
				<span class="form_delete_post forms_space" style="display:none">
						<span class="btns_confirm_delete_post btn_forms_space" data-post="<?php echo htmlspecialchars($postsSpace['post_crypt']);?>">Confirmer la suppression</span>
						<span class="cancel btn_forms_space">Annuler</span>
						<span class="errors_delete_post"></span>
				</span>
<?php 
	}
?>				
			</div>
<?php
	}
?>
		</div>
		
		
		
		
		
		
		
		
		
		
		
<?php		
	}
	?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="public/js/space.js"></script>