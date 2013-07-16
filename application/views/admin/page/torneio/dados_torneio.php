<div class="span10">
    <?php
    foreach ($query as $value) {}
    if($this->session->flashdata('torneioOK'))
        echo utf8_decode($this->session->flashdata('torneioOK'));
    
    echo form_open('torneio/cadastro_torneio?torneio='.$value->id,array('class'=>'form-vertical'));
    echo form_fieldset('Novo Campeonato');
    echo form_label('Nome do Campeoanato');
    echo form_input(array('name'=>'nome','class'=>'span4','placeholder'=>'Nome do campeonato','disabled'=>'disabled'),$value->nome,set_value('nome'));
    echo form_label('Encerramento das inscrições');
    echo form_input(array('name'=>'encerramento_inscricao','class'=>'span4','placeholder'=>'dd/mm/aa','disabled'=>'disabled'),$value->encerramento_inscricao, set_value('encerramento_inscricao'));
    echo form_label('Descrição: ');
    echo $value->descricao;
    echo validation_errors('<p class="msg warning">', '</p>');
        if($this->ccm_model->contCadastro($value->id,$this->session->userdata('id')) < 1){
            echo anchor('torneios/cadastro_torneio/'.$value->id,'Inscrever nesse torneio','class="btn btn-small"');
            echo "&nbsp;&nbsp;&nbsp;";
        }else{
            echo '<span class="msg done">Você já está cadastrado</span>';
             echo "&nbsp;&nbsp;&nbsp;";
            echo anchor('torneios/descadastro_torneio/'.$value->id,'Cancelar Inscrição',"onClick=\" return confirm('Quer mesmo cancelar sua inscrição pemanentemente ?')\"class='btn btn-small'");
        }
    echo form_fieldset_close();
    echo form_close();     
    ?>
</div>