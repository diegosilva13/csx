<span class="span10">
		<?php echo '<h2>'.$title.'</h2>' ?>  
    <?php if($this->session->flashdata('torneioOK'))
            echo utf8_decode($this->session->flashdata('torneioOK'));
            ?>
	<table class="table tablesorter table-hover">
		<thead style="padding: 20px">
			<tr >
				<td style="width: 20%">Nome</td>
				<td>publicado ?</td>
                                <td>Autor</td>
				<td>Ações</td>
			</tr>
		</thead>
		<tbody>
                    <?php foreach ($query as $value) {?>
                    <tr>
                        <td><?php echo utf8_decode($value->nome)?></td>
                        <td><?php echo ($value->publicar == 't')? 'Sim' : 'Não' ?></td>
                        <td><?php echo utf8_decode($value->autor)?></td>
                        <td><?php echo $this->write_html->acoes_torneio($this->session->userdata('permissao'),$value->publicar,$value->id)?></td>
                    </tr>
				<?php }?>
		</tbody>
	</table>
    <div class="pagination">
        <?php echo $this->pagination->create_links() ?>
    </div>
  
	<hr>
</span>