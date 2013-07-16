
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="iso-8859-1">
    <title><?php echo $title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php
    	echo $css, $script;
    ?>
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    </head>
  <body>
    <div class="container">
      <?php echo form_open('auth/login',array('class'=>'form-signin')) ?>
        <?php  if($this->session->flashdata('erro')) echo utf8_decode($this->session->flashdata('erro'));?>
        <?php  if($this->session->userdata('erro')) echo utf8_decode($this->session->userdata('erro')); $this->session->unset_userdata('erro') ?>
        <h2 class="form-signin-heading">Área restrita</h2><hr />
        <input type="text" name="usuario" class="input-block-level" placeholder="usuário">
        <input type="password" name="senha" class="input-block-level" placeholder="senha">
        <button class="btn btn-success" type="submit">Entrar no sistema</button>
        <?php echo validation_errors('<p class="msg warning">', '</p>')?>
      	&nbsp;&nbsp;&nbsp;
        <!--<a href="#" class="alert-info">Recuperar senha</a>-->
        <hr />
        <a href="<?php echo base_url(); ?>"><li class="icon-share"></li>Voltar ao Site</a>
      </form>
    </div> 
  </body>
</html>
