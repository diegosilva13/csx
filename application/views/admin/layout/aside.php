<!-- Aside (Left Column) -->
		<div id="aside" class="box">

			<div class="padding box">

				<!-- Logo (Max. width = 200px) -->
				<p id="logo"><a href="#"><img src="<?php echo base_url()?>assets/design/tmp/logo.gif" alt="Our logo" title="Visitar Site" /></a></p>

			</div> <!-- /padding -->
			<ul class="box">
				<li id="submenu-active"><a href="#">Jogador</a>
                                       <?php $menu = $this->write_html->acoes_aside($this->session->userdata('permissao'))?>
                                    <ul>
                                        <?php echo $menu['jogador']?>
                                    </ul>
                                </li>
				<li id="submenu-active"><a href="#">Torneios</a>
                                     <ul>
                                       <?php echo $menu['torneio']?>
                                    </ul>
                                </li>
				<li id="submenu-active"><a href="#">Partidas</a>
                                     <ul>
                                        <?php echo $menu['partida']?>
                                    </ul>
                                </li>
                                <?php if($this->session->userdata('permissao') == 'admin' || $this->session->userdata('permissao')=='super') {?>
				<li id="submenu-active"><a href="#">Noticias</a> <!-- Active -->
                                    <ul>
                                        <?php echo $menu['noticias']?>
                                    </ul>
				</li>
                                <?php }?>
			</ul>

		</div> <!-- /aside -->

		<hr class="noscreen" />
