<?php
/**
 * @package GigaCursosPlugin
 */
class Pacote
{

  public function register() {
    add_action( 'init', array( $this, 'criaPacote' ) );
    add_action( 'admin_init' , array( $this, 'cursos_detalhes' ) );
    add_action( 'save_post' , array( $this, 'salva_descricao_cursos' ) );
  }

  //adiciona campos
  function cursos_detalhes() {
    add_meta_box("descricao_meta_cursos", "Detalhes do Curso",
                  array($this , 'descricao_meta_cursos'), "pacotes", "normal", "low");
  }

  function criaPacote() {
    $singular_name = "Pacote";
    $plural_name = "Pacotes";
    $labels = array(
  		'name'                            => _x( $plural_name, 'post type general name'),
  		'singular_name'          => _x( $singular_name, 'post type singular name'),
  		'menu_name'              => _x( $singular_name, 'admin menu', 'your-plugin-textdomain'),
  		'name_admin_bar'      => _x( "Novo $singular_name", 'add new on admin bar', 'your-plugin-textdomain'),
  		'add_new'                      => _x( "Novo $singular_name", 'cursos' ),
  		'add_new_item'            => __( "Novo $singular_name", 'book', 'your-plugin-textdomain'),
  		'new_item'                     => __( "Novo $singular_name", 'your-plugin-textdomain' ),
  		'edit_item'                     => __( "Editar $singular_name", 'your-plugin-textdomain'),
  		'view_item'                     => __( "Visualizar $singular_name", 'your-plugin-textdomain'),
  		'all_items'                       => __( "Todos os $plural_name", 'your-plugin-textdomain'  ),
  		'search_items'              => __( "Buscar $plural_name", 'your-plugin-textdomain'),
  		'parent_item_colon'    =>'' ,
  		'not_found'                    => __( "Nenhum $singular_name registrado.", 'your-plugin-textdomain'),
  		'not_found_in_trash'   => __( "Nenhum $singular_name na lixeira.", 'your-plugin-textdomain' ),
  	);

  	$args = array(
  		'labels'                                 => $labels,
  		'hierarchical'                      => true,
  		'description'                      => 'Cursos - Gerenciador de cursos',
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
      'menu_icon' => 'dashicons-book-alt',
  	);

    register_post_type('pacotes', $args);
  }

  function descricao_meta_cursos() {
    wp_nonce_field( 'global_notice_nonce', 'global_notice_nonce' );

    global $post;

    //variaves dos campos personalizados
    $duracao = get_post_meta($post->ID, 'duracao', true);
    $requisitos = get_post_meta($post->ID, 'requisitos', true);
    $aposcurso = get_post_meta($post->ID, 'aposcurso', true);
    $image_destaque = get_post_meta($post->ID, 'image_destaque', true);
    $frase_destaque = get_post_meta($post->ID, 'frase_destaque', true);
    $conteudo_requisitos = $requisitos;
    $conteudo_aposcurso = $aposcurso;

    $requisitos_id = 'requisitos';
    $aposcurso_id = 'aposcurso';

    $wp_editor_config = array(
      'textarea_rows' => 4,
      'wpautop' => true
    );

    // Add os campos na página de cadastro dos cursos
  	echo '<p><label>Duração do Curso: </label></p>';
  	echo '<input type="text" name="duracao" id="duracao" class="form-required" size="20" value="' . $duracao . '"/> <br>' ;
  	echo '<p><label>Requisitos: </label> </p>';
  	wp_editor($conteudo_requisitos, $requisitos_id, $wp_editor_config);
  	// echo '<textarea name="wpCursos_requisitos" rows="5" cols="60">' . $wpCursos_requisitos . '</textarea> <br>';

  	echo '<p><label>Após este curso o aluno será capaz de: </label> </p>';
  	wp_editor($conteudo_aposcurso, $aposcurso_id, $wp_editor_config);
  	//echo '<textarea name="wpCursos_aposcurso" rows="5" cols="60">' . $wpCursos_aposcurso . '</textarea> <br>';
    ?>
    <label for="frase_destaque">Frase de Destaque</label>
    <input type="text" name="frase_destaque" id="frase_destaque" value="<?= $frase_destaque?>">

    <label for="image_destaque">Imagem de Destaque</label>
    <img src="<?= wp_get_attachment_image_src($image_destaque)[0] ?>" alt="">
    <input type="hidden" value="<?= $image_destaque; ?>" class="regular-text process_custom_images" id="image_destaque" name="image_destaque" max="" min="1" step="1">
    <button class="set_custom_images button">Adicionar icone da categoria</button>
    <?php
  }

  function salva_descricao_cursos($post_id) {
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

    update_post_meta($post->ID, 'duracao', $_POST['duracao']);
    update_post_meta($post->ID, 'requisitos', $_POST['requisitos']);
    update_post_meta($post->ID, 'aposcurso', $_POST['aposcurso']);
    update_post_meta($post->ID, 'image_destaque', $_POST['image_destaque']);
    update_post_meta($post->ID, 'frase_destaque', $_POST['frase_destaque']);
  }
}
