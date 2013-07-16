<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta http-equiv="content-language" content="en" />
        <meta name="robots" content="noindex,nofollow" />
	<meta http-equiv="content-language" content="en" />
	<meta name="robots" content="noindex,nofollow" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url().'assets/design/css/2col.css'?>" title="2col" /> <!-- DEFAULT: 2 COLUMNS -->
	<link rel="alternate stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url().'assets/design/css/1col.css'?>" title="1col" /> <!-- ALTERNATE: 1 COLUMN -->
        <script type="text/javascript">
            $(document).ready(function(){
		$(".tabs > ul").tabs();
    }); 
    </script>
        <?php 
            echo $css;
            echo $script;
            if($page == 'partida_pgn.php'){
                $this->load->view('admin/layout/script_js');
            }else{
                $this->load->view('admin/layout/script_php');
            }
        ?>
	<title><?php echo $title?></title>
</head>
    <body>
        <div id="main">