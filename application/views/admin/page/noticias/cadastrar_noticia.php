<span class="span10">
    <?php echo form_open('admin/cadastrar_noticias', array('class'=>''))?>
    <fieldset>
        <legend><?php echo $title?></legend>
        <?php if($this->session->flashdata('noticiasOK'))
                echo $this->session->flashdata('noticiasOK');
            ?>
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12">
                            <div class="control-group">
                                <label class="control-label" for="inputTitulo">Título</label>
                                 <div class="controls">
                                    <input type="text" name="titulo" id="inputTitulo" placeholder="Titulo" class="input-xxlarge">
                                 </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="editor1">Texto</label>
                                 <div class="controls">
                                    <textarea name="texto" id="texto1" rows="20"><?php echo set_value('texto') ?></textarea>
                                    <?php echo display_ckeditor($editor['ckeditor_texto1'])?>
                                    
                                 </div>
                            </div>
                        <div class="control-group">
                            <hr/>
                                <label class="checkbox">
                                <input type="checkbox" name="publicar" value="TRUE" checked>
                                    Publicar?
                                </label>
                                <label class="radio">
                                    <input type="checkbox" name="publica" value="TRUE" >
                                    Noticia de visualização pública
                                </label>
                                <label class="radio">
                                    <input type="checkbox" name="privada" value="TRUE">
                                     Noticia de visualização restrita
                                </label>
                            </div>
                                    <hr/>
                            <div class="control-group">
                                <div class="controls">
                                    <button type="submit" class="btn btn-small"><i class="icon-plus"></i>&nbsp;&nbsp;Cadastrar</button>
                                 </div>
                            </div>
                           <?php echo validation_errors('<p class="msg warning">', '</p>')?>
                    </div>
                </div>
            </div>
    </fieldset>
    </form>
</span>