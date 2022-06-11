<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sch_supplier extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Sch_supplier_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','sch_supplier/sch_supplier_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Sch_supplier_model->json();
    }

    public function read($id) 
    {
        $row = $this->Sch_supplier_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_sch_supplier' => $row->id_sch_supplier,
		'id_supplier' => $row->id_supplier,
		'id_material' => $row->id_material,
		'nama_supplier' => $row->nama_supplier,
		'nomor_material' => $row->nomor_material,
		'satuan' => $row->satuan,
		'stok' => $row->stok,
		'tgl_datang' => $row->tgl_datang,
	    );
            $this->template->load('template','sch_supplier/sch_supplier_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sch_supplier'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sch_supplier/create_action'),
	    'id_sch_supplier' => set_value('id_sch_supplier'),
	    'id_supplier' => set_value('id_supplier'),
	    'id_material' => set_value('id_material'),
	    'nama_supplier' => set_value('nama_supplier'),
	    'nomor_material' => set_value('nomor_material'),
	    'satuan' => set_value('satuan'),
	    'stok' => set_value('stok'),
	    'tgl_datang' => set_value('tgl_datang'),
	);
        $this->template->load('template','sch_supplier/sch_supplier_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_supplier' => $this->input->post('id_supplier',TRUE),
		'id_material' => $this->input->post('id_material',TRUE),
		'nama_supplier' => $this->input->post('nama_supplier',TRUE),
		'nomor_material' => $this->input->post('nomor_material',TRUE),
		'satuan' => $this->input->post('satuan',TRUE),
		'stok' => $this->input->post('stok',TRUE),
		'tgl_datang' => $this->input->post('tgl_datang',TRUE),
	    );

            $this->Sch_supplier_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('sch_supplier'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Sch_supplier_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sch_supplier/update_action'),
		'id_sch_supplier' => set_value('id_sch_supplier', $row->id_sch_supplier),
		'id_supplier' => set_value('id_supplier', $row->id_supplier),
		'id_material' => set_value('id_material', $row->id_material),
		'nama_supplier' => set_value('nama_supplier', $row->nama_supplier),
		'nomor_material' => set_value('nomor_material', $row->nomor_material),
		'satuan' => set_value('satuan', $row->satuan),
		'stok' => set_value('stok', $row->stok),
		'tgl_datang' => set_value('tgl_datang', $row->tgl_datang),
	    );
            $this->template->load('template','sch_supplier/sch_supplier_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sch_supplier'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_sch_supplier', TRUE));
        } else {
            $data = array(
		'id_supplier' => $this->input->post('id_supplier',TRUE),
		'id_material' => $this->input->post('id_material',TRUE),
		'nama_supplier' => $this->input->post('nama_supplier',TRUE),
		'nomor_material' => $this->input->post('nomor_material',TRUE),
		'satuan' => $this->input->post('satuan',TRUE),
		'stok' => $this->input->post('stok',TRUE),
		'tgl_datang' => $this->input->post('tgl_datang',TRUE),
	    );

            $this->Sch_supplier_model->update($this->input->post('id_sch_supplier', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sch_supplier'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Sch_supplier_model->get_by_id($id);

        if ($row) {
            $this->Sch_supplier_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sch_supplier'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sch_supplier'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_supplier', 'id supplier', 'trim|required');
	$this->form_validation->set_rules('id_material', 'id material', 'trim|required');
	$this->form_validation->set_rules('nama_supplier', 'nama supplier', 'trim|required');
	$this->form_validation->set_rules('nomor_material', 'nomor material', 'trim|required');
	$this->form_validation->set_rules('satuan', 'satuan', 'trim|required');
	$this->form_validation->set_rules('stok', 'stok', 'trim|required');
	$this->form_validation->set_rules('tgl_datang', 'tgl datang', 'trim|required');

	$this->form_validation->set_rules('id_sch_supplier', 'id_sch_supplier', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "sch_supplier.xls";
        $judul = "sch_supplier";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Supplier");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Material");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Supplier");
	xlsWriteLabel($tablehead, $kolomhead++, "Nomor Material");
	xlsWriteLabel($tablehead, $kolomhead++, "Satuan");
	xlsWriteLabel($tablehead, $kolomhead++, "Stok");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Datang");

	foreach ($this->Sch_supplier_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_supplier);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_material);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_supplier);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nomor_material);
	    xlsWriteLabel($tablebody, $kolombody++, $data->satuan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->stok);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_datang);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=sch_supplier.doc");

        $data = array(
            'sch_supplier_data' => $this->Sch_supplier_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('sch_supplier/sch_supplier_doc',$data);
    }

}

/* End of file Sch_supplier.php */
/* Location: ./application/controllers/Sch_supplier.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-24 04:38:09 */
/* http://harviacode.com */