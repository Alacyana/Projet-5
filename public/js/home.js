const home =
{
	blocksNavPictures : $(".block_nav_picture"),
	
	init()
	{
		$(this.blocksNavPictures).on("click", this.showPictures);
		
	},
	
}	
home.init();