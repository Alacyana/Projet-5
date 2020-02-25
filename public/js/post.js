const post =
{
	btnModifyPostSpace : $("#btn_modify_post_space"),
	selectPictureSpace : $(".pictures_add_post"),
	picture : "none",
	btnAddPicture : $('#btn_modify_picture_post'),
	btnConfirmModifyPostSpace : $("#modify_post"),
	btnCancel : $(".cancel"),
	btnAddComm : $("#btn_add_comm"),
	
	init()
	{
		$(this.btnCancel).on("click", this.cancel);
		$(this.btnModifyPostSpace).on("click", this.showModifyPost);
		$(this.selectPictureSpace).on("click", this.selectPicture);
		$(this.btnAddPicture).on("click", this.pastePicture);
		$(this.btnConfirmModifyPostSpace).on("click", this.modifyPost);
		$(this.btnAddComm).on("click", this.addComm);
	},
	
	cancel()
	{
		$('.inputs_modify_post_space').hide();
		$('.post_space').show();
	},
	
	showModifyPost()
	{
		$('.post_space').hide();
		$('.inputs_modify_post_space').show();
		$('#title_modify_post').val($('#title_post').text());
		$('#subtitle_modify_post').val($('#subtitle_post').text());
		$('#text_modify_post').val($('#text_post').text());
	},
	
	selectPicture()
	{
		post.picture = $(this).data('picture');
		post.selectPictureSpace.css('borderColor', 'black');
		$(this).css('borderColor', 'yellow');
	},
	
	pastePicture()
	{
		var picture = post.picture;
		
		if(picture == "none")
		{
			$('#previewPicturePost').attr("src", "");
		}
		else
		{
			$('#previewPicturePost').attr("src", "gallery/"+picture);
		}
	},
	
	modifyPost()
	{
		var title = $('#title_modify_post').val();
		var subtitle = $('#subtitle_modify_post').val();
		var text = $('#text_modify_post').val();
		var postUpdate = $("#block_page").data("post");
		var picture = post.picture;
		$.ajax(
		{
			type: "POST",
			url: "/?action=modifyPostSpace",
			data : {data_title : title, data_subtitle : subtitle, data_text : text, data_post : postUpdate, data_picture : picture},
			success : function(status)
			{
				let statusModif = JSON.parse(status);	
				
				if(statusModif == 0)
				{
					$('#error_modify_post_space').removeClass("success_background").addClass("warning_background");
					$('#error_modify_post_space').text("Un titre et un contenu doivent être remplis pour ajouter un sujet.");
				}
				else if(statusModif == 1)
				{
					$('#error_modify_post_space').removeClass("warning_background");
					$('#error_modify_post_space').text("");
					$('.inputs_modify_post_space').val("");
					$('.inputs_modify_post_space').hide();
					$('.post_space').show();
					location.reload();
				}
			}
		});	
	},
	
	addComm()
	{
		var text_comment = $("#text_comm").val();
		var post = $("#block_page").data("post");
		if(text_comment != "")
		{
			$.ajax(
			{
				type: "POST",
				url: "/?action=addCommOnPostSpace",
				data : {data_text_comment : text_comment, data_post : post},
				success : function(status)
				{
					let statusComm = JSON.parse(status);	
					
					if(statusComm == 0)
					{
						$('#error_add_comm').removeClass("success_background").addClass("warning_background");
						$('#error_add_comm').text("Un contenu doit etre rempli pour ajouter un commentaire.");
					}
					else if(statusComm == 1)
					{
						$('#error_add_comm').removeClass("warning_background");
						$('#error_add_comm').text("");
						location.reload();
					}
				}
			});	
		}
	}
}
post.init();