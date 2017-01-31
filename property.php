<?php
/** 
 * Plugin Name: Property Check
 * Plugin URI: http://www.tunapanda.org
 * Description: This plugin allows you to add property listings
 * Author: Fredrick Odhiambo
 * Author URI: http://www.tunapanda.org
 * Version: 0.0.1
 * License: GPLv2
*/

//Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

require_once ( plugin_dir_path(__FILE__). 'wp-property-cpt.php');
require_once ( plugin_dir_path(__FILE__). 'wp-property-render.php');
require_once ( plugin_dir_path(__FILE__). 'wp-property-fields.php');


