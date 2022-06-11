<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Model_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','model/tbl_model_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Model_model->json();
    }

    public function read($id) 
    {
        $row = $this->Model_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_model' => $row->id_model,
		'kd_model' => $row->kd_model,
		'nama_model' => $row->nama_model,
		'keterangan' => $row->keterangan,
	    );
            $this->template->load('template','model/tbl_model_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('model'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('model/create_action'),
	    'id_model' => set_value('id_model'),
	    'kd_model' => set_value('kd_model'),
	    'nama_model' => set_value('nama_model'),
	    'keterangan' => set_value('keterangan'),
	);
        $this->template->load('template','model/tbl_model_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kd_model' => $this->input->post('kd_model',TRUE),
		'nama_model' => $this->input->post('nama_model',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
	    );

            $this->Model_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('model'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Model_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('model/update_action'),
		'id_model' => set_value('id_model', $row->id_model),
		'kd_model' => set_value('kd_model', $row->kd_model),
		'nama_model' => set_value('nama_model', $row->nama_model),
		'keterangan' => set_value('keterangan', $row->keterangan),
	    );
            $this->template->load('template','model/tbl_model_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('model'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_model', TRUE));
        } else {
            $data = array(
		'kd_model' => $this->input->post('kd_model',TRUE),
		'nama_model' => $this->input->post('nama_model',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
	    );

            $this->Model_model->update($this->input->post('id_model', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('model'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Model_model->get_by_id($id);

        if ($row) {
            $this->Model_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('model'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('model'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kd_model', 'kd model', 'trim|required');
	$this->form_validation->set_rules('nama_model', 'nama model', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

	$this->form_validation->set_rules('id_model', 'id_model', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_model.xls";
        $judul = "tbl_model";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Kd Model");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Model");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");

	foreach ($this->Model_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kd_model);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_model);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_model.doc");

        $data = array(
            'tbl_model_data' => $this->Model_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('model/tbl_model_doc',$data);
    }

}

/* End of file Model.php */
/* Location: ./application/controllers/Model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-10-26 14:36:17 */
/* http://harviacode.com */