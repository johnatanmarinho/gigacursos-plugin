
<div class="wrap">
  <h1>Giga Cursos</h1>
  <?php settings_errors(); ?>

  <form action="options.php" method="post">
    <?php
      settings_fields('giga_options_group');
      do_settings_sections( 'cursos-options' );
      submit_button();
     ?>
  </form>

</div>
