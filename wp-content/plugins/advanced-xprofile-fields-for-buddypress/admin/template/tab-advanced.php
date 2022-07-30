<div id="axf-advanced" class="inside">
    <table>
    <tr>
    <td><input type="checkbox" name="advanced_xprofile_options[hide_registration]" value="1" <?php checked($options['hide_registration'], 1, true); ?> />
    <label>
    <?php esc_html_e('Hide on registration', 'sp-advanced-xprofile'); ?>
    </label>
    <p>
    <?php esc_html_e('Hide field on registration page', 'sp-advanced-xprofile'); ?>
    </p></td>
    </tr>
    <tr>
    <td><input type="checkbox" name="advanced_xprofile_options[non_editable]" value="1" <?php checked($options['non_editable'], 1, true); ?> />
    <label>
    <?php esc_html_e('Non editable', 'sp-advanced-xprofile'); ?>
    </label>
    <p>
    <?php esc_html_e('Stop profile field from being updated', 'sp-advanced-xprofile'); ?>
    </p></td>
    </tr>
    <tr>
    <td><input type="checkbox" name="advanced_xprofile_options[admin_column]" value="1" <?php checked($options['admin_column'], 1, true); ?> />
    <label>
    <?php esc_html_e('Show in Admin Column', 'sp-advanced-xprofile'); ?>
    </label>
    <p>
    <?php esc_html_e('Display a column on admin user listing page', 'sp-advanced-xprofile'); ?>
    </p></td>
    </tr>
    </table>
</div>