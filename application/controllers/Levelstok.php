<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Levelstok extends CI_Controller {


    function __construct()
    {
        parent::__construct();
        is_login();
        // $this->load->model('Material_model');
        // $this->load->model('Supplier_model');
        // $this->load->model('Model_model');
        // $this->load->model('Kat_material_model');
        $this->load->model('Levelstok_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','levelstok/levelstok_list');
    } 

}
