<?php
/**
 * @package GigaCursosPlugin
 */
class Vaga
{

  public function register() {
    add_action( 'init', array( $this, 'criaVaga' ) );
    add_action( 'admin_init' , array( $this, 'cursos_detalhes' ) );
    add_action( 'save_post' , array( $this, 'salvaVaga' ) );
  }

  //adiciona campos
  function cursos_detalhes() {
    add_meta_box("descricaoVaga", "Detalhes do Curso",
                  array($this , 'descricaoVaga'), "pacotes", "normal", "low");
  }

  function criaVaga() {
    $singular_name = "Vaga";
    $plural_name = "Vagas";
    $labels = array(
  		'name'                            => _x( $plural_name, 'post type general name'),
  		'singular_name'          => _x( $singular_name, 'post type singular name'),
  		'menu_name'              => _x( $singular_name, 'admin menu', 'your-plugin-textdomain'),
  		'name_admin_bar'      => _x( "Nova $singular_name", 'add new on admin bar', 'your-plugin-textdomain'),
  		'add_new'                      => _x( "Nova $singular_name", 'cursos' ),
  		'add_new_item'            => __( "Nova $singular_name", 'book', 'your-plugin-textdomain'),
  		'new_item'                     => __( "Nova $singular_name", 'your-plugin-textdomain' ),
  		'edit_item'                     => __( "Editar $singular_name", 'your-plugin-textdomain'),
  		'view_item'                     => __( "Visualizar $singular_name", 'your-plugin-textdomain'),
  		'all_items'                       => __( "Todas as $plural_name", 'your-plugin-textdomain'  ),
  		'search_items'              => __( "Buscar $plural_name", 'your-plugin-textdomain'),
  		'parent_item_colon'    =>'' ,
  		'not_found'                    => __( "Nenhuma $singular_name registrado.", 'your-plugin-textdomain'),
  		'not_found_in_trash'   => __( "Nenhuma $singular_name na lixeira.", 'your-plugin-textdomain' ),
  	);

  	$args = array(
  		'labels'                                 => $labels,
  		'hierarchical'                      => true,
  		'description'                      => 'Vagas - Gerenciador de vagas',
  		'supports'                           => array(
  						'title',
  						'editor',
  						'thumbnail'
  					 ),
  		'public'                                 => true,
  		'show_ui'                             => true,
  		'show_in_menu'                => true,
  		'show_in_nav_menus'      => true,
  		'publicly_queryable'          => true,
  		'exclude_from_search'   => false,
  		'has_archive'                      => true,
  		'query_var'                          => true,
  		'rewrite'            		 => array( 'slug' => 'cursos' ),
  		'can_export'                      => true,
  		'rewrite'                             => true,
  		'capability_type'               => 'post',
      'menu_position' => 2,
      'menu_icon' => 'dashicons-clipboard',
  	);

    register_post_type('vagas', $args);
  }

  function descricaoVaga() {
    wp_nonce_field( 'global_notice_nonce', 'global_notice_nonce' );

    global $post;

    $descricao_id = 'descricao';
    $requisitos_id = 'requisitos';
    $local_id = 'local';
    $salario_id = 'salario';
    //variaves dos campos personalizados
    $descricao = get_post_meta($post->ID, $descricao_id, true);
    $requisitos = get_post_meta($post->ID, $requisitos_id, true);
    $local = get_post_meta($post->ID, $local_id, true);
    $salario = get_post_meta($post->ID, $salario_id, true);



    $wp_editor_config = array(
      'textarea_rows' => 4,
      'wpautop' => true
    );

    // Add os campos na página de cadastro dos cursos
  	echo '<p><label>Descricão da vaga: </label></p>';
  	wp_editor($descricao, $descricao_id, $wp_editor_config);

  	echo '<p><label>Requisitos: </label> </p>';
  	wp_editor($requisitos, $requisitos_id, $wp_editor_config);

  	echo '<p><label>local: </label> </p>';
    echo '<input type="text" name="'.$local_id.'" id="'. $local_id .'" value="'. $local .'">';

    echo '<p><label>Salario: </label> </p>';
    echo '<input type="text" name="'.$salario_id.'" id="'. $salario_id .'" value="'. $salario .'">';
  }

  function salvaVaga($post_id) {
    if ( ! isset( $_POST['global_notice_nonce'] ) ) {
           return;
    }
    if ( ! wp_verify_nonce( $_POST['global_notice_nonce'], 'global_notice_nonce' ) ) {
            return;
    }

    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

      if ( ! current_user_can( 'edit_page', $post_id ) ) {
         return;
      }

    }
    else {

       if ( ! current_user_can( 'edit_post', $post_id ) ) {
           return;
       }
    }
    global $post;

    update_post_meta($post->ID, 'descricao', $_POST['descricao']);
    update_post_meta($post->ID, 'requisitos', $_POST['requisitos']);
    update_post_meta($post->ID, 'local', $_POST['local']);
    update_post_meta($post->ID, 'salario', $_POST['salario']);
  }
}
