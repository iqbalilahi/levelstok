<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sch_produksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Sch_produksi_model');
        $this->load->model('Bom_model');
        // $this->load->model('Model_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','sch_produksi/sch_produksi_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Sch_produksi_model->json();
    }

    public function read($id) 
    {
        $row = $this->Sch_produksi_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_produksi' => $row->id_produksi,
		'kd_produksi' => $row->kd_produksi,
		'id_model' => $row->id_model,
		'id_bom' => $row->id_bom,
		'stok_pemakaian' => $row->stok_pemakaian,
		'tgl_produksi' => $row->tgl_produksi,
		'hasil_stok' => $row->hasil_stok,
	    );
            $this->template->load('template','sch_produksi/sch_produksi_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sch_produksi'));
        }
    }

    function get_model()
    {
        $id = $this->input->post('id_bom');
        if ($id != NULL) 
        {
            $data = $this->Bom_model->get_bomid($id);
            echo $data;
        }
    }

    function get_qty()
    {
        $id = $this->input->post('id_bom');
        if ($id != NULL) 
        {
            $data = $this->Bom_model->get_bomqty($id);
            echo $data;
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sch_produksi/create_action'),
	    'id_produksi' => set_value('id_produksi'),
	    'kd_produksi' => set_value('kd_produksi'),
	    'id_model' => set_value('id_model'),
	    // 'id_bom' => set_value('id_bom'),
        'id_bom' => $this->Bom_model->get_bom(),
        'id_bom_selected' => '',
	    'stok_pemakaian' => set_value('stok_pemakaian'),
	    'tgl_produksi' => set_value('tgl_produksi'),
	    'hasil_stok' => set_value('hasil_stok'),
	);
        $this->template->load('template','sch_produksi/sch_produksi_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kd_produksi' => $this->input->post('kd_produksi',TRUE),
		'id_model' => $this->input->post('id_model',TRUE),
		'id_bom' => $this->input->post('id_bom',TRUE),
		'stok_pemakaian' => $this->input->post('stok_pemakaian',TRUE),
		'tgl_produksi' => $this->input->post('tgl_produksi',TRUE),
		'hasil_stok' => $this->input->post('hasil_stok',TRUE),
	    );

            $this->Sch_produksi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('sch_produksi'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Sch_produksi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sch_produksi/update_action'),
		'id_produksi' => set_value('id_produksi', $row->id_produksi),
		'kd_produksi' => set_value('kd_produksi', $row->kd_produksi),
		'id_model' => set_value('id_model', $row->id_model),
		'id_bom' => set_value('id_bom', $row->id_bom),
		'stok_pemakaian' => set_value('stok_pemakaian', $row->stok_pemakaian),
		'tgl_produksi' => set_value('tgl_produksi', $row->tgl_produksi),
		'hasil_stok' => set_value('hasil_stok', $row->hasil_stok),
	    );
            $this->template->load('template','sch_produksi/sch_produksi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sch_produksi'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_produksi', TRUE));
        } else {
            $data = array(
		'kd_produksi' => $this->input->post('kd_produksi',TRUE),
		'id_model' => $this->input->post('id_model',TRUE),
		'id_bom' => $this->input->post('id_bom',TRUE),
		'stok_pemakaian' => $this->input->post('stok_pemakaian',TRUE),
		'tgl_produksi' => $this->input->post('tgl_produksi',TRUE),
		'hasil_stok' => $this->input->post('hasil_stok',TRUE),
	    );

            $this->Sch_produksi_model->update($this->input->post('id_produksi', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sch_produksi'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Sch_produksi_model->get_by_id($id);

        if ($row) {
            $this->Sch_produksi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sch_produksi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sch_produksi'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kd_produksi', 'kd produksi', 'trim|required');
	$this->form_validation->set_rules('id_model', 'id model', 'trim|required');
	$this->form_validation->set_rules('id_bom', 'id bom', 'trim|required');
	$this->form_validation->set_rules('stok_pemakaian', 'stok pemakaian', 'trim|required');
	$this->form_validation->set_rules('tgl_produksi', 'tgl produksi', 'trim|required');
	$this->form_validation->set_rules('hasil_stok', 'hasil stok', 'trim|required');

	$this->form_validation->set_rules('id_produksi', 'id_produksi', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "sch_produksi.xls";
        $judul = "sch_produksi";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kd Produksi");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Model");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Bom");
	xlsWriteLabel($tablehead, $kolomhead++, "Stok Pemakaian");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Produksi");
	xlsWriteLabel($tablehead, $kolomhead++, "Hasil Stok");
    
    xlsWriteLabel($tablehead, $kolomhead++, "");
    xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Kd Produksi");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Model");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Bom");
	xlsWriteLabel($tablehead, $kolomhead++, "Stok Pemakaian");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Produksi");
	xlsWriteLabel($tablehead, $kolomhead++, "Hasil Stok");

	foreach ($this->Sch_produksi_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kd_produksi);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_model);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_bom);
	    xlsWriteNumber($tablebody, $kolombody++, $data->stok_pemakaian);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_produksi);
	    xlsWriteNumber($tablebody, $kolombody++, $data->hasil_stok);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function import()
    {
        
            $files = $_FILES;
            $file = $files['file'];
            $fname = $file['tmp_name'];
            $file = $_FILES['file']['name'];
            $fname = $_FILES['file']['tmp_name'];
            $ext = explode('.', $file);
            /** Include path **/
            set_include_path(APPPATH . 'third_party/PHPExcel/Classes/');
            /** PHPExcel_IOFactory */
            include 'PHPExcel/IOFactory.php';
            $objPHPExcel = PHPExcel_IOFactory::load($fname);
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, false, true);
            $data_exist = [];
            foreach ($allDataInSheet as $ads) {
                if (array_filter($ads)) {
                    array_push($data_exist, $ads);
                }
            }
            foreach ($data_exist as $key => $value) {
                if ($key == '0') {
                    continue;
                } else {
					$data_id = array(
						'id_produksi'  => $value[0]
					);

                    $data_sch = array(
                        'id_produksi' => $value[0],
                        'kd_produksi' => $value[17],
                        'id_model' => $value[1],
                        'id_bom' => $value[2],
                        'stok_pemakaian' => $value[3],
                        'tgl_produksi' => $value[4],
                        'hasil_stok' => $value[5]
					);
					$cek = $this->Sch_produksi_model->view_where_noisdelete($data_id)->num_rows();
					if($cek > 0) {
						$result = $this->Sch_produksi_model->update($this->input->post($data_id, TRUE), $data_sch);
					} else {
						$result = $this->Sch_produksi_model->insert($data_sch);
					}
                }
            }
            if ($result == 1) {
                $this->session->set_flashdata('message', 'Update/Insert Record Success');
            }
            $this->session->set_flashdata('message', 'Sorry Record Error');
            redirect(site_url('sch_produksi'));
        
	}

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=sch_produksi.doc");

        $data = array(
            'sch_produksi_data' => $this->Sch_produksi_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('sch_produksi/sch_produksi_doc',$data);
    }

}

/* End of file Sch_produksi.php */
/* Location: ./application/controllers/Sch_produksi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-12-14 12:47:19 */
/* http://harviacode.com */