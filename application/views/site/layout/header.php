<!-- Tray -->
	<div id="tray" class="box">

		<p class="f-left box">

			<!-- Switcher -->
			<span class="f-left" id="switcher">
                            <a href="#" rel="1col" class="styleswitch ico-col1" title="Display one column"><img src="<?php echo base_url()?>assets/design/design/switcher-1col.gif" alt="1 Column" /></a>
				<a href="#" rel="2col" class="styleswitch ico-col2" title="Display two columns"><img src="<?php echo base_url()?>assets/design/design/switcher-2col.gif" alt="2 Columns" /></a>
			</span>

			Projeto: <strong>Chess Club Manager</strong>

		</p>
                <p class="f-right">Usuário: <strong>
                        <?php  $link = $this->write_html->links_header($this->session->userdata('logged'),$this->session->userdata('id'),$this->session->userdata('usuario'),$this->session->userdata('permissao')) ?>
                        <?php echo $link['user']?>
                    </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><?php echo $link['logout']?></strong></p>
                
                
	</div> <!--  /tray -->
        <hr class="noscreen" />

	<!-- Menu -->
	<div id="menu" class="box">

		<ul class="box f-right">
                    
			<li><?php echo anchor('auth','<span><strong>Painel Administrativo&raquo;</strong></span>')?></li>
                </ul>

	</div> <!-- /header -->

        	<hr class="noscreen" />

	<!-- Columns -->
	<div id="cols" class="box">