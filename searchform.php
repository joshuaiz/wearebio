<?php
/**
 * Template for displaying search form
 *
 * @package Mesh
 * @since Mesh 1.0
 */
?><!--BEGIN #searchform-->
<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
	<fieldset>
		<input type="text" name="s" id="s" value="<?php _e('Search...', 'zilla') ?>" onfocus="if(this.value=='<?php _e('Search...', 'zilla') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Search...', 'zilla') ?>';" />
	</fieldset>
<!--END #searchform-->
</form>