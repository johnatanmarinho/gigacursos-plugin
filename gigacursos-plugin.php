<?php

/**
 * Plugin Name: Giga Cursos
 * Plugin URI: http://johnatanmarinho.org
 * Description: Gerenciador cursos
 * Version: 1.0
 * Author: Johnatan Marinho <johnatan.marinho@gmail.org>
 * Author URI: https://github.com.br/johnatanmarinho
 * License: GPLv2 or later
 *
 * Copyright 2014 Johnatan Marinho  (email : johnatan.marinho@gmail.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

 function autoloadAPI($className) {
     $filename = plugin_dir_path( __FILE__) . "inc/Api/" . $className . ".php";
     if (is_readable($filename)) {
         require $filename;
     }
 }

 spl_autoload_register("autoloadAPI");

function autoloadBase($className) {
   $filename = plugin_dir_path( __FILE__) . "inc/base/" . $className . ".php";
   if (is_readable($filename)) {
       require $filename;
   }
}
spl_autoload_register("autoloadBase");

function autoloadPage($className) {
    $filename = plugin_dir_path( __FILE__) . "inc/pages/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}

spl_autoload_register("autoloadPage");

defined( 'ABSPATH' ) or die('Hey, go away!');

require_once( plugin_dir_path( __FILE__ ) . '/inc/init.php');

define( 'PLUGIN_PATH',  plugin_dir_path( __FILE__ ) );
define( 'PLUGIN_NAME', plugin_basename( __FILE__ ) );
define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );
function activate() {
  Activate::active();
}

function deactivate() {
  Deactivate::deactive();
}
register_activation_hook( __FILE__ , 'activate' );
register_deactivation_hook( __FILE__ , 'deactivate' );

if( class_exists('Init') ){
  Init::register_services();
}
