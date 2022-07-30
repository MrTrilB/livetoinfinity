<?php

/*
 * Plugin Name: Blog Avatar
 * Plugin URI: http://buddydev.com/plugins/blog-avatar/
 * Version: 1.0
 * Author: Anu Sharma
 * Author URI: http://buddydev.com/members/anusharma/
 * Description: Allow Site Admins to upload avatar for a blog 
 */


class BD_Blog_Avatar{
    
    private static $instance;
    
    
    private function __construct() {
  
        add_action( 'bp_loaded', array( $this, 'load' ) );
        
    }
    
    function load(){
        
        $path = plugin_dir_path( __FILE__ );
        
        $files = array(
                'hooks.php',
                'functions.php',
               // 'actions.php'
                
        );
        
        if( is_admin() )
            $files[] = 'admin/admin.php';
        
        foreach ( $files as $file )
            require_once $path . $file;
        
        
        
    }
    
     /**
     * Get Instance
     * 
     * Use singlten patteren
     * @return BD_Blog_Avatar
     */
    public static function get_instance() {

        if ( !isset( self::$instance ) )
            self::$instance = new self();

        return self::$instance;
    }
    
  
   
 }

BD_Blog_Avatar::get_instance();// Have a fun .....

