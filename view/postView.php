<div id="block_page" data-post="<?php echo $_GET['id_post']; ?>">
<?php
	if(isset($post['id']))
	{
?>
	<div id="post_area">		
			<div id="area_pictures_post" class="inputs_modify_post_space">
				<span class="pictures_add_post" data-picture="none">
					<img src="" alt="image"/>
				</span>
<?php
	while($picturesPost = $getsPictures->fetch())
	{
?>		
				<span class="pictures_add_post" data-picture="<?php echo $picturesPost['picture']; ?>">
					<img src="gallery/<?php echo $picturesPost['picture']; ?>" alt="image"/>
				</span>
<?php
	}
?>	
			</div>
		<span id="title_post" class="post_space"><?php echo htmlspecialchars($post['title']);?></span>
	
			<label for="title_modify_post" class="inputs_modify_post_space">Titre du sujet :</label>
			<input type="text" id="title_modify_post" class="inputs_modify_post_space"/><br/>
		<span id="subtitle_post" class="post_space"><?php echo htmlspecialchars($post['subtitle']);?></span>
			<label for="subtitle_modify_post" class="inputs_modify_post_space">Sous-titre du sujet :</label>
			<input type="text" id="subtitle_modify_post" class="inputs_modify_post_space"/><br/>
<?php
	if($post['picture'] != "")
	{
?>			<span id="picture_post" class="post_space">
				<img src="gallery/<?php echo $post['picture'];?>" alt="image du sujet"/>
			</span>
<?php
	}
?>
			<label for="btn_modify_picture_post" class="inputs_modify_post_space">Sélectionnez votre image :</label>
			<span id="btn_modify_picture_post" class="material-icons inputs_modify_post_space">add_photo_alternate</span><br/>
			<img id="previewPicturePost"  class="inputs_modify_post_space" src=""/>
		<div id="block_text_post">
			<span id="text_post" class="post_space"><?php echo nl2br(htmlspecialchars($post['text']));?></span>
				<label for="text_modify_post" class="inputs_modify_post_space">Contenu du sujet :</label>
				<textarea id="text_modify_post" class="inputs_modify_post_space"></textarea>
			<span id="date_modification_post">modifié <?php echo htmlspecialchars($post['date_modification']);?></span>
		</div>
<?php 
	if($post['id_member'] == $_SESSION['id'])
	{
?>		
		<span id="btn_modify_post_space" class="material-icons">settings</span>
			<span id="modify_post" class="inputs_modify_post_space">Modifier</span>
			<span class="cancel inputs_modify_post_space">Annuler</span>
			<span id="error_modify_post_space" class="inputs_modify_post_space"></span>
<?php 
	}
?>			
	</div>
	<div id="comments_area">
		<span id="comments_post">Commentaires</span>
<?php 
	if($post['id_member'] == $_SESSION['id'])
	{
?>			
		<div id="form_comms">
			<textarea id="text_comm"></textarea>
			<span id="btn_add_comm">Ajouter le commentaire</span>
			<span id="error_add_comm"></span>
		</div>
<?php 
	}
?>			
		<div id="area_comments">
<?php
	while($comments = $getComments->fetch())
	{
?>
		
			<div class="comments">
				<span class="block_pictures_comments">
					<span class="pseudos_comm"><?php echo htmlspecialchars($comments["pseudo"]); ?></span>
					<img src="gallery/<?php echo htmlspecialchars($comments["avatar"]); ?>" alt="avatar" class="avatar_comments"/>
					<img src="gallery/<?php echo htmlspecialchars($comments["banner"]); ?>" alt="banniere" class="banner_comments"/>
				</span>
				
				
				<span class="texts_comm"><?php echo htmlspecialchars($comments["comment_text"]); ?></span>
				<span class="dates_comm"><?php echo $comments["date_creation"]; ?></span>
			</div>
<?php
	}
?>
		</div>
	</div>
		
<?php
	}
?>		
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="public/js/post.js"></script>