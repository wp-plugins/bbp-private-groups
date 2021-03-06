<?php //************************* Group name settings *************************// 
Function pg_role_assignment () { ?>
			<?php global $rpg_roles;
				global $wp_roles;
				global $rpg_groups ;
				$all_roles = $wp_roles->roles ;
				
?>
			<form method="post" action="options.php">
			
			<?php settings_fields( 'rpg_roles_settings' ); ?>
			
			<table class="form-table">
			
			<tr valign="top">
			<th colspan="2"><p>
			<?php _e ('This section is optional and designed to allow those of you who use membership plugins etc. to assign a group against a wordpress or custom role.', 'bbp-private-groups') ; ?>
			</p>
			<p> 
			<?php _e ( 'By entering a group against a role, new users with that role will be allocated the group automatically as part of the registration process.  You can subsequently change individual users, and changing elements in this tab will only affect new registrations, not change anyone who has already registered.', 'bbp-private-groups'); ?>
			</p>
			<p>
			<?php _e ('For instance you may want all wordpress authors to automatically belong to a particular group, or you may have created a role called "member" in your membership plugin, and want to automatically give these access to a private group called say membership.' , 'bbp-private-groups') ; ?>
			</p>
			<p>
			<?php _e ('This section only applies to wordpress or custom or membership roles, NOT bbpress roles !' , 'bbp-private-groups' ) ; ?>
			</p>
			</th></tr>
			
			<tr><td colspan=2><hr></td>
			
			<!-- checkbox to activate login -->
					</tr>
					<tr valign="top">
					<td colspan=2><?php _e('Additionally you can optionally select to assign roles on login for users who do not have a role assigned. This is useful where your membership plugin does not use Wordpress registration, so the above does not work!. You can assign a <i> different </i> role to individual users manually, but if you change an individual user to have no groups, then the group for that role will be assigned on next login as the plugin sees this as blank!', 'bbp-private-groups'); ?></td>
					</tr>
					<tr valign="top">  
					<th><?php _e('Add group on login', 'bbp-private-groups'); ?></th>
					<td>
					<?php global $rpg_roles ;
					$item = (!empty( $rpg_roles['login'] ) ?  $rpg_roles['login'] : '');
					//$item =  $rpg_roles['login'] ;
					echo '<input name="rpg_roles[login]" id="rpg_roles[login]" type="checkbox" value="1" class="code" ' . checked( 1,$item, false ) . ' />' ;
					?>
					</td>
			<tr><td colspan=2><hr></td>	
							
			<?php foreach($all_roles as $role=>$value) { 
			$name = $value['name'] ; 
			$item="rpg_roles[".$role."]" ;
			if (substr($role,0,4) != 'bbp_') {
			?>
			<!-------------------------  Role  --------------------------------------------->		
					<tr valign="top">
					<th><?php echo $name ?></th>
					<td>
					<?php echo '<select name="'.$item.'">'; ?>
					<?php echo ' ' ; ?>
				 	<?php if ($rpg_roles[$role] != 'no-Group') {
					$name2= $rpg_roles[$role] ;
					$item2=$name2.'  '.$rpg_groups[$name2] ;
					if ($name2 != '') $item2=$name2.'  '.$rpg_groups[$name2]  ;
					?>
					<option value="<?php echo $name2 ?>"><?php echo $item2 ?></option>
					<?php  }		?>			
					<option value="no-group"> <?php _e( 'no-Group', 'bbp-private-groups') ?></option>
					<?php
					//sets up the groups as actions
						$count=count ($rpg_groups) ;
						for ($i = 0 ; $i < $count ; ++$i) { 
						$g=$i+1 ;
						$name2="group".$g ;
						$item2=__( 'Group', 'bbp-private-groups' ).$g.'  '.$rpg_groups[$name2]  ;
						//$item2=$name2.'  '.$rpg_groups[$name2] ;
						?>
						<option value="<?php echo $name2 ?>"><?php echo $item2 ?></option>
								
						<?php } ?>
					</select>
					</td>
					</tr>
					<?php }}
					?>
					</td>
					</tr>
					</table>
					<!-- save the options -->
				<p class="submit">
					<input type="submit" value="<?php _e( 'Save Changes','bbp-private-groups' ); ?>" class="button action doaction" name="">
				</p>
				</form>
		</div><!--end sf-wrap-->
	</div><!--end wrap-->
	
<?php
}
?>