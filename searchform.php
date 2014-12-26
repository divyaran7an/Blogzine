<form method="get" class="search-form" action="<?php echo home_url(); ?>">
	<input type="text" value="search" name="s" id="s" onblur="if(this.value=='')this.value='search'" onfocus="if(this.value=='search')this.value=''" />
	<input type="hidden" value="submit" />
</form>