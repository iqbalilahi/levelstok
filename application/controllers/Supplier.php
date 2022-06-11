<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supplier extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Supplier_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','supplier/tbl_supplier_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Supplier_model->json();
    }

    public function read($id) 
    {
        $row = $this->Supplier_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_supplier' => $row->id_supplier,
		'nama_supplier' => $row->nama_supplier,
		'telp_supplier' => $row->telp_supplier,
		'alamat' => $row->alamat,
	    );
            $this->template->load('template','supplier/tbl_supplier_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('supplier'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('supplier/create_action'),
	    'id_supplier' => set_value('id_supplier'),
	    'nama_supplier' => set_value('nama_supplier'),
	    'telp_supplier' => set_value('telp_supplier'),
	    'alamat' => set_value('alamat'),
	);
        $this->template->load('template','supplier/tbl_supplier_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_supplier' => $this->input->post('nama_supplier',TRUE),
		'telp_supplier' => $this->input->post('telp_supplier',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
	    );

            $this->Supplier_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('supplier'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Supplier_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('supplier/update_action'),
		'id_supplier' => set_value('id_supplier', $row->id_supplier),
		'nama_supplier' => set_value('nama_supplier', $row->nama_supplier),
		'telp_supplier' => set_value('telp_supplier', $row->telp_supplier),
		'alamat' => set_value('alamat', $row->alamat),
	    );
            $this->template->load('template','supplier/tbl_supplier_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('supplier'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_supplier', TRUE));
        } else {
            $data = array(
		'nama_supplier' => $this->input->post('nama_supplier',TRUE),
		'telp_supplier' => $this->input->post('telp_supplier',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
	    );

            $this->Supplier_model->update($this->input->post('id_supplier', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('supplier'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Supplier_model->get_by_id($id);

        if ($row) {
            $this->Supplier_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('supplier'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('supplier'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_supplier', 'nama supplier', 'trim|required');
	$this->form_validation->set_rules('telp_supplier', 'telp supplier', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

	$this->form_validation->set_rules('id_supplier', 'id_supplier', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_supplier.xls";
        $judul = "tbl_supplier";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Supplier");
	xlsWriteLabel($tablehead, $kolomhead++, "Telp Supplier");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");

	foreach ($this->Supplier_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_supplier);
	    xlsWriteLabel($tablebody, $kolombody++, $data->telp_supplier);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_supplier.doc");

        $data = array(
            'tbl_supplier_data' => $this->Supplier_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('supplier/tbl_supplier_doc',$data);
    }

}

/* End of file Supplier.php */
/* Location: ./application/controllers/Supplier.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-10-26 14:36:45 */
/* http://harviacode.com */