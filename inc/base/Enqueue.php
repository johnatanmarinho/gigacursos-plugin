<?php

/**
 *
 */
class Enqueue
{

  public function register() {
    add_action('admin_enqueue_scripts', array( $this , 'registraScripts'));
  }

  function registraScripts(){
    wp_enqueue_media();
    wp_enqueue_script('jquery');
    wp_enqueue_script('giga-script', PLUGIN_URL . '/templates/js/scripts.js', array( 'jquery' ));
  }
}
