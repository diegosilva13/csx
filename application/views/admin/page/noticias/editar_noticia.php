<span class="span10">
    <?php foreach ($query as $value){}; echo form_open('admin/editar_noticia?edit='.$value->id, array('class'=>''))?>
    <fieldset>
        <legend><?php echo $title?></legend>
        <?php if($this->session->flashdata('noticiaOK'))
                echo $this->session->flashdata('noticiaOK');
            ?>
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12">
                            <div class="control-group">
                                <label class="control-label" for="inputTitulo">Título</label>
                                 <div class="controls">
                                     <input type="text" name="titulo" value="<?php echo $value->titulo;set_value('titulo')?>" <?php echo set_value('titulo') ?> id="inputTitulo" placeholder="Titulo" class="input-xxlarge"/>
                                 </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="editor1">Texto</label>
                                 <div class="controls">
                                     <textarea name="texto" id="texto1" class="ckeditor" rows="20" style="width: 80%"><?php echo $value->texto , set_value('texto')?></textarea>
                                    <?php echo display_ckeditor($editor['ckeditor_texto1'])?>
                                 </div>
                            </div>
                        <div class="control-group">
                            <hr/>
                                <label class="checkbox">
                                <input type="checkbox" name="publicar" value="t" <?php echo ($value->publicar == 't') ? 'checked' : '' ?> />
                                    Publicar?
                                </label>
                                <label class="radio">
                                    <input type="checkbox" name="publica" value="t" <?php echo ($value->publica == 't') ? 'checked' : '' ?> />
                                    Noticia de visualização pública
                                </label>
                                <label class="radio">
                                    <input type="checkbox" name="privada" value="t" <?php echo ($value->privada == 't') ? 'checked' : '' ?>/>
                                     Noticia de visualização restrita
                                </label>
                            </div>
                                    <hr/>
                            <div class="control-group">
                                <div class="controls">
                                    <button type="submit" class="btn btn-small"><i class="icon-refresh"></i>&nbsp;&nbsp;Atualizar</button>
                                 </div>
                            </div>
                           <?php echo validation_errors('<p class="msg warning">', '</p>')?>
                    </div>
                </div>
            </div>
    </fieldset>
    </form>
</span>