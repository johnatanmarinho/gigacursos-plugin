<?php

/**
 *
 */
class Callbacks
{

  public function gigaPainel(){
    return require_once( PLUGIN_PATH . 'templates/admin-page.php' );
  }

  public function gigaPrematricula(){

    global $wpdb;

    $tabela = $wpdb->prefix . 'prematriculas';

    $listaAluno = $wpdb->get_results( " SELECT * FROM $tabela" );

    return require_once( PLUGIN_PATH . 'templates/prematricula-page.php');

  }

  public function gigaOptionGroup( $input ) {
    return $input;
  }

  public function gigaAdminSection() {
    echo 'hi there!';
  }

  public function gigaSliderOrFixed() {
    $value = esc_attr(get_option( 'home_screen') );
    $selected = 'selected="selected"';
    ?>
    <select name="home_screen" id="home_screen" value='. $value .'>
      <option value="0" <?php if($value == 0 ) {echo $selected;} ?> >
        Slider
      </option>
      <option value="1" <?php if($value == 1 ) {echo $selected;} ?> >
        Imagem
      </option>
    </select>
    <?php
  }

  public function gigaTopImage() {
    $isFixed = esc_attr( get_option( 'home_screen' ) );
    $value = esc_attr( get_option('home_img') );
    if( $isFixed == 1 ) {

      echo '<input type="hidden" value="' . $value . '" class="regular-text process_custom_images"  name="home_img" max="" min="1" step="1">
            <button class="set_custom_images button">Escolher Imagem</button>';
    }
  }

  public function gigaMission(){
    $value = esc_attr( get_option('giga_missao') );
    echo '<textarea name="giga_missao" rows="8" cols="40">' . $value .'</textarea>';
  }

  public function gigaVision(){
    $value = esc_attr( get_option('giga_visao') );
    echo '<textarea name="giga_visao" rows="8" cols="40">' . $value .'</textarea>';
  }

  public function gigaValues(){
    $value = esc_attr( get_option('giga_valores') );
    echo '<textarea name="giga_valores" rows="8" cols="40">' . $value .'</textarea>';
  }

  public function gigaEmail() {
    $value = esc_attr( get_option('email_notificacao') );
    echo '<input type="email" name="email_notificacao" value="' . $value . '" />';
  }

  public function gigaFacebook() {
    $value = esc_attr( get_option('giga_facebook') );
    echo '<input type="text" name="giga_facebook" value="' . $value . '" />';
  }
  public function gigaInstagram() {
    $value = esc_attr( get_option('giga_instagram') );
    echo '<input type="text" name="giga_instagram" value="' . $value . '" />';
  }
  public function gigaYoutube() {
    $value = esc_attr( get_option('giga_youtube') );
    echo '<input type="text" name="giga_youtube" value="' . $value . '" />';
  }


  
}
