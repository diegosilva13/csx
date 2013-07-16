<span class="span10">
<?php
if($this->session->flashdata('erro'))
    echo $this->session->flashdata('erro');

    echo form_open('site/cadastro',array('class'=>'form-vertical'));
    echo form_fieldset('Novo Usuário');
    echo form_label('Seu nome completo: ');
    echo form_input(array('name'=>'nome','class'=>'span4','placeholder'=>'Seu nome completo'), set_value('nome'));
    echo form_label('E-mail: ');
    echo form_input(array('name'=>'email','class'=>'span4','placeholder'=>'Seu e-mail'), set_value('email'));
    echo form_label('Nome de usuário');
    echo form_input(array('name'=>'usuario','class'=>'span3','placeholder'=>'Minimo de 6 caracteres'),  set_value('usuario'));
    echo form_label('Repita seu nome de usuário');
    echo form_input(array('name'=>'usuario2','class'=>'span3'),  set_value('usuario2'));
    echo form_label('Senha');
    echo form_input(array('name'=>'senha','type'=>'password','class'=>'span2','placeholder'=>'Minimo de 6 caracteres'));
    echo form_label('Repita sua Senha');
    echo form_input(array('name'=>'senha2','type'=>'password','class'=>'span2'));
    echo '<hr/>';
    echo form_button(array('class'=>'btn btn-small','type'=>'submit'),'<i class="icon-plus"></i>Cadastrar');
    echo validation_errors('<p class="msg warning">', '</p>');
    echo form_fieldset_close();
    echo form_close();        
?>
</span>