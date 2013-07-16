<?php
$this->load->view('site/layout/head.php');
$this->load->view('site/layout/header.php');
$this->load->view('site/layout/aside.php');
$this->load->view('site/layout/start_content.php');
$this->load->view('site/page/'.$page);
$this->load->view('site/layout/end_content.php');
$this->load->view('site/layout/footer.php');