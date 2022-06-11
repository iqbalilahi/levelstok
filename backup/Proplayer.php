<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Proplayer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Proplayer_model');
        $this->load->model('Tim_model');
        $this->load->model('Game_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/proplayer/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/proplayer/index/';
            $config['first_url'] = base_url() . 'index.php/proplayer/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Proplayer_model->total_rows($q);
        $proplayer = $this->Proplayer_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'proplayer_data' => $proplayer,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','proplayer/proplayer_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Proplayer_model->transaksi_pro($id);
        if ($row) {
            $data = array(
		'id_proplayer' => $row->id_proplayer,
		'nama_player' => $row->nama_player,
		'telp_p' => $row->telp_p,
		'id_tim' => $row->id_tim,
        'nama_tim' => $row->nama_tim,
		'id_game' => $row->id_game,
        'nama_game' => $row->nama_game,
		'images'  => $row->images,
		'video' => $row->video,
		'prestasi' => $row->prestasi,
		'lat' => $row->lat,
		'lng' => $row->lng,
	    );
            $this->template->load('template','proplayer/proplayer_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('proplayer'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('proplayer/create_action'),
	    'id_proplayer' => set_value('id_proplayer'),
	    'nama_player' => set_value('nama_player'),
	    'telp_p' => set_value('telp_p'),
	    'id_tim' => $this->Tim_model->get_all(),
        'tim_selected' => '',
	    'id_game' => $this->Game_model->get_all(),
        'game_selected' => '',
	    'images'  => set_value('images'),
	    'video' => set_value('video'),
	    'prestasi' => set_value('prestasi'),
	    'lat' => set_value('lat'),
	    'lng' => set_value('lng'),
	);
        $this->template->load('template','proplayer/proplayer_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();
        $foto = $this->upload_foto();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_player' => $this->input->post('nama_player',TRUE),
		'telp_p' => $this->input->post('telp_p',TRUE),
		'id_tim' => $this->input->post('id_tim',TRUE),
		'id_game' => $this->input->post('id_game',TRUE),
		'images'    => $foto['file_name'],
		'video' => $this->input->post('video',TRUE),
		'prestasi' => $this->input->post('prestasi',TRUE),
		'lat' => $this->input->post('lat',TRUE),
		'lng' => $this->input->post('lng',TRUE),
	    );

            $this->Proplayer_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('proplayer'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Proplayer_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('proplayer/update_action'),
		'id_proplayer' => set_value('id_proplayer', $row->id_proplayer),
		'nama_player' => set_value('nama_player', $row->nama_player),
		'telp_p' => set_value('telp_p', $row->telp_p),
		'id_tim' => $this->Tim_model->get_all(),
        'tim_selected' => $row->id_tim,
        'id_game' => $this->Game_model->get_all(),
        'game_selected' => $row->id_game,
		'images'  => set_value('images', $row->images),
		'video' => set_value('video', $row->video),
		'prestasi' => set_value('prestasi', $row->prestasi),
		'lat' => set_value('lat', $row->lat),
		'lng' => set_value('lng', $row->lng),
	    );
            $this->template->load('template','proplayer/proplayer_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('proplayer'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();
        $foto = $this->upload_foto();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_proplayer', TRUE));
        } else {
            if($foto['file_name']==''){
                 $data = array(
        'nama_player' => $this->input->post('nama_player',TRUE),
        'telp_p' => $this->input->post('telp_p',TRUE),
        'id_tim' => $this->input->post('id_tim',TRUE),
        'id_game' => $this->input->post('id_game',TRUE),
        'video' => $this->input->post('video',TRUE),
        'prestasi' => $this->input->post('prestasi',TRUE),
        'lat' => $this->input->post('lat',TRUE),
        'lng' => $this->input->post('lng',TRUE));
        }else {
            $data = array(
		'nama_player' => $this->input->post('nama_player',TRUE),
		'telp_p' => $this->input->post('telp_p',TRUE),
		'id_tim' => $this->input->post('id_tim',TRUE),
		'id_game' => $this->input->post('id_game',TRUE),
		'images'   =>$foto['file_name'],
		'video' => $this->input->post('video',TRUE),
		'prestasi' => $this->input->post('prestasi',TRUE),
		'lat' => $this->input->post('lat',TRUE),
		'lng' => $this->input->post('lng',TRUE),
	    );

        }
            $this->Proplayer_model->update($this->input->post('id_proplayer', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('proplayer'));
        }
    }

    function upload_foto(){
        $config['upload_path']          = './assets/foto_proplayer';
        $config['allowed_types']        = 'gif|jpg|png';
        //$config['max_size']             = 100;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        $this->load->library('upload', $config);
       // $this->upload->do_upload('images');
        //return $this->upload->data();
        //Upload file
    if( ! $this->upload->do_upload("images")){
    //echo the errors
    echo $this->upload->display_errors();
    }
    return $this->upload->data();
    }
    
    public function delete($id) 
    {
        $row = $this->Proplayer_model->get_by_id($id);

        if ($row) {
            $this->Proplayer_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('proplayer'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('proplayer'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_player', 'nama player', 'trim|required');
	$this->form_validation->set_rules('telp_p', 'telp p', 'trim|required');
	$this->form_validation->set_rules('id_tim', 'id tim', 'trim|required');
	$this->form_validation->set_rules('id_game', 'id game', 'trim|required');
	$this->form_validation->set_rules('foto', 'foto', 'trim|required');
	$this->form_validation->set_rules('video', 'video', 'trim|required');
	$this->form_validation->set_rules('prestasi', 'prestasi', 'trim|required');
	$this->form_validation->set_rules('lat', 'lat', 'trim|required');
	$this->form_validation->set_rules('lng', 'lng', 'trim|required');

	$this->form_validation->set_rules('id_proplayer', 'id_proplayer', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "proplayer.xls";
        $judul = "proplayer";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Player");
	xlsWriteLabel($tablehead, $kolomhead++, "Telp P");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Tim");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Game");
	xlsWriteLabel($tablehead, $kolomhead++, "Images");
	xlsWriteLabel($tablehead, $kolomhead++, "Video");
	xlsWriteLabel($tablehead, $kolomhead++, "Prestasi");
	xlsWriteLabel($tablehead, $kolomhead++, "Lat");
	xlsWriteLabel($tablehead, $kolomhead++, "Lng");

	foreach ($this->Proplayer_model->transaksi_pro() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_player);
	    xlsWriteLabel($tablebody, $kolombody++, $data->telp_p);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_tim);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_game);
	    xlsWriteLabel($tablebody, $kolombody++, $data->images);
	    xlsWriteLabel($tablebody, $kolombody++, $data->video);
	    xlsWriteLabel($tablebody, $kolombody++, $data->prestasi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->lat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->lng);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=proplayer.doc");

        $data = array(
            'proplayer_data' => $this->Proplayer_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('proplayer/proplayer_doc',$data);
    }

}

/* End of file Proplayer.php */
/* Location: ./application/controllers/Proplayer.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-06-20 09:22:29 */
/* http://harviacode.com */