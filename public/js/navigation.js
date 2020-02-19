const navigation =
{
	registerForm : $("#register_form"),	
	loginForm : $("#login_form"),
	btnRegister : $("#register"),
	btnConnexion : $("#login"),
	btnDisconnection : $("#disconnection"),
	btnRegisterSubmit : $("#register_submit"),
	verifRegisterForm : false,
	btnLoginSubmit : $("#login_submit"),
	btnMdpForgot : $("#mdp_forgot"),
	mdpForgotForm : $("#mdp_forgot_form"),
	btnMdpForgotSubmit : $("#mdp_forgot_submit"),
	mdpUpdateForm : $("#mdp_update_form"),
	btnMdpUpdateSubmit : $("#mdp_update_submit"),
	verifUpdateMdpForm : false,
	
	init()
	{		
		$(this.btnRegister).on("click", this.register.bind(this));
		$(this.btnConnexion).on("click", this.login.bind(this));
		$(this.btnRegisterSubmit).on("click", this.registerSubmit.bind(this));
		$(this.btnLoginSubmit).on("click", this.loginSubmit.bind(this));
		$(this.btnDisconnection).on("click", this.disconnection.bind(this));
		$(this.btnMdpForgot).on("click", this.mdpForgot.bind(this));
		$(this.btnMdpForgotSubmit).on("click", this.mdpForgotSubmit.bind(this));
		$(this.btnMdpUpdateSubmit).on("click", this.mdpUpdateSubmit.bind(this));
		this.registerVerif();
		this.mdpUpdateForm();
	},
	
	register()
	{	
		$(this.loginForm).hide();
		$(this.mdpForgotForm).hide();
		$(this.registerForm).show();		
	},
	
	registerVerif()
	{			
		var username = $("#register_username");
		var mail = $("#register_mail");
		var mdp = $("#register_mdp");
		var confirm_mdp = $("#confirm_mdp");
		verifUsername = "";
		verifMail = "";
		verifMdp = "";
		verifConfirm = "";
		
		username.keyup(function()
		{
			if($(this).val().length > 3)
			{
				verifUsername = "1";
				$(this).removeClass("warning_border").addClass("success_border");
				$('#errors_register').text("");
			}
			else
			{
				verifUsername = "0";
				$(this).removeClass("success_border").addClass("warning_border");
				$('#errors_register').removeClass("success_background").addClass("warning_background");
				$('#errors_register').text("Votre pseudo doit contenir au minimum 3 caractères.");
			}
		});
		mail.keyup(function()
		{
			if($(this).val().match(/^(([a-z0-9!$%&\'+/=?^_`{|}~-]+.?)[a-z0-9!$%&\'+/=?^`{|}~-]+)@(([a-z0-9-]+.?)[a-z0-9-_]+).[a-z]{2,}$/i))
			{
				verifMail = "1";
				$(this).removeClass("warning_border").addClass("success_border");
				$('#errors_register').text("");
			}
			else
			{
				verifMail = "0";
				$(this).removeClass("success_border").addClass("warning_border");
				$('#errors_register').removeClass("success_background").addClass("warning_background");
				$('#errors_register').text("Vous devez entrer une adresse email valide.");
			}			
		});
		mdp.keyup(function()
		{
			if ($(this).val().length >= 8)
			{
				verifMdp = "1";
				$(this).removeClass("warning_border").addClass("success_border");
				$('#errors_register').text("");
			}
			else
			{
				verifMdp = "0";
				$(this).removeClass("success_border").addClass("warning_border");
				$('#errors_register').removeClass("success_background").addClass("warning_background");
				$('#errors_register').text("Votre mot-de-passe doit contenir au minimum 8 caratères.");
			}			
		});
		confirm_mdp.keyup(function()
		{
			if (mdp.val() == confirm_mdp.val())
			{
				verifConfirm = "1";
				$(this).removeClass("warning_border").addClass("success_border");
				$('#errors_register').text("");
			}
			else
			{
				verifConfirm = "0";
				$(this).removeClass("success_border").addClass("warning_border");
				$('#errors_register').removeClass("success_background").addClass("warning_background");
				$('#errors_register').text("Le mot-de-passe doit correspondre entre les deux champs.");
			}			
		});

		$('.champs').keyup(function()
		{		
			if (verifUsername == 1 && verifMail == 1 && verifMdp == 1 && verifConfirm == 1)
			{	
				navigation.verifRegisterForm = true;
			}
			else
			{
				navigation.verifRegisterForm = false;
			}
		});
	},
	
	registerSubmit()
	{
		let username = $("#register_username").val();
		let mail = $("#register_mail").val();
		let mdp = $("#register_mdp").val();
		let confirm_mdp = $("#confirm_mdp").val();
		
		if(navigation.verifRegisterForm == true)
		{
			$.ajax(
			{
				type: "POST",
				url: "/?action=register",
				data : {data_username : username, data_mail : mail, data_mdp : mdp, data_confirm : confirm_mdp},
				success : function(errors)
				{
					let error = JSON.parse(errors);
					let errorMail = error.errorMail;
					let errorUser = error.errorUser;
					let errorVerif = error.errorVerif;
					
					if (errorMail == true)
					{
						$('#errors_register').removeClass("success_background").addClass("warning_background");
						$('#errors_register').text("Cet email existe déjà.");
					}
					else
					{
						if (errorUser == true)
						{
							$('#errors_register').removeClass("success_background").addClass("warning_background");
							$('#errors_register').text("Ce pseudonyme existe déjà.");
						}
					}
					if (errorVerif == true)
					{
						$('#errors_register').removeClass("success_background").addClass("warning_background");
						$('#errors_register').text("Une erreur est survenue.");
					}
					if (errorMail == false && errorUser == false && errorVerif == false)
					{
						$('#errors_register').removeClass("warning_background").addClass("success_background");
						$('#errors_register').text("L'inscription a réussi ! Un email pour activer votre compte vous a été envoyé.");
						
						$(".champs").val("");		
						$(".champs").css("border-color", "#e0d1bd");
					}
				}				
			});
		}
	},
	
	login()
	{
		$(this.registerForm).hide();
		$(this.mdpForgotForm).hide();
		$(this.loginForm).show();
		
		$(".champs").val("");		
		$(".champs").css("border-color", "#e0d1bd");
	},
	
	loginSubmit()
	{
		let mail = $("#login_mail").val();
		let mdp = $("#login_mdp").val();
		
		if (mail != "" && mdp != "")
		{
			$.ajax(
			{
				type: "POST",
				url: "/?action=login",
				data : {data_mail : mail, data_mdp : mdp},
				success : function(errors)
				{
					let error = JSON.parse(errors);
					let errorLogin = error.errorLogin;
					let errorActivation = error.errorActivation;
					
					if (errorLogin == true)
					{
						$('#errors_login').removeClass("success_background").addClass("warning_background");
						$('#errors_login').text("L'email et le mot-de-passe ne correspondent pas.");
					}
					if (errorActivation == true)
					{
						$('#errors_login').removeClass("success_background").addClass("warning_background");
						$('#errors_login').text("Votre compte n'est pas activé. Veuillez l'activer à l'aide du lien envoyé par email.");
					}
					else if (errorActivation == false)
					{
						location.reload();
					}
				}
			});
		}
		else
		{
			$('#errors_login').removeClass("success_background").addClass("warning_background");
			$('#errors_login').text("Entrez votre email et mot-de-passe pour vous connecter.");
		}
	},
	
	mdpForgot()
	{
		$(this.loginForm).hide();
		$(this.mdpForgotForm).show();
	},
	
	mdpForgotSubmit()
	{
		let mail = $("#mdp_forgot_mail").val();
		
		if (mail != "")
		{
			$.ajax(
			{
				type: "POST",
				url: "/?action=mdpForgot",
				data : {data_mail : mail},
				success : function(errorMail)
				{
					let error = JSON.parse(errorMail);
					
					if (error == true)
					{
						$('#errors_mdp_forgot').removeClass("success_background").addClass("warning_background");
						$('#errors_mdp_forgot').text("L'email "+mail+" n'existe pas.");
					}
					else if (error == false)
					{
						$('#errors_mdp_forgot').removeClass("warning_background").addClass("success_background");
						$('#errors_mdp_forgot').text("Un email vous a été envoyé à cette adresse : "+mail+".");
						$("#mdp_forgot_mail").val("");
					}
				}
			});
		}
		else
		{
			$('#errors_mdp_forgot').removeClass("success_background").addClass("warning_background");
			$('#errors_mdp_forgot').text("Entrez votre email pour récupérer votre mot-de-passe.");
		}
	},
	
	mdpUpdateForm()
	{
		let mdp = $("#mdp_update_mdp");
		let confirm_mdp = $("#mdp_update_confirm_mdp");
		
		mdp.keyup(function()
		{
			if ($(this).val().length >= 8)
			{
				verifMdp = "1";
				$(this).removeClass("warning_border").addClass("success_border");
				$('#errors_mdp_update').text("");
			}
			else
			{
				verifMdp = "0";
				$(this).removeClass("success_border").addClass("warning_border");
				$('#errors_mdp_update').removeClass("success_background").addClass("warning_background");
				$('#errors_mdp_update').text("Votre mot-de-passe doit contenir au minimum 8 caratères.");
			}		
		});
		confirm_mdp.keyup(function()
		{
			if (mdp.val() == confirm_mdp.val())
			{
				verifConfirm = "1";
				$(this).removeClass("warning_border").addClass("success_border");
				$('#errors_mdp_update').text("");
			}
			else
			{
				verifConfirm = "0";
				$(this).removeClass("success_border").addClass("warning_border");
				$('#errors_mdp_update').removeClass("success_background").addClass("warning_background");
				$('#errors_mdp_update').text("Le mot-de-passe doit correspondre entre les deux champs.");
			}
		});
		$('.champs_mdp').keyup(function()
		{	
			if(verifMdp == 1 && verifConfirm == 1)
			{
				navigation.verifUpdateMdpForm = true;
			}
			else
			{
				navigation.verifUpdateMdpForm = false;
			}
		});
	},
	
	mdpUpdateSubmit()
	{
		if(this.verifUpdateMdpForm == true)
		{
			let mdp = $("#mdp_update_mdp").val();
			let confirm_mdp = $("#mdp_update_confirm_mdp").val();
			let token = $('#mdp_update').attr("name");
			$.ajax(
			{
				type: "POST",
				url: "/?action=mdpUpdate",
				data : {data_mdp : mdp, data_confirm : confirm_mdp, data_token : token},
				success : function(errorMdp)
				{
					let error = JSON.parse(errorMdp);
					
					if (error == true)
					{
						$('#errors_mdp_update').removeClass("success_background").addClass("warning_background");
						$('#errors_mdp_update').text("La modification du mot-de-passe est impossible.");
					}
					else
					{
						$('#errors_mdp_update').removeClass("warning_background").addClass("success_background");
						$('#errors_mdp_update').text("Le mot-de-passe a été modifié avec succès. Redirection en cours...");
						setTimeout(function()
						{
							location.href="http://lecture.nexus-archeage.fr";
						},5000);
					}
				}				
			});
		}
	},
	
	disconnection()
	{
		$.ajax(
		{
			type: "POST",
			url: "/?action=disconnection",
			success : function()
			{
				location.reload();
			}
		});
	}
}	