<?php

/**
 * @package GigaCursosPlugin
 */
class Admin
{

  public function __construct() {
    $this->callbacks = new Callbacks();
    $this->settings = new SettingsApi();

    $this->pages = array(
      array(
        'page_title' => 'Giga Cursos',
        'capability' => 'manage_options',
        'menu_slug' => 'cursos-options',
        'callback' => array($this->callbacks, 'gigaPainel'),
        'icon_url' => 'dashicons-admin-generic',
        'position' => 2
      )
    );

    $this->subpages = array(
      array(
        'parent_slug' => 'cursos-options',
        'page_title' => 'Interessados',
        'menu_title' => 'Interessados',
        'capability' => 'manage_options',
        'menu_slug' => 'giga-prematricula',
        'callback' => array($this->callbacks, 'gigaPrematricula')
      )
    );

  }

  public function setSettings() {
    $args = array(
      array(
        'option_group' => 'giga_options_group' ,
        'option_name' => 'home_screen'
      ),
      array(
        'option_group' => 'giga_options_group' ,
        'option_name' => 'home_img'
      ),
      array(
        'option_group' => 'giga_options_group' ,
        'option_name' => 'giga_missao'
      ),
      array(
        'option_group' => 'giga_options_group' ,
        'option_name' => 'giga_visao'
      ),
      array(
        'option_group' => 'giga_options_group' ,
        'option_name' => 'giga_valores'
      )
    );

    $this->settings->setSettings( $args );
  }

  public function setSections() {
    $args = array(
      array(
        'id' => 'giga_admin_index' ,
        'title' => 'Settings',
        'page' => 'cursos-options'
    ));

    $this->settings->setSections( $args );
  }

  public function setFields() {
    $args = array(
      array(
        'id' => 'home_screen' ,
        'title' => 'Mostrar na Home Page',
        'callback' => array($this->callbacks, 'gigaSliderOrFixed'),
        'page' => 'cursos-options',
        'section' => 'giga_admin_index',
        'args' => array(
          'label_for' => 'home_screen'
        )
      ),
      array(
        'id' => 'home_img' ,
        'title' => 'Imagem Para Home Page',
        'callback' => array($this->callbacks, 'gigaTopImage'),
        'page' => 'cursos-options',
        'section' => 'giga_admin_index',
        'args' => array(
          'label_for' => 'home_img'
        )
      ),
      array(
        'id' => 'giga_visao' ,
        'title' => 'Visão',
        'callback' => array($this->callbacks, 'gigaVision'),
        'page' => 'cursos-options',
        'section' => 'giga_admin_index',
        'args' => array(
          'label_for' => 'giga_visao'
        )
      ),
      array(
        'id' => 'giga_missao' ,
        'title' => 'Missão',
        'callback' => array($this->callbacks, 'gigaMission'),
        'page' => 'cursos-options',
        'section' => 'giga_admin_index',
        'args' => array(
          'label_for' => 'giga_missao'
        )
      ),
      array(
        'id' => 'giga_valores' ,
        'title' => 'Valores',
        'callback' => array($this->callbacks, 'gigaValues'),
        'page' => 'cursos-options',
        'section' => 'giga_admin_index',
        'args' => array(
          'label_for' => 'giga_valores'
        )
      ),array(
        'id' => 'email_notificacao' ,
        'title' => 'Email para receber notificações',
        'callback' => array($this->callbacks, 'gigaEmail'),
        'page' => 'cursos-options',
        'section' => 'giga_admin_index',
        'args' => array(
          'label_for' => 'email_notificacao'
        )
      ),array(
        'id' => 'giga_instagram' ,
        'title' => 'Link Instagram',
        'callback' => array($this->callbacks, 'gigaInstagram'),
        'page' => 'cursos-options',
        'section' => 'giga_admin_index',
        'args' => array(
          'label_for' => 'giga_instagram'
        )
      ),array(
        'id' => 'giga_youtube' ,
        'title' => 'Link Youtube',
        'callback' => array($this->callbacks, 'gigaYoutube'),
        'page' => 'cursos-options',
        'section' => 'giga_admin_index',
        'args' => array(
          'label_for' => 'giga_youtube'
        )
      ),array(
        'id' => 'giga_facebook' ,
        'title' => 'Link Facebook',
        'callback' => array($this->callbacks, 'gigaFacebook'),
        'page' => 'cursos-options',
        'section' => 'giga_admin_index',
        'args' => array(
          'label_for' => 'giga_youtube'
        )
      )
    );

    $this->settings->setFields( $args );
  }

  function cria_paginas() {
    global $wpdb;
    $query = get_posts(array(
      'name' => 'cursos',
      'post_type' => 'page',
    ));

    if(!count($query) > 0){
      $paginaCursos = array(
        'post_title' => 'Cursos',
        'post_content' => '',
        'post_status' => 'publish',
        'post_autor' => 1,
        'post_type' => 'page'
      );

      wp_insert_post( $paginaCursos );
    }

    $query = get_posts(array(
      'name' => 'blog',
      'post_type' => 'page',
    ));

    if(!count($query) > 0){
      $paginaBlog = array(
        'post_title' => 'Blog',
        'post_content' => '',
        'post_status' => 'publish',
        'post_autor' => 1,
        'post_type' => 'page'
      );

      wp_insert_post( $paginaBlog );
    }

    $query = get_posts(array(
      'name' => 'certificados',
      'post_type' => 'page',
    ));

    if(!count($query) > 0){
      $paginaBlog = array(
        'post_title' => 'Certificados',
        'post_content' => 'Conheça nossas opções de certificados profissionais'.
                            ' para uma formação completa e pautada nas necessidades'.
                            ' do mercado de trabalho.',
        'post_status' => 'publish',
        'post_autor' => 1,
        'post_type' => 'page'
      );

      wp_insert_post( $paginaBlog );
    }
  }
  public function register() {
    $this->cria_paginas();
    $this->setSettings();
    $this->setSections();
    $this->setFields();
    $this->settings->AddPages($this->pages)->withSubPage('Dashboard')->addSubPages($this->subpages)->register();
  }

}
