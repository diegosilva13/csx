<span class="span10">
     <h2>Editar Partida</h2>
      <?php 
                    if($this->session->flashdata('partidaOK'))
                           echo '<p class="msg done">'.$this->session->flashdata('partidaOK').'</p>'; 
                        ?>
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span10">
                        <?php foreach ($query as $value) {}; echo form_open('admin/editar_partida?edit='.$value->id); ?>
                            <fieldset class="comprimido_pt">
                                <legend>Cadastrar partida manualmente</legend>
                                <div class="control-group">
                                    <div class="controls controls-row">
                                        <div class="span5">
                                        <label class="label">Nome do Evento</label><br/>
                                        <input type="text" class="span11" name="event" placeholder="Nome do evento" value="<?php echo $value->event ?>"/>
                                    </div>
                                    <div class="span7">
                                        <label class="label">Site</label><br/>
                                        <input type="text" class="span10" name="site" placeholder="nome de um site" value="<?php echo $value->site ?>"/>
                                    </div>
                                 </div>
                                <div class="controls controls-row">
                                    <div class="span4">
                                        <label class="label">Data da partida</label>
                                        <input type="text" class="span10" name="date" value="<?php echo $value->date ?>" placeholder="dd/mm/aaaa"/>
                                    </div>
                                    <div class="span3">
                                        <label class="label">Round</label><br/>
                                        <input type="text" class="span6" name="round" placeholder="Rounds" value="<?php echo $value->round ?>"/>
                                    </div>
                                    <div class="span5">
                                        <label class="label">Resultado</label><br/>
                                        <input type="text" class="span8" name="result" placeholder="Resultado do jogo" value="<?php echo $value->result ?>"/>
                                    </div>
                                </div>
                                <div class="controls controls-row">
                                    <div class="span4">
                                        <label class="label">Data que aconteceu o jogo</label>
                                        <input type="text" class="span10" name="eventdate" placeholder="dd/mm/aaaa"value="<?php echo $value->eventdate ?>"/>
                                    </div>
                                    <div class="span3">
                                        <label class="label">ECO</label><br/>
                                        <input type="text" class="span6" name="eco" placeholder="ECO" value="<?php echo $value->eco ?>"/>
                                    </div>
                                    <div class="span5">
                                        <label class="label">PlyCount</label><br/>
                                        <input type="text" class="span8" name="plycount" placeholder="Plycount" value="<?php echo $value->plycount ?>"/>
                                    </div>
                                </div>
                                <div class="controls controls-row">
                                    <div class="span6">
                                        <label class="label">Brancas</label><br/>
                                        <input type="text" class="span9" name="white" placeholder="Nome do jogador" value="<?php echo $value->white ?>"/>
                                    </div>
                                    <div class="span6">
                                        <label class="label">Pretas</label><br/>
                                        <input type="text" class="span9" name="black" placeholder="Nome do jogador" value="<?php echo $value->black?>"/>
                                    </div>
                                </div>
                                <div class="controls controls-row">
                                   <div class="span10">
                                       <label class="label">Notação do jogo</label>
                                       <textarea rows="10" style="width: 100%" name="notation" placeholder="Insira a notação do jogo aqui" ><?php echo $value->notation ?></textarea>
                                   </div>
                                </div>
                                <input type="submit" Value="Salvar" class="btn btn-small"/>
                                </div>
                                <?php  echo validation_errors('<p class="msg warning">', '</p>')?>
                            </fieldset>
                        </form>
                        </div>
                    </div>
                    
                </div>
            </div>
</span>
 
