<?php
/*
Plugin Name: RSS Feed Generator
Plugin URI: https://wordpress.org/plugins/health-check/
Description: Checks the health of your WordPress install
Version: 1.0.0
Author: Deep Rahman
Author URI: http://health-check-team.example.com
Text Domain: health-check
Domain Path: 
*/

require_once plugin_dir_path(__FILE__).'admin/class-rss-feed.php';

add_action('widgets_init', 'dp_rf_register');
function dp_rf_register(){
    register_widget('RSS_Feed_Generator');
}