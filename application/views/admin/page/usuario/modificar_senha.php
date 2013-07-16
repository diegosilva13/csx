<span class="span10">
<?php
if($this->session->flashdata('msg'))
    echo utf8_decode ($this->session->flashdata('msg'));

    echo form_open('usuario/modificar_senha',array('class'=>'form-vertical'));
    echo form_fieldset('Atualizar senha');
    echo form_label('Senha Antiga');
    echo form_input(array('name'=>'senha0','type'=>'password','class'=>'span3','placeholder'=>'senha antiga'));
    echo form_label('Nova senha: ');
    echo form_input(array('name'=>'senha1','type'=>'password','class'=>'span2','placeholder'=>'Minimo de 6 caracteres'));
    echo form_label('Repita sua Nova Senha');
    echo form_input(array('name'=>'senha2','type'=>'password','class'=>'span2'));
    echo '<hr/>';
    echo form_button(array('class'=>'btn btn-small','type'=>'submit'),'<i class="icon-plus"></i>Modificar senha');
    echo validation_errors('<p class="msg warning">', '</p>');
    echo form_fieldset_close();
    echo form_close();        
?>
</span>