<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		off_session_login();
	}

	public function index()
	{
		$item = $this->db->get('p_item');
		$supplier = $this->db->get('supplier');
		$user = $this->db->get('user');
		$data['item'] = $item->num_rows();
		$data['supplier'] = $supplier->num_rows();
		$data['user'] = $user->num_rows();
		$data['title'] = 'myPos | Dashboard';
		$data['judul'] = 'Dashboard';
		$this->template->load('template','dashboard', $data);
	}
}
