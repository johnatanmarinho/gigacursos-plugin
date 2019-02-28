<?php

/**
 * @package GigaCursosPlugin
 */
class prematricula
{
  public function register() {
    add_shortcode( 'form-aula-experimental' , array( $this , 'prematricula_shortcode' ) );
    add_action( 'wp_ajax_nopriv_add_prematricula' , array( $this , 'add_prematricula' ) );
    add_action( 'wp_ajax_add_prematricula' , array( $this , 'add_prematricula' ) );
    add_filter( 'wp_mail_content_type' , array( $this , 'set_content_type' ) );
  }

  
  function prematricula_shortcode($args){

    global $post;

    $curso_id = $post->ID;


    $output = '<form class="form-contato" action="" method="post">' .
      '<h2>Construa sua carreira</h2>' .
      '<p>As opções de cursos e certificados mais valorizados pelo mercado.</p>'.
      '<input type="hidden" name="action" value="add_prematricula" />'.
      '<input type="hidden" name="curso_id" value="'.$curso_id.'" />'.
      '<label for="name">Nome</label>'.
      '<input type="text" name="nome_aluno" id="name" value="" placeholder="Nome">'.
      '<label for="telefone">Telefone</label>'.
      '<input type="tel" name="fone_aluno" id="telefone" value="" placeholder="Seu Telefone">'.
      '<label for="email">Email</label>'.
      '<input type="email" name="email_aluno" id="email" value="" placeholder="Seu email">'.
      '<p class="message"></p>'.
      '<button type="submit" class="btn" >Fale com nossa equipe</button>'.
    '</form>';

    return $output;
  }

  function add_prematricula(){


    global $wpdb;

    $action = $_POST['action'];

    // $curso_id = $_GET['curso_id'];

    $nomeTabela = $wpdb->prefix . 'prematriculas';

    $nomealuno 	= $_POST['nome_aluno'];
    $emailaluno 	= $_POST['email_aluno'];
    $fonealuno  	= $_POST['fone_aluno'] ;
    $dataMatricula = date('Y-m-d h:i:s');
    $curso_id	= $_POST['curso_id'];

    $nomeSite = bloginfo('admin_email');

    // pegando dados da curso

    $curso = get_post($curso_id);


    /**
     * E-mail de notificação
     */
    $para 		= get_option('email_notificacao');
    $assunto 	= "Nova pré-matricula ";
    $body		= 'Nova Pré-matricula para a curso  ' . $curso->post_title . ' com ínicio em ' . $custom['dataInicio'][0]. ', ' . $hora . ' de ' . $dia . ' .<br />';
    $body		.= '<strong>Nome: </strong>' . $nomealuno . '.<br>';
    $body		.= '<strong>E-mail: </strong>' . $emailaluno . '.<br>';
    $body		.= '<strong>Telefone: </strong>' . $fonealuno . '.<br>';

    $body		= '<table width="100%" style="border: 1px solid #ccc;">';
    $message = '';
    if(isset($curso)){
      $message .='Nova Pré-Matricula para ' . $curso->post_title;
    }else {
      $message = 'Novo Interessado';
    }
    $body		.='<tr><td style="background: #f0f0f0; color:#000; text-align: center;"><h3>' . $message . '</h3></td></tr>';
    $body		.='<tr><td style="background: #f5f5f5;">';
    $body		.='<tr><td><table style="margin-top: 20px;"><tr>';
    $body		.='<td width="30%"><b>Nome: </b></td>';
    $body		.='<td width="70%">' . $nomealuno . '</td></tr>';
    $body		.='<tr><td width="30%"><b>E-mail:</b> </td>';
    $body		.='<td  width="70%">' . $emailaluno . '</td></tr>';
    $body		.='<tr><td width="30%"><b>Telefone: </b></td>';
    $body		.='<td  width="70%">' . $fonealuno . '</td></tr>';
    $body		.='</table></td></tr><tr><td style="background: #f0f0f0; text-align: center; padding: 5px 0;">Enviado por <a href="cursosgiga.com.br" target="_blank">gigacursos</a></td></tr></table>';

    switch ($action)
    {
    	case "add_prematricula":

    	$wpdb->insert($nomeTabela, array(
    		'id' => null
    		, 'nome_aluno' => $nomealuno
    		, 'email_aluno' => $emailaluno
    		, 'telefone_aluno' => $fonealuno
    		, 'curso_id' => $curso_id
    		, 'data_matricula' => $dataMatricula
    		)
    	);

    	wp_mail($para, $assunto, $body);
      wp_send_json_success( ['data' => 'Tudo Certo!'], 200 );
    	break;
    }

  }
  function set_content_type( $content_type ) {
      return 'text/html';
  }
}
