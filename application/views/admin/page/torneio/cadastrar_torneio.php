<div class="span10">
    <?php
    if($this->session->flashdata('torneioOK'))
        echo utf8_decode($this->session->flashdata('torneioOK'));
    
    echo form_open('admin/cadastrar_torneio',array('class'=>'form-vertical'));
    echo form_fieldset('Novo Campeonato');
    echo form_label('Nome do Campeoanato');
    echo form_input(array('name'=>'nome','class'=>'span4','placeholder'=>'Nome do campeonato'), set_value('nome'));
    echo form_label('Encerramento das inscrições');
    echo form_input(array('name'=>'encerramento_inscricao','class'=>'span4','placeholder'=>'dd/mm/aa'), set_value('encerramento_inscricao'));
    echo form_label('Descrição');
    echo form_textarea(array('name'=>'descricao','id'=>'texto1','style'=>'width:50%'), set_value('descricao'));
    echo display_ckeditor($editor['ckeditor_texto1']);
    ?>
    <h5 style="margin-bottom: 0px;margin-top: 20px">Publicar ?</h5>
    <div class="control-group" style="margin-top: 0px">
        <div class="controls">
            <label class="checkbox">
              <input type="radio" name="publicar" value="t" checked />Sim
            </label>
            <label class="checkbox">
              <input type="radio" name="publicar" value="f"  />Não
            </label>
        </div>
   </div>
    <?php
    echo validation_errors('<p class="msg warning">', '</p>');
    echo form_fieldset_close();
    echo form_submit(array('class'=>'btn'),'Cadastrar');
    echo form_close();     
    ?>
</div>