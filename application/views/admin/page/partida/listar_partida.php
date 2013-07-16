<span class="span10">
		<?php echo '<h2>'.$title.'</h2>'?>
     <?php 
            if($this->session->flashdata('partidaOK'))
                  echo '<p class="msg done">'.$this->session->flashdata('partidaOK').'</p>'; 
                ?>
    <div style="float: right">
         <?php echo anchor('partida/baixar_lista','Baixar todas partidas','class="btn btn-small"') ?>
    </div>
	<table class="table tablesorter table-hover">
		<thead style="padding: 20px">
			<tr>
                            <td>ID</td>
				<td style="width: 20%">Evento</td>
				<td>Resultado</td>
				<td>Brancas/Pretas</td>
				<td>PlyCount</td>
                                <td>Ações</td>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($query as $value) {?>
                    <tr>
                        <td><?php echo utf8_decode($value->id)?></td>
                        <td><?php echo utf8_decode($value->event)?></td>
                        <td><?php echo utf8_decode($value->result)?></td>
                        <td><?php echo utf8_decode($value->white.' / '. $value->black) ?></td>
                        <td><?php echo utf8_decode($value->plycount)?></td>
                        <td> <?php echo $this->write_html->acoes_partida($this->session->userdata('id'),$value->id,$this->session->userdata('permissao'))?></td>
                    </tr>
                    <?php }?>
		</tbody>
	</table>
    <div style="float: right;margin-right: 10px">
        <?php
            echo form_open('partida/listar_partida');
            echo form_input(array('name'=>'busca','style'=>'margin-top: 10px','placeholder'=>'Digite algo para buscar...'));
            echo form_submit(array('class'=>'btn'),'Buscar');
        ?>
   </div>
    <div class="pagination pagination-small">
        <?php echo $this->pagination->create_links()?>
    </div>
	<hr>
	<?php //echo anchor('partida/cadastrar_partida','<i class="icon-plus"></i> Nova partida','class="btn btn-small"') ?>
        <?php //echo anchor('partida/cadastrar_pgn','<i class="icon-plus"></i> Novo arquivo pgn','class="btn btn-small"') ?>

</span>