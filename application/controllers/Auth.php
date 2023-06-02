<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model', 'user');
	}

	public function index()
	{
		on_session_login();
		$data['title'] = 'Login myPOS';
		$this->load->view('login', $data);
	}

	public function process()
	{
		on_session_login();
		$pos = $this->input->post(null, true);
		if($pos)
		{
			$query = $this->user->login($pos);
			if($query->num_rows() > 0)
			{
				$row = $query->row();
				$session = array(
					'user_id'	=> $row->user_id,
					'level'		=> $row->level
				);
				$this->session->set_userdata($session);
				$this->session->set_flashdata('success', 'Selamat Anda Berhsil Login!');
				redirect('dashboard');
				
				// echo "<script>
				// 	alert('Selamat, Anda Berhasil Login');
				// 	window.location='".base_url('dashboard')."';
				// </script>";
			}else{
				$this->session->set_flashdata('error', 'Username atau password salah, silahkan coba kembali!');
				redirect('auth');
				// echo "<script>
				// 	alert('Username atau password salah, silahkan coba kembali');
				// 	window.location='".base_url('auth')."';
				// </script>";
			}
		}else{
			$this->session->set_flashdata('error', 'Anda belum login, Silahkan login terlebih dahulu!');
			redirect('auth');
			// echo "<script>
			// 	alert('Anda belum login, Silahkan login terlebih dahulu');
			// 	window.location='".base_url('auth')."';
			// </script>";
		}
	}

	public function logout()
	{
		$session = array(
			'user_id',
			'level'
		);
		$this->session->unset_userdata($session);
		$this->session->set_flashdata('success', 'Selamat, Anda berhasil logout!');
		redirect('auth');
		// echo "<script>
		// 	alert('Selamat, Anda berhasil logout');
		// 	window.location='".base_url('auth')."';
		// </script>";
	}
}
