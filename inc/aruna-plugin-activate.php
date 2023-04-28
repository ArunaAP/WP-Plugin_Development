<?php 
/**
 * @package ArunaPlugin
 */


class ArunaPluginActivate
{
    public static function activate(){
        flush_rewrite_rules();
    }
}