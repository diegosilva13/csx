<span class="span10">
	 
<?php foreach ($query as $value){};?>
    <form class="form-horizontal">
    <fieldset>
        <legend>PERFIL DO USUARIO</legend>
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span10">
                            <div class="control-group">
                                <label class="control-label" for="inputNome">Nome completo</label>
                                 <div class="controls">
                                    <input type="text" name="nome" value="<?php echo $value->nome?>" id="inputNome" placeholder="Nome completo" class="input-xxlarge" disabled="disabled">
                                 </div>
                            </div>
                             <div class="control-group">
                                <label class="control-label" for="inputEmail">E-mail</label>
                                 <div class="controls">
                                    <input type="text" value="<?php echo $value->email?>" id="inputEmail" placeholder="E-mail" class="input-xlarge" disabled="disabled">
                                 </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputTelefone">Telefone</label>
                                 <div class="controls">
                                    <input type="text"  value="<?php echo $value->telefone ?>" id="inputTelefone" placeholder="Telefone" class="input-medium" disabled="disabled">
                                 </div>
                            </div>
                             <div class="control-group">
                                <label class="control-label" for="inputIdade">Idade</label>
                                 <div class="controls controls-row">
                                 <input type="text"  value="<?php echo $value->idade?>" id="inputIdade" placeholder="Idade" class="input-mini" disabled="disabled">
                                 </div>
                            </div>
                        <div class="control-group">
                                <label class="control-label" for="inputSobrenome">Sobre: </label>
                                 <div class="controls">
                                     <div><?php echo utf8_decode($value->sobre)?></div>
                                 </div>
                            </div> 
                            <hr/>
                            <?php echo anchor('usuario/listar_usuario','<i class="icon-arrow-left"></i> Voltar','class="btn btn-small"')?>
                    </div>
                    <!--Insira uma div aqui!-->
                </div>
            </div>
            <?php echo validation_errors('<p class="msg warning">','</p>') ?>
    </fieldset>
  </form>
</span>