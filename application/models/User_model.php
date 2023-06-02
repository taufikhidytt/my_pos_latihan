<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model 
{
    public function login($pos)
    {
        $this->db->from('user');
        $this->db->where('username', $pos['username']);
        $this->db->where('password', sha1($pos['password']));
        $query = $this->db->get();
        return $query;
    }

    public function get($id = null)
    {
        $this->db->from('user');
        if($id)
        {
            $this->db->where('user_id', $id);
        }
        $data = $this->db->get();
        return $data;
    }

    public function add($data)
    {
        $params = [
            'username'  => htmlspecialchars(strtolower($data['username'])),
            'name'      => htmlspecialchars($data['name']),
            'address'   => htmlspecialchars($data['address']),
            'password'  => sha1($data['password']),
            'level'     => htmlspecialchars($data['level'])
        ];
        $this->db->insert('user', $params);
    }

    public function update($data)
    {
        $params = [
            'username'  => htmlspecialchars(strtolower($data['username'])),
            'name'      => htmlspecialchars($data['name']),
            'address'   => htmlspecialchars($data['address']),
            'level'     => htmlspecialchars($data['level'])
        ];
        if(!empty($data['password'])){
            $params['password'] = sha1($data['password']);
        }
        $this->db->where('user_id', $data['user_id']);
        $this->db->update('user', $params);
    }

    public function delete($id)
    {
        $this->db->delete('user', array('user_id' => $id));
    }
}
