<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Material extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Material_model');
        $this->load->model('Supplier_model');
        $this->load->model('Model_model');
        $this->load->model('Kat_material_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','material/tbl_material_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Material_model->json();
    }

    public function read($id) 
    {
        $row = $this->Material_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_material' => $row->id_material,
		'id_supplier' => $row->id_supplier,
		//'id_model' => $row->id_model,
		'id_kat_material' => $row->id_kat_material,
		'nomor_material' => $row->nomor_material,
		'nama_material' => $row->nama_material,
		'qty' => $row->qty,
		'satuan' => $row->satuan,
		'spek_material' => $row->spek_material,
	    );
            $this->template->load('template','material/tbl_material_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('material'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('material/create_action'),
	    'id_material' => set_value('id_material'),
	    'id_supplier' => $this->Supplier_model->get_all(),
        'supplier_selected' => '',
	    'id_model' => $this->Model_model->get_all(),
        //'model_selected' => '',
        'id_kat_material' => $this->Kat_material_model->get_all(),
        'kat_material_selected' => '',
	    //'id_kat_material' => set_value('id_kat_material'),
	    'nomor_material' => set_value('nomor_material'),
	    'nama_material' => set_value('nama_material'),
	    'qty' => set_value('qty'),
	    'satuan' => set_value('satuan'),
	    'spek_material' => set_value('spek_material'),
	);
        $this->template->load('template','material/tbl_material_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_supplier' => $this->input->post('id_supplier',TRUE),
		//'id_model' => $this->input->post('id_model',TRUE),
		'id_kat_material' => $this->input->post('id_kat_material',TRUE),
		'nomor_material' => $this->input->post('nomor_material',TRUE),
		'nama_material' => $this->input->post('nama_material',TRUE),
		'qty' => $this->input->post('qty',TRUE),
		'satuan' => $this->input->post('satuan',TRUE),
		'spek_material' => $this->input->post('spek_material',TRUE),
	    );

            $this->Material_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('material'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Material_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('material/update_action'),
		'id_material' => set_value('id_material', $row->id_material),
		'id_supplier' => set_value('id_supplier', $row->id_supplier),
		//'id_model' => set_value('id_model', $row->id_model),
		'id_kat_material' => set_value('id_kat_material', $row->id_kat_material),
		'nomor_material' => set_value('nomor_material', $row->nomor_material),
		'nama_material' => set_value('nama_material', $row->nama_material),
		'qty' => set_value('qty', $row->qty),
		'satuan' => set_value('satuan', $row->satuan),
		'spek_material' => set_value('spek_material', $row->spek_material),
	    );
            $this->template->load('template','material/tbl_material_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('material'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_material', TRUE));
        } else {
            $data = array(
		'id_supplier' => $this->input->post('id_supplier',TRUE),
		//'id_model' => $this->input->post('id_model',TRUE),
		'id_kat_material' => $this->input->post('id_kat_material',TRUE),
		'nomor_material' => $this->input->post('nomor_material',TRUE),
		'nama_material' => $this->input->post('nama_material',TRUE),
		'qty' => $this->input->post('qty',TRUE),
		'satuan' => $this->input->post('satuan',TRUE),
		'spek_material' => $this->input->post('spek_material',TRUE),
	    );

            $this->Material_model->update($this->input->post('id_material', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('material'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Material_model->get_by_id($id);

        if ($row) {
            $this->Material_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('material'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('material'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_supplier', 'id supplier', 'trim|required');
	$this->form_validation->set_rules('id_model', 'id model', 'trim|required');
	$this->form_validation->set_rules('id_kat_material', 'id kat material', 'trim|required');
	$this->form_validation->set_rules('nomor_material', 'nomor material', 'trim|required');
	$this->form_validation->set_rules('nama_material', 'nama material', 'trim|required');
	$this->form_validation->set_rules('qty', 'qty', 'trim|required');
	$this->form_validation->set_rules('satuan', 'satuan', 'trim|required');
	$this->form_validation->set_rules('spek_material', 'spek material', 'trim|required');

	$this->form_validation->set_rules('id_material', 'id_material', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_material.xls";
        $judul = "tbl_material";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Model");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Kat Material");
	xlsWriteLabel($tablehead, $kolomhead++, "Nomor Material");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Material");
	xlsWriteLabel($tablehead, $kolomhead++, "Qty");
	xlsWriteLabel($tablehead, $kolomhead++, "Satuan");
	xlsWriteLabel($tablehead, $kolomhead++, "Spek Material");

	foreach ($this->Material_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_supplier);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_model);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_kat_material);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nomor_material);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_material);
	    xlsWriteNumber($tablebody, $kolombody++, $data->qty);
	    xlsWriteLabel($tablebody, $kolombody++, $data->satuan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->spek_material);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_material.doc");

        $data = array(
            'tbl_material_data' => $this->Material_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('material/tbl_material_doc',$data);
    }

}

/* End of file Material.php */
/* Location: ./application/controllers/Material.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-10-26 14:35:43 */
/* http://harviacode.com */