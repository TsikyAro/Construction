<?php

$this->load->view('template/Header');

$this->load->view('template/NavBar');

$this->load->view($page, $data);

$this->load->view('template/Footer');
?>