<?php 
/**
 * @package ArunaPlugin
 */


class ArunaPluginDeactivate
{
    public static function deactivate(){
        flush_rewrite_rules();
    }
}