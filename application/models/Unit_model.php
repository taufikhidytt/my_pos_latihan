<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_model extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('p_unit');
        if($id)
        {
            $this->db->where('unit_id', $id);
        }
        $data = $this->db->get();
        return $data;
    }

    public function add($pos)
    {
        date_default_timezone_set('Asia/Jakarta');
        $params = array(
            'name'  =>  $pos['name'],
            'created'   =>  date('Y-m-d H-i-s')
        );
        $this->db->insert('p_unit', $params);
    }

    public function edit($pos)
    {
        date_default_timezone_set('Asia/Jakarta');
        $params = array(
            'name'  =>  $pos['name'],
            'updated'   =>  date('Y-m-d H-i-s')
        );
        $this->db->where('unit_id', $pos['unit_id']);
        $this->db->update('p_unit', $params);
    }

    public function delete($id)
    {
        $this->db->delete('p_unit', array('unit_id' => $id));
    }
}