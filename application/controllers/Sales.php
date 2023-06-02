<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		off_session_login();
        $this->load->model('Customer_model', 'customer');
	}

    public function index()
    {
        $data['title'] = 'myPos | Sales';
        $data['judul'] = 'Sales';
        $data['customers'] = $this->customer->get();
        $this->template->load('template', 'transaction/sales/index', $data);
    }

}
