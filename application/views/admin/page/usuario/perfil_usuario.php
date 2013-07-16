<span class="span10">
	 
    <?php foreach ($query as $value){}; echo form_open('usuario/editar_perfil?edit='.$value->id,array('accept-charset'=>'utf-8','class'=>'form-horizontal','id'=>'cad_jogador')) ?>
    <fieldset>
        <legend>Editar perfil</legend>
        <?php if($this->session->flashdata('perfilOK'))
            echo utf8_decode($this->session->flashdata('perfilOK'));
            ?>
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span10">
                            <div class="control-group">
                                <label class="control-label" for="inputNome">Nome completo</label>
                                 <div class="controls">
                                    <input type="text" name="nome" id="inputNome" class="input-xxlarge" placeholder="Nome Completo" value="<?php echo $value->nome ?>" >
                                 </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputEndereco" >Endereço Completo</label>
                                 <div class="controls">
                                    <input type="text" name="endereco" id="inputEndereco" placeholder="Rua, Bairro, numero, Cidade/estado" value="<?php echo $value->endereco ?>" class="input-xxlarge">
                                 </div>
                            </div>
                             <div class="control-group">
                                 <label class="control-label" for="inputEmail" >E-mail</label>
                                 <div class="controls">
                                    <input type="text" name="email" id="inputEmail" placeholder="E-mail" value="<?php echo $value->email ?>" class="input-xlarge">
                                 </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputTelefone">Telefone</label>
                                 <div class="controls">
                                    <input type="text" name="telefone" id="inputTelefone" placeholder="Telefone" value="<?php echo $value->telefone ?>" class="input-medium">
                                 </div>
                            </div>
                             <div class="control-group">
                                <label class="control-label" for="inputIdade">Idade</label>
                                 <div class="controls controls-row">
                                     <input type="text" id="inputIdade" name="idade" placeholder="Idade" value="<?php echo $value->idade ?>" class="input-mini">
                                    <span class="sexo" style="margin-left: 100px;">Sexo</span>
                                        <select class="select" style="width: 200px;height: 30px" name="sexo">
                                            <?php if($value->sexo == '') {?>
                                            <option <?php echo 'selected'?> >Escolha uma opção</option>
                                                <option value="F">Feminino</option>
                                                <option value="M">Masculino</option>
                                            <?php } ?>
                                            <?php if($value->sexo == 'M') {?>
                                            <option <?php echo 'selected'?> value="M">Masculino</option>
                                            <option value="F">Feminino</option>
                                            <?php }else{ 
                                                if($value->sexo == 'F'){
                                                ?>
                                            <option value="M" >Masculino</option>
                                            <option value="F" <?php echo 'selected'?>>Feminino</option>
                                            <?php }
                                            }?>
                                        </select>
                                 </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputUsuario">Nome de usuario</label>
                                 <div class="controls">
                                    <input type="text" name="usuario" id="inputUsuario" placeholder="Nome de usuario" disabled value="<?php echo $value->usuario?>" class="input-medium">
                                 </div>
                            </div>
                        <div class="control-group">
                                <label class="control-label" for="texto1">Fale um pouco sobre você</label>
                                 <div class="controls">
                                     <textarea id="texto1" name="sobre" placeholder="Fale sobre você" style="width: 100%;" rows="8"><?php echo utf8_decode($value->sobre)?></textarea>
                                     <?php echo display_ckeditor($editor['ckeditor_texto1'])?>  
                                 </div>
                            </div> 
                            <hr/>
                            <div class="control-group">
                                <div class="controls">
                                    <button type="submit" class="btn btn-small"><i class="icon-refresh"></i>&nbsp;&nbsp;Atualizar Perfil</button>
                                     &nbsp;&nbsp;<?php echo anchor('usuario/listar_usuario', '<i class="icon-arrow-left"></i> Lista de usuários','class="btn btn-small" style="color: #000"')?>
                                </div>
                            </div>
                    </div>
                    <!--Insira uma div aqui!-->
                </div>
            </div>
            <?php echo validation_errors('<p class="msg warning">','</p>') ?>
    </fieldset>
  </form>
</span>