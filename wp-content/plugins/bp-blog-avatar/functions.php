<?php

/**
 * Get blog avatar
 * To get blog avatar outside the blogs loop
 * 
 * @param type $args
 */
function bd_blog_avatar( $args = '' ) {
	echo bd_get_blog_avatar( $args );
}
	function bd_get_blog_avatar( $args = '' ) {
		global $blogs_template;
               
                
		$defaults = array(
			'type'    => 'full',
			'width'   => false,
			'height'  => false,
			'class'   => 'avatar',
			'id'      => false,
			'alt'     => '',
                        'blog_id' => get_current_blog_id(),  
			'no_grav' => true
		);

               
		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );

		  
                $blog = bd_get_blog_details( $blog_id );
                
		$avatar = apply_filters( 'bp_get_blog_avatar_' .$blog_id, bp_core_fetch_avatar( array( 'item_id' => $blog->admin_user_id, 'type' => $type, 'alt' => $alt, 'width' => $width, 'height' => $height, 'class' => $class, 'email' => $blog->admin_user_email ) ) );

		return apply_filters( 'bp_get_blog_avatar', $avatar, $blog->blog_id, array( 'item_id' => $blog->admin_user_id, 'type' => $type, 'alt' => $alt, 'width' => $width, 'height' => $height, 'class' => $class, 'email' => $blog->admin_user_email ) );
	}
        
        
        function bd_get_blog_details( $blog_id ){
            
            global $wpdb, $bp;
            
            $blog = $wpdb->get_row( $wpdb->prepare( "SELECT b.blog_id, b.user_id as admin_user_id, u.user_email as admin_user_email FROM {$bp->blogs->table_name} b, {$wpdb->users} u WHERE b.user_id = u.ID and b.blog_id = %d", $blog_id ) );
			
            return $blog;
            
        }