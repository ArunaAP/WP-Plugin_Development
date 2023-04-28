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

if( class_exists( 'ArunaPlugin' ) ){
class ArunaPlugin
{

    //public
    //can be access everywhere 

    //protected
    //can be access only within the class itself or extension of that class
    
    //private
    //can be access only within the class itself


    public $plugin;

    function __construct(){
        $this->plugin = plugin_basename(__FILE__);
    }
    function register(){

        add_action('admin_enqueue_scripts', array($this, 'enqueue'));

        add_action('admin_menu', array($this, 'add_admin_pages'));

        add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
    }

    public function settings_link($links){
        //add custom settings link
        $settings_link = '<a href="options-general.php?page=aruna_plugin">Settings</a>';
        array_push($links, $settings_link);
        return $links;

    }

    public function add_admin_pages(){
        add_menu_page('Aruna Plugin', 'Aruna', 'manage_options', 'aruna-plugin', array($this, 'admin_index'), 'dashicons-store', 110);
    }

    public function admin_index(){
        //require templte
        require_once plugin_dir_path(__FILE__) . 'templates/admin.php';

    }



    function custom_post_type(){
        register_post_type('book', ['public'=>true, 'label'=> 'Books']);
    }

    function enqueue(){
        //inqueue all our plugin
        wp_enqueue_style('mypluginstyle', plugins_url('/assets/mystyle.css', __FILE__));
        wp_enqueue_script('mypluginscript', plugins_url('/assets/myscript.js', __FILE__));
    }
    function activate(){
        require_once plugin_dir_path(__FILE__) . 'inc/aruna-plugin-activate.php';
        ArunaPluginActivate::activate();
    }

}


    $arunaPlugin = new ArunaPlugin( );
    $arunaPlugin->register();
    
    
    //activation
    register_activation_hook(__FILE__, array('ArunaPluginActivate', 'activate'));
    
    //deactivetion
    require_once plugin_dir_path(__FILE__) . 'inc/aruna-plugin-deactivate.php';
    register_deactivation_hook(__FILE__, array('ArunaPluginDeactivate', 'deactivate'));
    
    //uinstall
    register_uninstall_hook(__FILE__, array($arunaPlugin, 'uninstall'));
}