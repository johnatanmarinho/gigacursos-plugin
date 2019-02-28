<?php

/**
 *
 */
class Categoria
{

  public function register() {
    add_action( 'init' , array( $this , 'registra_categorias_cursos' ) );
    add_action( 'categoriacurso_edit_form_fields', array( $this , 'campos_edit_tax' ), 10, 2 );
    add_action( 'categoriacurso_add_form_fields', array( $this , 'add_tax_fields' ), 10, 2 );
    add_action( 'edited_categoriacurso', array( $this , 'save_tax_fields' ), 10, 2 );
    add_action( 'created_categoriacurso', array( $this , 'save_tax_fields' ), 10, 2 );
  }

  // salva o novo campo para a taxonomia
  function save_tax_fields( $term_id ) {
      update_term_meta($term_id, 'img', $_POST['categoria_icon']);
  }

  //adiciona a pagina taxonomia
  function add_tax_fields( $tag ) {
      $nome = 'URL do icone da categoria';
      $descricao = 'Coloque aqui a url da imagem a ser usada para esta categoria';

      echo '<div class="form-field">
                <label for="cat_Image_url">'.  $nome  .'</label>
                <input id="cat_Image_url" type="hidden" value="" class="regular-text process_custom_images"  name="categoria_icon" max="" min="1" step="1">

                <button class="set_custom_images button">Adicionar icone da categoria</button>
                <p class="description">'. $descricao  .'</p>
            </div>';
  }

  function campos_edit_tax($tag) {
      $nome = 'URL do icone da categoria';
      $descricao = 'Coloque aqui a url da imagem a ser usada para esta categoria';
      $t_id = $tag->term_id;
      $value = get_term_meta($t_id, 'img', true);

      echo '<tr class="form-field">
            <th scope="row" valign="top"><label for="cat_Image_url">'.  $nome .'</label></th>
                <td>

                    <input id="cat_Image_url" type="hidden" value="'. $value .'" class="regular-text process_custom_images"  name="categoria_icon" max="" min="1" step="1">
                    <button class="set_custom_images button">Adicionar icone da categoria</button>
                    <p class="description">'.  $descricao  .'</p>
                </td>
            </tr>';

  }

  function registra_categorias_cursos() {
    $labels = array(
  		'name' 			=> _x('Categoria de Cursos', 'taxonomy general name'),
  		'singular_name'	=> _x('Categoria de Cursos', 'taxonomy singular name'),
  		'search_items'		=> _x('Busca Categoria', 'busca de categorias'),
  		'all_items'		=> _x('Todas as Categorias', 'todas as categorias de cursos'),
  		'parent_item'		=> _x('Categoria Pai', 'categoria pai'),
  		'parent-item_colon'	=> _x('Categoria Pai', 'coluna da categoria pai'),
  		'edit_item'		=> _x('Editar Categoria de Curso', 'editar categoria de cursos'),
  		'update_item'		=> _x('Atualizar Categoria de Curso', 'atualizar categoria de cursos'),
  		'add_new_item'	=> _x('Nova Categoria de Curso', 'add nova categoria de cursos'),
  		'new_item_name'	=> _x('Nova Categoria de Curso', 'nova categoria de cursos'),
  		'menu_name'		=> _x('Categorias de Cursos', 'nome do admin'),
  	);

  	$args = array(
  		'hierarchical'		=> true,
  		'labels'			=> $labels,
  		'show_ui'		=> true,
  		'show_admin_column'	=> true,
  		'query_var'		=> true,
  		'rewrite'		=> array(
  						'slug' => 'categoriacurso'
  					),
  	);

  	register_taxonomy('categoriacurso', array('pacotes'), $args);
  }
}
