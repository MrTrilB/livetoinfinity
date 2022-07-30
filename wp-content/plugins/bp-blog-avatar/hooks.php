<?php
/**
 * Used by bp_core_handle_avatar_uplod to generate/find the blog-avatars directory
 * 
 * @global type $bp
 * @param type $blog_id
 * @return type
 */
function bd_blog_avatar_upload_dir( $blog_id = 0 ) {
     global $bp;

     if ( !$blog_id )
         $blog_id = get_current_blog_id();

     $path    = bp_core_avatar_upload_path() . '/blog-avatars/' . $blog_id;
     $newbdir = $path;

     if ( !file_exists( $path ) )
         @wp_mkdir_p( $path );

     $newurl    = bp_core_avatar_url() . '/blog-avatars/' . $blog_id;
     $newburl   = $newurl;
     $newsubdir = '/blog-avatars/' . $blog_id;

     return apply_filters( 'blogs_avatar_upload_dir', array( 'path' => $path, 'url' => $newurl, 'subdir' => $newsubdir, 'basedir' => $newbdir, 'baseurl' => $newburl, 'error' => false ) );
}

/**
 * Filters on bp_get_blog_avatar 
 * only provides the avatar if there is one uploaded for the blog
 */
add_filter('bp_get_blog_avatar', 'bd_filter_blog_avatar', 10, 3 );

function bd_filter_blog_avatar( $avatar, $blog_id, $avatar_data ){
    if(! $blog_id )
        $blog_id =  get_current_blog_id ();
    
    $has_avatar = get_blog_option($blog_id, 'has_avatar');
    
    if( !$has_avatar )
        return $avatar ;// if there is no uploaded avatar, do not try to fetch onen, just return the one we got
   
    //if we are here, there is an an avatar associated with this blog
    
    //let us prep data to fetch that
    
    $avatar_data ['item_id'] = $blog_id; //reset object type to blog
    $avatar_data ['object']  = 'blog';//reset object type to blog
    $avatar_data ['avatar_dir']  = 'blog-avatars';//reset object type to blog
    $avatar_data ['alt']  = '';//reset alt
    
    return bp_core_fetch_avatar( $avatar_data );
    
}


//upto 1.8, BuddyPress has a bug and does not pass the blog id for item deletion
//for deleting avatar
add_filter( 'bp_core_avatar_item_id', 'bd_filter_avatar_item_id', 10, 2 );
function bd_filter_avatar_item_id( $item_id, $object ){
    
    if( $object != 'blog' )
        return $item_id;
    
    if(!$item_id)
        $item_id = get_current_blog_id ();
    
    return $item_id;
}