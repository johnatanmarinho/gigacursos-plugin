<?php

/**
 * @package GigaCursosPlugin
 *
 */

 global $gigacursos_db_version;
 $gigacursos_db_version = "1.0";
class Activate {

  public static function active(){
    flush_rewrite_rules();
    Activate::gigacursos_install();
  }

  private static function gigacursos_install() {
  	global $wpdb;
  	global $gigacursos_db_version;

  	$table_name = $wpdb->prefix . "prematriculas";

  	$sql = "CREATE TABLE $table_name (
  		id mediumint(9) NOT NULL AUTO_INCREMENT,
  		data_matricula datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  		nome_aluno VARCHAR(255) DEFAULT '' NOT NULL,
  		email_aluno VARCHAR(100) DEFAULT '' NOT NULL,
  		telefone_aluno VARCHAR(25) DEFAULT '' NOT NULL,
  		curso_id mediumint(11),
  		UNIQUE KEY id (id)
  	);";

  	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

  	dbDelta( $sql );

  	add_option( "gigacursos_db_version", $gigacursos_db_version );
  }

}
