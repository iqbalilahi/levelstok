<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kat_material extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Kat_material_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','kat_material/tbl_kat_material_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Kat_material_model->json();
    }

    public function read($id) 
    {
        $row = $this->Kat_material_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kat_material' => $row->id_kat_material,
		'nama_kat_material' => $row->nama_kat_material,
	    );
            $this->template->load('template','kat_material/tbl_kat_material_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kat_material'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kat_material/create_action'),
	    'id_kat_material' => set_value('id_kat_material'),
	    'nama_kat_material' => set_value('nama_kat_material'),
	);
        $this->template->load('template','kat_material/tbl_kat_material_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_kat_material' => $this->input->post('nama_kat_material',TRUE),
	    );

            $this->Kat_material_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('kat_material'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kat_material_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kat_material/update_action'),
		'id_kat_material' => set_value('id_kat_material', $row->id_kat_material),
		'nama_kat_material' => set_value('nama_kat_material', $row->nama_kat_material),
	    );
            $this->template->load('template','kat_material/tbl_kat_material_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kat_material'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kat_material', TRUE));
        } else {
            $data = array(
		'nama_kat_material' => $this->input->post('nama_kat_material',TRUE),
	    );

            $this->Kat_material_model->update($this->input->post('id_kat_material', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kat_material'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kat_material_model->get_by_id($id);

        if ($row) {
            $this->Kat_material_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kat_material'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kat_material'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_kat_material', 'nama kat material', 'trim|required');

	$this->form_validation->set_rules('id_kat_material', 'id_kat_material', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_kat_material.xls";
        $judul = "tbl_kat_material";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Kat Material");

	foreach ($this->Kat_material_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_kat_material);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_kat_material.doc");

        $data = array(
            'tbl_kat_material_data' => $this->Kat_material_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('kat_material/tbl_kat_material_doc',$data);
    }

}

/* End of file Kat_material.php */
/* Location: ./application/controllers/Kat_material.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-10-26 14:36:01 */
/* http://harviacode.com */