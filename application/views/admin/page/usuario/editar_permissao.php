<span class="span10">
	 
	 	<?php foreach ($query as $value){}; echo form_open('admin/permissao_usuario?edit='.$value->id,array('accept-charset'=>'utf-8','class'=>'form-horizontal','id'=>'cad_jogador')) ?>
    <fieldset>
        <legend>Editar perfil</legend>
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span10">
                            <div class="control-group">
                                <label class="control-label" for="inputNome">Nome completo</label>
                                 <div class="controls">
                                    <input type="text" name="nome" value="<?php echo $value->nome ?>" id="inputNome" class="input-xxlarge" disabled="disabled">
                                 </div>
                            </div>
                             <div class="control-group">
                                <label class="control-label" for="inputEmail">E-mail</label>
                                 <div class="controls">
                                    <input type="text" value="<?php echo $value->email ?>" id="inputEmail" placeholder="E-mail" class="input-xlarge" disabled="disabled">
                                 </div>
                            </div>
                        <div class="control-group">
                                <label class="control-label" for="inputUsuario">Usuário</label>
                                 <div class="controls">
                                    <input type="text" value="<?php echo $value->usuario ?>" id="inputUsuario" placeholder="E-mail" class="input-xlarge" disabled="disabled">
                                 </div>
                            </div>
                             <div class="control-group">
                                     <?php
                                        if($value->permissao == 'super'){?>
                                    <label class="control-label" for="inputSuper">Usuário</label>
                                     <div class="controls">
                                        <input type="text" value="Super Admin! Não pode ser modificado!" id="inputSuper" placeholder="E-mail" class="input-xlarge" disabled="disabled">
                                 </div>
                             </div>
                                     <?php }else{ ?>
                                  <div class="control-group">
                                      <div class="controls">
                                     <label class="checkbox">
                                        <input type="radio" name="permissao" value="admin" <?php echo ($value->permissao == 'admin') ? 'checked' : ''?> onchange="alerta_usuario_permissao()"/>Dar poderes administrativo á este usuário
                                     </label>
                                     <label class="checkbox">
                                         <input type="radio" name="permissao" value="guest" <?php echo ($value->permissao == 'guest') ? 'checked' : ''?> />Tirar poderes administrativos desse usuário
                                  </label>
                                 </div>
                                 </div>
                                    <?php } ?>
                                     
                           
                          <hr/>
                            <div class="control-group">
                                <div class="controls">
                                    <button type="submit" <?php echo ($value->permissao == 'super') ? 'disabled' : ''?> class="btn btn-small" onClick=" return confirm('Certeza que deseja aplicar as alterações?')"><i class="icon-plus"></i>&nbsp;&nbsp;Atualizar Usuário</button>
                                    &nbsp;&nbsp;&nbsp;
                                    <?php echo anchor('usuario/listar_usuario', '<i class="icon-arrow-left"></i> Voltar','class="btn btn-small"')?>
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