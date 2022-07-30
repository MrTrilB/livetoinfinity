<div id="axf-validation" class="inside">
    <div class="sp-validation-type sp_xprofile_item">
        <label>
    <input type="checkbox" name="advanced_xprofile_validation[enable][char_limit]" value="1" <?php checked($v['enable']['char_limit'], 1, true); ?> />
    <?php _e('Character Limit', 'sp-advanced-xprofile'); ?>
        </label>
        <input type="number" name="advanced_xprofile_validation[char_limit]" placeholder="" value="<?php echo $v['char_limit']; ?>" />
        <p class="description">
    <?php _e('Set the maximum amount of characters for this field.', 'sp-advanced-xprofile'); ?>
        </p>
    </div>
    <div class="sp-validation-type sp_xprofile_item">
        <label>
    <input type="checkbox" name="advanced_xprofile_validation[enable][min_chars]" value="1" <?php checked($v['enable']['min_chars'], 1, true); ?> />
    <?php _e('Minimum Characters', 'sp-advanced-xprofile'); ?>
        </label>
        <input type="number" name="advanced_xprofile_validation[min_chars]" value="<?php echo $v['min_chars']; ?>" />
        <p class="description">
    <?php _e('Set the minimum amount of characters for this field.', 'sp-advanced-xprofile'); ?>
        </p>
    </div>
    <div class="sp-validation-type sp_xprofile_item">
        <label style="display:inline-block">
    <input type="checkbox" name="advanced_xprofile_validation[enable][text_format]" value="1" <?php checked($v['enable']['text_format'], 1, true); ?> />
    <?php _e('Text Format', 'sp-advanced-xprofile'); ?>
        </label>
        <select name="advanced_xprofile_validation[text_format]">
        <option value="0"><?php _e('-Select Format-', 'sp-advanced-xprofile'); ?></option>
        <option value="alphanumeric" <?php echo ($v['text_format']=='alphanumeric' ? 'selected="selected"' : ''); ?>>
        <?php _e('Alphanumeric', 'sp-advanced-xprofile'); ?>
        </option>
        <option value="alpha" <?php echo ($v['text_format']=='alpha' ? 'selected="selected"' : ''); ?>>
        <?php _e('Alpha', 'sp-advanced-xprofile'); ?>
        </option>
        <option value="email" <?php echo ($v['text_format']=='email' ? 'selected="selected"' : ''); ?>>
        <?php _e('Email', 'sp-advanced-xprofile'); ?>
        </option>
        <option value="url" <?php echo ($v['text_format']=='url' ? 'selected="selected"' : ''); ?>>
        <?php _e('URL', 'sp-advanced-xprofile'); ?>
        </option>
    </select>
        <p class="description">
    <?php _e('Choose the text format for an input field.', 'sp-advanced-xprofile'); ?>
        </p>
    </div>
</div>