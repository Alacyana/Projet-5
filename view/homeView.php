<div id="block_page">
	<div id="area_list_spaces" class="area_list">
<?php
	while($spaces = $getSpaces->fetch())
	{
?>	
		<a href="/?action=space&user=<?php echo $spaces['id_member_crypt']; ?>">
			<div class="list_spaces">
				<span class="pseudo_spaces"><?php echo $spaces['pseudo']; ?></span>
				<span class="description_spaces"><?php echo $spaces['description']; ?></span>
			</div>
		</a>
<?php
	}
?>
	</div>
	<div id="area_list_last_posts" class="area_list">
<?php
	while($posts = $getPosts->fetch())
	{
?>	
		<a href="/?action=post&id_post=<?php echo $posts['post_crypt']; ?>">
			<div class="list_posts">
				<span class="title_post"><?php echo $posts['title']; ?></span>
				<span class="subtitle_post"><?php echo $posts['subtitle']; ?></span>
				<span class="pseudo_post"><?php echo $posts['pseudo']; ?></span>
			</div>	
		</a>
<?php
	}
?>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="public/js/home.js"></script>