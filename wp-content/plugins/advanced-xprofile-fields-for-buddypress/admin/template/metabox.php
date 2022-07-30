<style type="text/css">
.sp_xprofile_item {
    margin-top: 10px;
    background-color: #fafafa;
    border: 1px solid #e5e5e5;
    padding: 10px;
}
.sp_xprofile_item label {
    font-weight: bold;
}
.sp-advance-xprofile label{
    font-weight: bold;
}
.sp-advance-xprofile table {
    width: 100%;
}
.sp-advance-xprofile td{
    border-bottom: 0px solid #e5e5e5;
    padding-top: 10px;
}
a.nav-tab {
    margin-bottom: -4px;
}
#sp-advance-xprofile li {
    display: inline-block;
    margin-bottom: 2px;
}
</style>
<div class="postbox sp-advance-xprofile" id="sp-advance-xprofile">
    <ul class="nav-tab-wrapper">
        <li><a class="nav-tab" href="#axf-labels"><?php esc_html_e( 'Labels', 'advanced-xprofile-fields-for-buddypress' ); ?></a></li>
        <li><a class="nav-tab" href="#axf-validation"><?php esc_html_e( 'Validation', 'advanced-xprofile-fields-for-buddypress' ); ?></a></li>
        <?php do_action( 'axf_add_meta_tab', $field ); ?>
        <li><a class="nav-tab" href="#axf-advanced"><?php esc_html_e( 'Advanced Options', 'advanced-xprofile-fields-for-buddypress' ); ?></a></li>
    </ul>
    <?php include_once( 'tab-labels.php' ); ?>
    <?php include_once( 'tab-validation.php' ); ?>
    <?php do_action( 'axf_add_meta_tab_content', $field ); ?>
    <?php include_once( 'tab-advanced.php' ); ?>
</div>
<script type="text/javascript">
jQuery(document).ready( function($) {
    $( '#sp-advance-xprofile' ).tabs();
});
</script>