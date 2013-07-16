<span class="span10">
		<?php echo '<h2>'.$title.'</h2>' ?>  
    <?php if($this->session->flashdata('usuarioOK'))
            echo utf8_decode($this->session->flashdata('usuarioOK'));
            ?>
	<table class="table tablesorter table-hover">
		<thead style="padding: 20px">
			<tr >
				<td>Nome</td>
				<td>Uuário</td>
				<td>E-mail</td>
                                <td>Permissão</td>
				<td>Ações</td>
			</tr>
		</thead>
		<tbody>
                    <?php foreach ($query as $value) { ?>
                        
                    
				<tr>
                                    <td style="font-size: 11px"><?php echo utf8_decode($value->nome)?></td>
                                    <td><?php echo utf8_decode($value->usuario)?></td>
                                    <td><?php echo utf8_decode($value->email)?></td>    
                                    <td><?php echo $value->permissao?></td>
                                    <td><?php echo $this->write_html->acoes_usuario($this->session->userdata('id'),$value->id,$this->session->userdata('permissao'))?></td>
				</tr>
				<?php }?>
		</tbody>
	</table>
    <div class="pagination">
        <?php echo $this->pagination->create_links() ?>
    </div>
        <hr>
	<?php echo $this->write_html->cadastro_usuario($this->session->userdata('permissao')) ?>
</span>