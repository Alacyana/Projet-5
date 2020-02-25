const space =
{
	addSpace : $("#add_space"),
	btnsModifySpace : (".modify_space"),
	btnDescription : $("#modify_description"),
	btnUpdateDescription : $("#update_description"),
	btnsCancel : $(".cancel"),
	selectPictureSpace : $(".pictures_add_post"),
	picture : "none",
	btnAddPicture : $('#btn_add_picture_post'),
	btnFormAddPost : $("#btn_add_post"),
	btnAddPost : $("#add_post"),
	btnsDeletePost : $('.btns_delete_post'),
	btnsConfirmDeletePost : $('.btns_confirm_delete_post'),
	
	init()
	{
		this.refresh();
		$(this.btnsCancel).on("click", this.cancel);
		$(this.btnsModifySpace).on("click", this.cancel);
		$(this.btnDescription).on("click", this.modifyDescription);
		$(this.btnUpdateDescription).on("click", this.updateDescription);
		$(this.selectPictureSpace).on("click", this.selectPicture);
		$(this.btnAddPicture).on("click", this.pastePicture);
		$(this.btnFormAddPost).on("click", this.formAddPost);
		$(this.btnAddPost).on("click", this.addPost);
		$(this.btnsDeletePost).on("click", this.showConfirmDeletePost);
		$(this.btnsConfirmDeletePost).on("click", this.deletePost);
	},
	
	refresh()
	{
		if(this.addSpace.text() != "")
		{
			setTimeout(function()
			{
				var user = space.addSpace.data("id");
				location.href = "http://lecture.nexus-archeage.fr/?action=space&user="+user;
			}, 5000);
		}
	},
	
	cancel()
	{
		$(".forms_space").hide();
		$(".areas_space").show();
	},
	
	modifyDescription()
	{	
		$('#description').hide();
		$('.form_description').show();
	},
	
	updateDescription()
	{
		var newDescription = $('#new_description').val();
		$.ajax(
		{
			type: "POST",
			url: "/?action=descriptionUpdate",
			data : {data_new_description : newDescription},
			success : function()
			{
				$('#description').text(newDescription);
				$('#description').show();
				$('.forms_space').hide();
			}
		});	
	},
	
	selectPicture()
	{
		space.picture = $(this).data('picture');
		space.selectPictureSpace.css('borderColor', 'black');
		$(this).css('borderColor', 'yellow');
	},
	
	pastePicture()
	{
		var picture = space.picture;
		
		if(picture == "none")
		{
			$('#previewPicture').attr("src", "");
		}
		else
		{
			$('#previewPicture').attr("src", "gallery/"+picture);
		}
	},
	
	formAddPost()
	{
		$('#btn_add_post').hide();
		$('#form_add_post').show();
	},
	
	addPost()
	{
		var title = $('#title_add_post').val();
		var subtitle = $('#subtitle_add_post').val();
		var text = $('#text_add_post').val();
		var picture = space.picture;
		$.ajax(
		{
			type: "POST",
			url: "/?action=addPostSpace",
			data : {data_title : title, data_subtitle : subtitle, data_text : text, data_picture : picture},
			success : function(status)
			{
				let statusAdd = JSON.parse(status);	
				
				if(statusAdd == 0)
				{
					$('#error_add_post_space').removeClass("success_background").addClass("warning_background");
					$('#error_add_post_space').text("Un titre et un contenu doivent être remplis pour ajouter un sujet.");
				}
				else if(statusAdd == 1)
				{
					$('#error_add_post_space').removeClass("warning_background");
					$('#error_add_post_space').text("");
					$('#form_add_post input').val("");
					$('#text_add_post').val("");
					$('#btn_add_post').show();
					$('.forms_space').hide();
					location.reload();
				}
			}
		});	
	},
	
	showConfirmDeletePost()
	{
		$(".forms_space").hide();
		$(this).next().css({"display":"block"});
		space.btnsDeletePost.hide();
	},
	
	deletePost()
	{
		var post = $(this).data('post');
console.log(post);		
		$.ajax(
		{
			type: "POST",
			url: "/?action=deletePost",
			data : {data_post : post},
			success : function(status)
			{
				let statusDelete = JSON.parse(status);	
				
				if(statusDelete == 0)
				{
					$('#errors_delete_post').removeClass("success_background").addClass("warning_background");
					$('#errors_delete_post').text("Une erreur est survenue.");
				}
				else if(statusDelete == 1)
				{
					$('#errors_delete_post').removeClass("warning_background");
					$('#errors_delete_post').text("");
					$('.forms_space').hide();
					space.btnsDeletePost.show();
					location.reload();
				}
			}
		});
	}
}	
space.init();