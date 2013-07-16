<span class="span10">
		<?php echo '<h2>'.$title.'</h2>'?>
    <?php if($this->session->flashdata('noticiaOK'))
                echo $this->session->flashdata('noticiaOK');
            ?>
	<table class="table tablesorter table-hover">
		<thead style="padding: 20px">
			<tr >
				<td>Titulo</td>
				<td>Autor</td>
				<td>Publica / Privada</td>
                                <td>Publicada ?</td>
				<td>Ações</td>
			</tr>
		</thead>
		<tbody>
                    <?php foreach ($query as $value) {?>
				<tr>
					<td><?php echo $value->titulo?></td>
					<td><?php echo $value->autor?></td>
					<td><?php echo ($value->publica == 't') ? 'SIM' : 'NÃO'; echo ' / ' ;echo ($value->privada == 't') ? 'SIM' : 'NÃO'?></td>
                                        <td><?php echo ($value->publicar == 't') ? 'Sim' : 'Não'?></td> 
					<td>
                                           <?php echo $this->write_html->acoes_noticia($this->session->userdata('permissao'),$value->id,$value->publicar) ?>
					</td>
				</tr>
                                <?php }?>
				
		</tbody>
	</table>
        <div class="pagination">
            <?php echo $this->pagination->create_links() ?>
        </div>
	<hr>
	<?php echo anchor('admin/cadastrar_noticias','<i class="icon-plus"></i>Nova noticias','class="btn btn-small"') ?>
</span>