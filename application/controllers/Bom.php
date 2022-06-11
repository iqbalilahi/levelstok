<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bom extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Model_model');
        $this->load->model('Material_model');
        $this->load->model('Bom_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','bom/bom_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Bom_model->json();
    }

    public function read($id) 
    {
        $row = $this->Bom_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_bom' => $row->id_bom,
		'id_material' => $row->id_material,
		'id_model' => $row->id_model,
		'qty' => $row->qty,
	    );
            $this->template->load('template','bom/bom_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bom'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('bom/create_action'),
	    'id_bom' => set_value('id_bom'),
	    'id_material' => $this->Material_model->get_all(),
        'material_selected' => '',
	    'id_model' => $this->Model_model->get_all(),
        'model_selected' => '',
	    'qty' => set_value('qty'),
	);
        $this->template->load('template','bom/bom_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_material' => $this->input->post('id_material',TRUE),
		'id_model' => $this->input->post('id_model',TRUE),
		'qty' => $this->input->post('qty',TRUE),
	    );

            $this->Bom_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('bom'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Bom_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('bom/update_action'),
		'id_bom' => set_value('id_bom', $row->id_bom),
		'id_material' => set_value('id_material', $row->id_material),
		'id_model' => set_value('id_model', $row->id_model),
		'qty' => set_value('qty', $row->qty),
	    );
            $this->template->load('template','bom/bom_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bom'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_bom', TRUE));
        } else {
            $data = array(
		'id_material' => $this->input->post('id_material',TRUE),
		'id_model' => $this->input->post('id_model',TRUE),
		'qty' => $this->input->post('qty',TRUE),
	    );

            $this->Bom_model->update($this->input->post('id_bom', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('bom'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Bom_model->get_by_id($id);

        if ($row) {
            $this->Bom_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('bom'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bom'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_material', 'id material', 'trim|required');
	$this->form_validation->set_rules('id_model', 'id model', 'trim|required');
	$this->form_validation->set_rules('qty', 'qty', 'trim|required');

	$this->form_validation->set_rules('id_bom', 'id_bom', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "bom.xls";
        $judul = "bom";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Material");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Model");
	xlsWriteLabel($tablehead, $kolomhead++, "Qty");

	foreach ($this->Bom_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_material);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_model);
	    xlsWriteNumber($tablebody, $kolombody++, $data->qty);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=bom.doc");

        $data = array(
            'bom_data' => $this->Bom_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('bom/bom_doc',$data);
    }

}

/* End of file Bom.php */
/* Location: ./application/controllers/Bom.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-11-09 12:30:31 */
/* http://harviacode.com */