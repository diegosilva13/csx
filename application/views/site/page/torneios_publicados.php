<span class="span10">
    <h1><?php echo $title?></h1>
    <br/>
<div class="span9">
<?php foreach ($query as $value) {
    ?>
        <h2><?php echo $value->nome ?></h2>
    <span class="label"><?php echo $value->autor ?></span>&nbsp;
    <span class="label">Encerramento das incrições:&nbsp;<?php echo $value->encerramento_inscricao ?></span>
         <?php echo $value->descricao ?>
    <hr/>
    <h5>Para se increver no torneio, <?php echo anchor('site/cadastro','<i class="icon-edit"></i>cadastre-se no sistema')?>
       &nbsp;&nbsp;ou&nbsp;&nbsp;<?php echo anchor('auth','<i class="icon-user"></i>acesse sua área restrita')?>
    </h5>
 <?php } 
 echo '<div class="pagination"><ul>'.$this->pagination->create_links().'</ul></div>';
 ?>
    </div>
</span>

 