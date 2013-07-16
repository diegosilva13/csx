<span class="span12">
     <h2>Cadastrar Partida</h2>
      <?php 
                    if($this->session->flashdata('partidaOK'))
                           echo '<p class="msg done">'.$this->session->flashdata('partidaOK').'</p>'; 
                        ?>
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span7">
                        <?php echo form_open('admin/cadastrar_partida')?>
                            <fieldset class="comprimido_pt">
                                <legend>Cadastrar partida manualmente</legend>
                                <div class="control-group">
                                    <div class="controls controls-row">
                                        <div class="span5">
                                        <label class="label">Nome do Evento</label><br/>
                                        <input type="text" class="span11" name="event" placeholder="Nome do evento" value="<?php echo utf8_decode(set_value('evento')) ?>"/>
                                    </div>
                                    <div class="span7">
                                        <label class="label">Site</label><br/>
                                        <input type="text" class="span10" name="site" placeholder="nome de um site" value="<?php echo set_value('site') ?>"/>
                                    </div>
                                 </div>
                                <div class="controls controls-row">
                                    <div class="span4">
                                        <label class="label">Data da partida</label>
                                        <input type="text" class="span10" name="date" placeholder="dd/mm/aaaa"/>
                                    </div>
                                    <div class="span3">
                                        <label class="label">Round</label><br/>
                                        <input type="text" class="span6" name="round" placeholder="Rounds" value="<?php echo utf8_decode(set_value('round')) ?>"/>
                                    </div>
                                    <div class="span5">
                                        <label class="label">Resultado</label><br/>
                                        <input type="text" class="span8" name="result" placeholder="Resultado do jogo" value="<?php echo utf8_decode(set_value('resultado')) ?>"/>
                                    </div>
                                </div>
                                <div class="controls controls-row">
                                    <div class="span4">
                                        <label class="label">Data que aconteceu o jogo</label>
                                        <input type="text" class="span10" name="eventdate" placeholder="dd/mm/aaaa"value="<?php echo set_value('data_evento') ?>"/>
                                    </div>
                                    <div class="span3">
                                        <label class="label">ECO</label><br/>
                                        <input type="text" class="span6" name="eco" placeholder="ECO" value="<?php echo utf8_decode(set_value('eco')) ?>"/>
                                    </div>
                                    <div class="span5">
                                        <label class="label">PlyCount</label><br/>
                                        <input type="text" class="span8" name="plycount" placeholder="Plycount" value="<?php echo utf8_decode(set_value('plycount')) ?>"/>
                                    </div>
                                </div>
                                <div class="controls controls-row">
                                    <div class="span6">
                                        <label class="label">Brancas</label><br/>
                                        <input type="text" class="span9" name="white" placeholder="Nome do jogador" value="<?php echo utf8_decode(set_value('brancas')) ?>"/>
                                    </div>
                                    <div class="span6">
                                        <label class="label">Pretas</label><br/>
                                        <input type="text" class="span9" name="black" placeholder="Nome do jogador" value="<?php echo utf8_decode(set_value('pretas')) ?>"/>
                                    </div>
                                </div>
                                <div class="controls controls-row">
                                   <div class="span10">
                                       <label class="label">Notação do jogo</label>
                                       <textarea rows="5" style="width: 100%" name="notation" placeholder="Insira a notação do jogo aqui" ><?php echo utf8_decode(set_value('brancas')) ?></textarea>
                                   </div>
                                </div>
                                <input type="submit" Value="Salvar" class="btn btn-small"/>
                                </div>
                                <?php  echo validation_errors('<p class="msg warning">', '</p>')?>
                            </fieldset>
                        </form>
                        </div>
                    <div class="span5">
                        <?php echo form_open_multipart('admin/cadastrar_pgn')?>
                            <fieldset class="comprimido_pt">
                                <legend>Cadastrar arquivo PGN</legend>
                                <div class="controls controls-row">
                                    <h5>Cadastre as partidas do arquivo PGN</h5>
                                 </div>
                                <div class="controls controls-row">
                                    <input type="file" name="userfile" class="btn btn-mini" style="color: black"/>
                                </div>
                                <hr/>
                                <div class="controls controls-row">
                                    <input type="submit" Value="Salvar" class="btn btn-small"/>
                                </div>
                                <hr/><?php 
                                if($this->session->flashdata('uploadOK'))
                                    echo $this->session->flashdata('uploadOK'); 
                                ?>
                            </fieldset>
                        </form>
                        </div>
                    </div>
                    
                </div>
            </div>
</span>
 
