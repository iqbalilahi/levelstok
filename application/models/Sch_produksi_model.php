<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sch_produksi_model extends CI_Model
{

    public $table = 'sch_produksi';
    public $id = 'id_produksi';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_produksi,kd_produksi,id_model,stok_pemakaian,tgl_produksi,hasil_stok');
        $this->datatables->from('sch_produksi');
        //add this line for join
        //$this->datatables->join('table2', 'sch_produksi.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('sch_produksi/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('sch_produksi/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('sch_produksi/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_produksi');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_produksi', $q);
	$this->db->or_like('kd_produksi', $q);
	$this->db->or_like('id_model', $q);
	$this->db->or_like('stok_pemakaian', $q);
	$this->db->or_like('tgl_produksi', $q);
	$this->db->or_like('hasil_stok', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_produksi', $q);
	$this->db->or_like('kd_produksi', $q);
	$this->db->or_like('id_model', $q);
	$this->db->or_like('stok_pemakaian', $q);
	$this->db->or_like('tgl_produksi', $q);
	$this->db->or_like('hasil_stok', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Sch_produksi_model.php */
/* Location: ./application/models/Sch_produksi_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-12-14 12:47:19 */
/* http://harviacode.com */