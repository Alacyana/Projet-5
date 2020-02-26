const profil =
{
	blocksNavPictures : $(".block_nav_picture"),
	picture : $('.select_picture'),
	thisPicture : "",
	addFile : $('#gallery_file'),
	fileCategory : $("#file_category"),
	btnModifyPicture : $("#btn_modify_picture"),
	selectPictureFile : "",
	selectPictureCategory : "",
	btnDeletePicture : $("#btn_delete_picture"),
	btnDisplayFormOldMdp : $("#button_form_mdp"),
	formOldMdp : $("#form_old_mdp"),
	btnSubmitOldMdp : $("#submit_old_mdp"),
	formNewMdp : $("#form_new_mdp"),
	btnSubmitNewMdp : $("#submit_new_mdp"),
	resultNewMdp : false,
	
	init()
	{
		this.gallery();
		$(this.blocksNavPictures).on("click", this.showPictures);
		$(this.picture).on("click", this.selectPicture);
		$(this.addFile).on("change", this.file.bind(this));
		$(this.fileCategory).on("change", this.category.bind(this));
		$(this.btnModifyPicture).on("click", this.updatePicture.bind(this));
		$(this.btnDeletePicture).on("click", this.deletePicture.bind(this));
		$(this.btnDisplayFormOldMdp).on("click", this.displayFormOldMdp.bind(this));
		$(this.btnSubmitOldMdp).on("click", this.checkMdp.bind(this));
		$(this.btnSubmitOldMdp).on("click", this.verifNewMdp.bind(this));
		$(this.btnSubmitNewMdp).on("click", this.updateMdp.bind(this));
	},
	
	file()
	{
		$('#nameFile').text(this.addFile.val());
		var nameFile = $('#nameFile').text();
		if(nameFile != "")
		{
			$("#error_add_picture").hide();
			$("#submit_file").show();
		}
		else
		{
			$("#error_add_picture").show();
			$("#submit_file").hide();
		}
	},
	
	category()
	{
		var category = $("#file_category").val();
		if(category != "")
		{
			$("#file_category").removeClass("warning_border").addClass("success_border");
		}
		else
		{
			$("#file_category").removeClass("success_border").addClass("warning_border");
		}
	},

	gallery()
	{
		var category = "avatar";
		$.ajax(
		{
			type: "POST",
			url: "/?action=showPictures",
			data : {data_category : category},
			success : function(datas)
			{					
				var boucle = 2;
				let data = JSON.parse(datas);
				for(var i in data)
				{
					var description = data[i].description;
					if(description == undefined)
					{
						description = category;
					}
					if(boucle == 1)
					{
						$('#zone_pictures_1').append('<img src="../gallery/'+data[i].picture+'" class="select_picture '+category+'s_css" data-file="'+data[i].picture+'" data-category="'+category+'"data-col="'+boucle+'"alt="'+description+'"/>');
						boucle++;
					}	
					else if(boucle == 2)
					{
						$('#zone_pictures_2').append('<img src="../gallery/'+data[i].picture+'" class="select_picture '+category+'s_css" data-file="'+data[i].picture+'" data-category="'+category+'" data-col = "'+boucle+'" alt="'+description+'"/>');
						boucle++;
					}
					else if(boucle >= 3)
					{
						$('#zone_pictures_3').append('<img src="../gallery/'+data[i].picture+'" class="select_picture '+category+'s_css" data-file="'+data[i].picture+'" data-category="'+category+'" data-col = "'+boucle+'" alt="'+description+'"/>');
						boucle = 1;
					}
				}	
				profil.picture = $('.select_picture');
				$(profil.picture).on("click", profil.selectPicture);
			}
		});
	},
	
	showPictures()
	{
		var category = $(this).data('category');
		$(profil.blocksNavPictures).removeClass('index_3').addClass('index_1');
		$(this).removeClass('index_1').addClass('index_3');
		var categoryBlockPicture = $('#block_pictures').data("category");
		if(category != categoryBlockPicture)
		{
			if(category == "avatar")
			{
				$("#category_pictures").text("Avatars");
			}
			else if(category == "banner")
			{
				$("#category_pictures").text("Bannières");
			}
			else if(category == "picture")
			{
				$("#category_pictures").text("Autres images");
			}
			$('#block_pictures').data("category", category);
			$('.zone_pictures').text("");
			$('#error_picture').text("");
			$('#error_picture').removeClass("warning_background");
			
			$.ajax(
			{
				type: "POST",
				url: "/?action=showPictures",
				data : {data_category : category},
				success : function(datas)
				{					
					var boucle = 0;
					let data = JSON.parse(datas);
					if(category == "avatar")
					{
						boucle++;
						$('#zone_pictures_1').append('<img src="../gallery/avatar_default.png" class="select_picture avatars_css" data-file="avatar_default.png" data-category="avatar" alt="avatar"/>');						
					}
					else if(category == "banner")
					{
						boucle++;
						$('#zone_pictures_1').append('<img src="../gallery/banner_default.png" class="select_picture banners_css" data-file="banner_default.png" data-category="banner" alt="banniere"/>');
					}
					if(category == "picture")
					{
						profil.btnModifyPicture.hide();
					}
					else
					{
						profil.btnModifyPicture.show();
					}
					for(var i in data)
					{
						boucle++;
						var description = data[i].description;
						if(description == undefined)
						{
							description = category;
						}
						if(boucle == 1)
						{
							$('#zone_pictures_1').append('<img src="../gallery/'+data[i].picture+'" class="select_picture '+category+'s_css" data-file="'+data[i].picture+'" data-category="'+category+'" data-col = "'+boucle+'" alt="'+description+'"/>');
						}	
						else if(boucle == 2)
						{
							$('#zone_pictures_2').append('<img src="../gallery/'+data[i].picture+'" class="select_picture '+category+'s_css" data-file="'+data[i].picture+'" data-category="'+category+'" data-col = "'+boucle+'" alt="'+description+'"/>');
						}
						else if(boucle >= 3)
						{
							$('#zone_pictures_3').append('<img src="../gallery/'+data[i].picture+'" class="select_picture '+category+'s_css" data-file="'+data[i].picture+'" data-category="'+category+'" data-col = "'+boucle+'" alt="'+description+'"/>');
							boucle = 0;
						}
						
					}	
					profil.picture = $('.select_picture');
					$(profil.picture).on("click", profil.selectPicture);
				}
			});
		}
	},
	
	selectPicture()
	{				
		profil.selectPictureFile = $(this).data('file');
		profil.selectPictureCategory = $(this).data('category');
		profil.thisPicture = $(this);
		profil.picture.css('borderColor', 'black');
		$(this).css('borderColor', 'yellow');	
	},
	
	updatePicture()
	{
		var picture = profil.selectPictureFile;
		var category = profil.selectPictureCategory;
		if(picture != "")
		{
			$.ajax(
			{
				type: "POST",
				url: "/?action=updatePicture",
				data : {data_picture : picture, data_category : category},
				success : function(error_picture)
				{					
					let error = JSON.parse(error_picture);						
					if (error == 1)
					{
						$(".avatar").attr("src", "../gallery/"+picture);
					}
					else if (error == 2)
					{
						$(".banner").attr("src", "../gallery/"+picture);
					}
				}
			});
		}
	},
	
	deletePicture()
	{		
		var picture = profil.selectPictureFile;
		var category = profil.selectPictureCategory;
		if(picture != "")
		{
			$.ajax(
			{
				type: "POST",
				url: "/?action=deletePicture",
				data : {data_picture : picture, data_category : category},
				success : function(deleteStatus)
				{					
					let status = JSON.parse(deleteStatus);					
					switch (status)
					{			
						case 0:
							$('#error_picture').removeClass("success_background").addClass("warning_background");
							$('#error_picture').text("Une erreur est survenue.");
						break;
						case 1:					
							$('#error_picture').removeClass("success_background").addClass("warning_background");
							$('#error_picture').text("Vous ne pouvez pas supprimer cette image.");
						break;
						case 2:
							profil.thisPicture.remove();
						break;
						case 3:
							profil.thisPicture.remove();
							$(".avatar").attr("src", "../gallery/avatar_default.png");
						break;
						case 4:
							profil.thisPicture.remove();
							$(".banner").attr("src", "../gallery/banner_default.png");
						break;
					}
				}
			});
		}
	},
	
	displayFormOldMdp()
	{
		$(this.btnDisplayFormOldMdp).hide();
		$(this.formOldMdp).show();
	},
	
	checkMdp()
	{
		let oldMdp = $("#old_mdp").val();	
		if (oldMdp != "")
		{			
			$.ajax(
			{
				type: "POST",
				url: "/?action=checkMdp",
				data : {data_oldMdp : oldMdp},
				success : function(error_mdp)
				{					
					let error = JSON.parse(error_mdp);				
					if (error == true)
					{
						$('#error_new_mdp').removeClass("success_background").addClass("warning_background");
						$('#error_new_mdp').text("Le mot-de-passe n'est pas valide.");
					}
					else if (error == false)
					{
						$('#error_new_mdp').text("");
						$('#error_new_mdp').removeClass("warning_background");
						$(profil.formOldMdp).hide();
						$(profil.formNewMdp).show();
					}
				}
			});
		}
	},
	
	verifNewMdp()
	{
		let newMdp = $("#new_mdp");
		let confirmNewMdp = $("#confirm_new_mdp");
		let statusNewMdp;
		let statusNewConfirm;
		
		newMdp.keyup(function()
		{
			if ($(this).val().length >= 8)
			{
				statusNewMdp = "1";
				$(this).removeClass("warning_border").addClass("success_border");
				$('#error_new_mdp').text("");
			}
			else
			{
				statusNewMdp = "0";
				$(this).removeClass("success_border").addClass("warning_border");
				$('#error_new_mdp').removeClass("success_background").addClass("warning_background");
				$('#error_new_mdp').text("Votre mot-de-passe doit contenir au minimum 8 caratères.");
			}			
		});
		confirmNewMdp.keyup(function()
		{
			if (newMdp.val() == confirmNewMdp.val())
			{
				statusNewConfirm = "1";
				$(this).removeClass("warning_border").addClass("success_border");
				$('#error_new_mdp').text("");
			}
			else
			{
				statusNewConfirm = "0";
				$(this).removeClass("success_border").addClass("warning_border");
				$('#error_new_mdp').removeClass("success_background").addClass("warning_background");
				$('#error_new_mdp').text("Le mot-de-passe doit correspondre entre les deux champs.");
			}			
		});
		
		$('.champs_new_mdp').keyup(function()
		{		
			if (statusNewMdp == 1 && statusNewConfirm == 1)
			{	
				profil.resultNewMdp = true;
			}
			else
			{
				profil.resultNewMdp = false;
			}
		});
		
	},
	
	updateMdp()
	{
		if (this.resultNewMdp == true)
		{		
			let oldMdp = $("#old_mdp").val();
			let newMdp = $("#new_mdp").val();
			let confirmNewMdp = $("#confirm_new_mdp").val();	
			$.ajax(
			{
				type: "POST",
				url: "/?action=updateMdpProfil",
				data : {data_oldMdp : oldMdp, data_new_mdp : newMdp, data_confirm_new_mdp : confirmNewMdp},
				success : function(error_update_mdp)
				{				
					let error = JSON.parse(error_update_mdp);				
					switch (error)
					{			
						case 1:
							var errorText = "Impossible de récupérer l'ancien mot-de-passe.";
							var addClass = "warning_background";
							var removeClass = "success_background";
						break;
						case 2:
							var errorText = "Un problème est survenu avec votre nouveau mot-de-passe.";
							var addClass = "warning_background";
							var removeClass = "success_background";
						break;
						case 3:
							var errorText = "Votre mot-de-passe a bien été modifié.";
							var addClass = "success_background";
							var removeClass = "warning_background";
							$("#old_mdp").val("");
							$("#new_mdp").val("");
							$("#confirm_new_mdp").val("");
							$(profil.formNewMdp).hide();
						break;
					}
					$('#error_new_mdp').text(errorText);
					$('#error_new_mdp').removeClass(removeClass).addClass(addClass);
				}
			});
		}
	}
	
}	
profil.init();