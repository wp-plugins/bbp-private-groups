<?php
function rpg_user_profile_field() {
	 global $current_user;
	 global $rpg_groups ;
	 
		
		
	 if (isset($_REQUEST['user_id'])) {
		$user_id = $_REQUEST['user_id'];
	 } else {
		$user_id = $current_user->ID;
	 }
		?>
	 <table class="form-table">
			<tbody>
				<tr>
					<th><label for="bbp-private-groups"><?php esc_html_e( 'Group', 'private-groups' ); ?></label></th>
					<td>

						<select name="bbp-private-groups" id="group">
						<?php global $rpg_groups ;
							if (empty( $rpg_groups ) ) : ?>

							<option value=""><?php esc_html_e( '&mdash; No groups yet set up &mdash;', 'private-groups' ); ?></option>

							<?php else : ?>
							<?php $private_group = get_user_meta($user_id, 'private_group', true); ?>
								<option value="" selected="selected"><?php esc_html_e( '&mdash; No group &mdash;', 'bbpress' ); ?></option>

							<?php endif; ?>

							<?php foreach ( $rpg_groups as $group => $details ) : ?>

								<option <?php selected( $private_group, $group ); ?> value="<?php echo esc_attr( $group ); ?>"><?php echo $group.' '.$details ; ?></option>

							<?php endforeach; ?>

						</select>
					</td>
				</tr>

			</tbody>
		</table>
		<?php
		
		
		}
		
		
		// User profile edit/display actions
		add_action( 'edit_user_profile', 'rpg_user_profile_field', 50,2 )  ;
		
function bbp_edit_user_rpg( $user_id ) {
	$private_group = ( $_POST['bbp-private-groups'] ) ;
	

	// Update town user meta
	if ( !empty( $private_group ) )
		update_user_meta( $user_id, 'private_group', $private_group);

	// Delete town user meta
	else
		delete_user_meta( $user_id, 'private_group' );
		

}

add_action( 'edit_user_profile_update', 'bbp_edit_user_rpg' );