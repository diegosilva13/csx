<span class="span10">
    <h1>Últimas noticias</h1>
    <br/>
<div class="span9">
<?php foreach ($query as $value) {
    ?>
        <h2><?php echo $value->titulo ?></h2>
    <span class="label">Autor: <?php echo $value->autor ?></span>
         <?php echo $value->texto ?>
    <hr/>
 <?php } 
 echo '<div class="pagination"><ul>'.$this->pagination->create_links().'</ul></div>';
 ?>
    </div>
</span>

 

