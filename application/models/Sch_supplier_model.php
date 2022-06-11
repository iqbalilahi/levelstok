<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sch_supplier_model extends CI_Model
{

    public $table = 'sch_supplier';
    public $id = 'id_sch_supplier';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_sch_supplier,id_supplier,id_material,nama_supplier,nomor_material,satuan,stok,tgl_datang');
        $this->datatables->from('sch_supplier');
        //add this line for join
        //$this->datatables->join('table2', 'sch_supplier.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('sch_supplier/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('sch_supplier/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('sch_supplier/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_sch_supplier');
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
        $this->db->like('id_sch_supplier', $q);
	$this->db->or_like('id_supplier', $q);
	$this->db->or_like('id_material', $q);
	$this->db->or_like('nama_supplier', $q);
	$this->db->or_like('nomor_material', $q);
	$this->db->or_like('satuan', $q);
	$this->db->or_like('stok', $q);
	$this->db->or_like('tgl_datang', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_sch_supplier', $q);
	$this->db->or_like('id_supplier', $q);
	$this->db->or_like('id_material', $q);
	$this->db->or_like('nama_supplier', $q);
	$this->db->or_like('nomor_material', $q);
	$this->db->or_like('satuan', $q);
	$this->db->or_like('stok', $q);
	$this->db->or_like('tgl_datang', $q);
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

/* End of file Sch_supplier_model.php */
/* Location: ./application/models/Sch_supplier_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-24 04:38:09 */
/* http://harviacode.com */