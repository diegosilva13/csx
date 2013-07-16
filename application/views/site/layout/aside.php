<!-- Aside (Left Column) -->
		<div id="aside" class="box">

			<div class="padding box">

				<!-- Logo (Max. width = 200px) -->
				<p id="logo"><a href="#"><img src="<?php echo base_url()?>assets/design/tmp/logo.gif" alt="Our logo" title="Visitar Site" /></a></p>

			</div> <!-- /padding -->
			<ul class="box">
				<li id="submenu-active"><a href="#">Noticias do clube</a> <!-- Active -->
                                    <ul>
                                        <li><?php echo anchor('site/noticias_publicas','Noticias do Club') ?></li>
                                    </ul>
				</li>
                                <li id="submenu-active"><a href="#">Torneios</a> <!-- Active -->
                                    <ul>
                                        <li><?php echo anchor('site/torneios_publicados','<i class="icon-eye-open"></i> Torneios publicados') ?></li>
                                    </ul>
				</li>
                                <?php if(!$this->session->userdata('logged')) {?>
                                <li id="submenu-active"><a href="#">Não possuo Cadastro</a> <!-- Active -->
                                    <ul>
                                        <li><?php echo anchor('site/cadastro','<i class="icon-pencil"></i> Cadastrar') ?></li>
                                    </ul>
				</li>
                                <?php } ?>
			</ul>

		</div> <!-- /aside -->

		<hr class="noscreen" />
