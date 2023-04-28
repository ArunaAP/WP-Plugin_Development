<?php 
/**
 * @package ArunaPlugin
 */
/*
Plugin Name: Aruna Plugin
Plugin URI: https://arunaap.github.io/plugin
Description: This is my first attempt a custom plugin
Version: 1.0.0
Author: Aruna Priyankara
Author URI: https://arunaap.github.io
License: GPLv2 or later
Text Domain: aruna-plugin
*/


//  if(! define('ABSPATH')){
//      die;
//  }


 defined('ABSPATH') or die('Hey, you cant access this file, you are silly human');

// if (! function_exists('add_action')){
//     echo 'Hey, you cant access this file, you are silly human';
//     exit;
// }

class ArunaPlugin
{

    //public
    //can be access everywhere 

    //protected
    //can be access only within the class itself or extension of that class
    
    //private
    //can be access only within the class itself


    function __construct(){
        add_action('init', array($this,'custom_post_type'));

    }

    function register(){
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

    function activate(){
        //generated a CPT
        $this->custom_post_type();
        //flush rewright rule
        flush_rewrite_rules();
    }
    
    function deactivate(){
        //flush rewright rule
        flush_rewrite_rules();
    }


    function custom_post_type(){
        register_post_type('book', ['public'=>true, 'label'=> 'Books']);
    }

    function enqueue(){
        //inqueue all our plugin
        wp_enqueue_style('mypluginstyle', plugins_url('/assets/mystyle.css', __FILE__));
        wp_enqueue_script('mypluginscript', plugins_url('/assets/myscript.js', __FILE__));
    }

}

if( class_exists( 'ArunaPlugin' ) ){
    $arunaPlugin = new ArunaPlugin( );
    $arunaPlugin->register();
}


//activation
register_activation_hook(__FILE__, array($arunaPlugin, 'activate'));

//deactivetion
register_deactivation_hook(__FILE__, array($arunaPlugin, 'deactivate'));

//uinstall
register_uninstall_hook(__FILE__, array($arunaPlugin, 'uninstall'));