<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('customer');
        if($id)
        {
            $this->db->where('customer_id', $id);
        }
        $data = $this->db->get();
        return $data;
    }

    public function add($pos)
    {
        date_default_timezone_set('Asia/Jakarta');
        $params = array(
            'name'  =>  $pos['name'],
            'gender'  =>  $pos['gender'],
            'phone'  =>  $pos['phone'],
            'address'  =>  $pos['address'],
            'created'   =>  date('Y-m-d H-i-s')
        );
        $this->db->insert('customer', $params);
    }

    public function edit($pos)
    {
        date_default_timezone_set('Asia/Jakarta');
        $params = array(
            'name'  =>  $pos['name'],
            'gender'  =>  $pos['gender'],
            'phone'  =>  $pos['phone'],
            'address'  =>  $pos['address'],
            'updated'   =>  date('Y-m-d H-i-s')
        );
        $this->db->where('customer_id', $pos['customer_id']);
        $this->db->update('customer', $params);
    }

    public function delete($id)
    {
        $this->db->delete('customer', array('customer_id' => $id));
    }
}