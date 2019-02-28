<?php

/**
 * @package GigaCursosPlugin
 */
class Deactivate {

  public static function deactive() {
    flush_rewrite_rules();
  }

}
