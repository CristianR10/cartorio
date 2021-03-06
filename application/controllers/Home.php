<?php

// include_once APPPATH.'/third_party/pag/PagSeguroAssinaturas.php';
// use CWG\PagSeguro\PagSeguroAssinaturas;

    class Home extends CI_Controller{

        function __construct() {

            parent::__construct();
            
            $this->load->model('inicio');
            // $this->load->model('pagseguro_control');
            $this->load->library('session');

        }


        function index(){
            // $this->load->view('estrutura/header', $title);
            // $dados['noticias'] = '';

            $dados['carros'] = $this->inicio->buscarCarrosHome();
            $dados['noticias'] = $this->inicio->buscarNoticiasHome();
            // print_r($dados['carros']);

            $this->load->view('estrutura/header');
            $this->load->view('home',$dados);
            $this->load->view('estrutura/footer');
        }

        function quemSomos(){
            $this->load->view('estrutura/header');
            $this->load->view('quemSomos');
            $this->load->view('estrutura/footer');
        }

        function servico(){
            $this->load->view('estrutura/header');
            $this->load->view('servico');
            $this->load->view('estrutura/footer');
        }

        function table(){
            $this->load->view('estrutura/header');
            $this->load->view('table');
            $this->load->view('estrutura/footer');
        }

        function contato(){
            $this->load->view('estrutura/header');
            $this->load->view('contato');
            $this->load->view('estrutura/footer');
        }
    }
