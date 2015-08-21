<?php
/* existing functions.php file; add these snippets to add in extra profile fields */
// Function for adding fields
function extra_profile_fields($user) { ?>
 <h3><?php _e('Angling Details', 'frontendprofile'); ?></h3>
 <table class="form-table">
 <tr>
   <th><label for="uk_personal_best">UK Personal Bests</label></th>
   <td>
     <input type="text" name="uk_personal_bests" id="uk_personal_bests" value="<?php echo esc_attr(get_the_author_meta('uk_personal_bests', $user->ID)); ?>" class="regular-text" /><br />
     <span class="description">Enter your UK Personal Bests (species / weight).</span>
   </td>
 </tr>
</table>
<?php }

// Adding actions to show and edit the field
add_action('show_user_profile', 'extra_profile_fields', 10);
add_action('edit_user_profile', 'extra_profile_fields', 10);

function save_extra_profile_fields($user_id) {
	if (!current_user_can('edit_user', $user_id))
		return false;

	/* Edit the following lines according to your set fields */
	update_usermeta($user_id, 'uk_personal_bests', $_POST['uk_personal_bests']);
}

add_action('personal_options_update', 'save_extra_profile_fields');
add_action('edit_user_profile_update', 'save_extra_profile_fields');

?>
