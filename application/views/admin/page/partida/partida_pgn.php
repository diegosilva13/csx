<span class="span10">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span7">
                        <span class="label" style="font-size: 14px">PARTIDAS</span>
                        <div id="demo-container">
                        </div>
                    </div>
                    <div class="span5">
                        <h3>Movimentos</h3>
                        <div id="demo-moves">
                        </div>
                        <hr/>
                        <div>
                            <?php echo form_open_multipart('partida/upload_pgn') ?>
                                <fieldset>
                                    <legend>Envie um arquivo para visualizar</legend>
                                    <input type="file" name="userfile" />
                                    <input type="submit" value="Enviar"  class="btn btn-small" />
                                    <?php 
                                if($this->session->flashdata('uploadOK'))
                                    echo $this->session->flashdata('uploadOK'); 
                                ?>
                                </fieldset>
                                 <?php echo anchor('partida/listar_partida','Escolha uma partida para visualizar','class="alert"');?>
                            </form>
                        </div>
                    </div>
                    </div>
                    
                </div>
            </div>
</span>
 
