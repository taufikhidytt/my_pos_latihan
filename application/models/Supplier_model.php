<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('supplier');
        if($id)
        {
            $this->db->where('supplier_id', $id);
        }
        $data = $this->db->get();
        return $data;
    }

    public function add($pos)
    {
        date_default_timezone_set('Asia/Jakarta');
        $params = array(
            'name'  =>  $pos['name'],
            'phone'  =>  $pos['phone'],
            'address'  =>  $pos['address'],
            'description'  =>  $pos['description'],
            'created'   =>  date('Y-m-d H-i-s')
        );
        $this->db->insert('supplier', $params);
    }

    public function edit($pos)
    {
        date_default_timezone_set('Asia/Jakarta');
        $params = array(
            'name'  =>  $pos['name'],
            'phone'  =>  $pos['phone'],
            'address'  =>  $pos['address'],
            'description'  =>  $pos['description'],
            'updated'   =>  date('Y-m-d H-i-s')
        );
        $this->db->where('supplier_id', $pos['supplier_id']);
        $this->db->update('supplier', $params);
    }

    public function delete($id)
    {
        $this->db->delete('supplier', array('supplier_id' => $id));
    }
}