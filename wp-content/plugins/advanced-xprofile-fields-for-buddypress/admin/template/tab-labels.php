<div id="axf-labels" class="inside">
	<table class="form-table">
		<tr>
			<th scope="row">
				<label>
					<?php esc_html_e( 'Registration', 'sp-advanced-xprofile' ); ?>
				</label>
			</th>
			<td>
				<input type="text" name="advanced_xprofile[registration]" value="<?php echo wp_kses_post( $r['registration'] ); ?>" class="regular-text" />
				<p class="description">
					<?php esc_html_e( 'Label on registration page', 'sp-advanced-xprofile' ); ?>
				</p>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label>
					<?php esc_html_e( 'Self Profile', 'sp-advanced-xprofile' ); ?>
				</label>
			</th>
			<td>
			<input type="text" name="advanced_xprofile[self]" value="<?php echo wp_kses_post( $r['self'] ); ?>" class="regular-text" />
				<p class="description">
					<?php esc_html_e( 'Label while viewing your profile', 'sp-advanced-xprofile' ); ?>
				</p>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label>
					<?php esc_html_e( 'User\'s Profile', 'sp-advanced-xprofile' ); ?>
				</label>
			</th>
			<td>
				<input type="text" name="advanced_xprofile[user]" value="<?php echo wp_kses_post( $r['user'] ); ?>" class="regular-text" />
				<p class="description">
				<?php esc_html_e( 'Label while viewing another member\'s page', 'sp-advanced-xprofile' ); ?>
				</p>
			</td>
		</tr>
		<tr>
			<th scope="row">
			<label>
				<?php esc_html_e( 'Edit Profile', 'sp-advanced-xprofile' ); ?>
			</label>
			</th>
			<td>
				<input type="text" name="advanced_xprofile[edit]" value="<?php echo wp_kses_post( $r['edit'] ); ?>" class="regular-text" />
				<p class="description">
					<?php esc_html_e( 'Label on edit profile page', 'sp-advanced-xprofile' ); ?>
				</p>
			</td>
		</tr>
		<tr>
			<th scope="row">
			<label>
				<?php esc_html_e( 'Admin Column', 'sp-advanced-xprofile' ); ?>
			</label>	
			</th>
			<td>
				<input type="text" name="advanced_xprofile[admin]" value="<?php echo wp_kses_post( $r['admin'] ); ?>" class="regular-text" />
				<p class="description">
					<?php esc_html_e( 'Admin column title ', 'sp-advanced-xprofile' ); ?>
				</p>
			</td>
		</tr>
	</table>
</div>