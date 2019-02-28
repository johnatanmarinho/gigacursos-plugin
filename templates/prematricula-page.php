<div class="wrap">
  <h2>Interessados</h2>
  <table class="wp-list-table widefat fixed pages">
    <thead>
      <tr>
        <th id="title"  style="" scope="col" align="center">
          Aluno
        </th>
        <th id="taxonomy"  style="" scope="col" align="center">
          E-mail
        </th>
        <th id="date"  style="" scope="col" align="center">
          Telefone
        </th>
        <th align="center">
          Pacote Solicitado
        </th>
        <th>
          Data da Pré-matricula
        </th>
       </tr>
      </thead>

      <tfoot></tfoot>

      <tbody id="the-list">

        <?php
        if(is_array($listaAluno) || is_object($listaAluno)):
          foreach ($listaAluno as $aluno):
        ?>
        <tr>
          <td align="center">
            <?php echo $aluno->nome_aluno;?>
          </td>
          <td align="center">
            <?php echo $aluno->email_aluno;?>
          </td align="center">
          <td>
            <?php echo $aluno->telefone_aluno;?>
          </td>
          <td align="center">
            <?php
              $curso 	= get_post($aluno->curso_id);

              if(isset($curso)){
                //print_r($infoTurma);
                echo 	'<b>' . $curso->post_title . '</b><br>';
              }else{
                echo '<b> não especificou pacote </b><br>';
              }
            ?>
          </td>
          <td>
            <?php echo $aluno->data_matricula;?>
          </td>
        </tr>
        <?php
          endforeach;
        endif;
        ?>
      </tbody>

  </table>
</div>
