<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		off_session_login();
		$this->load->model('customer_model', 'customer');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'myPos | Data Customers';
		$data['judul'] = 'Data Customers';
		$data['data'] = $this->customer->get();
		$this->template->load('template','customers/index', $data);
	}

	public function add()
	{
		$customer = new stdClass();
		$customer->customer_id = null;
		$customer->name = null;
		$customer->gender = null;
		$customer->phone = null;
		$customer->address = null;
		$data = array(
			'page'	=>	'add',
			'data'	=>	$customer
		);
		$data['title'] = 'myPos | Create New Customers';
		$data['judul'] = 'Create New Customers';
		$this->template->load('template','customers/form_customer', $data);
	}

	public function update($id)
	{
		$query = $this->customer->get($id);
		if($query->num_rows() > 0){
			$customer = $query->row();
			$data = array(
				'page'	=>	'edit',
				'data'	=>	$customer
			);
			$data['title'] = 'myPos | Update Customers';
			$data['judul'] = 'Update Customers';
			$this->template->load('template','customers/form_customer', $data);
		}else{
			$this->session->set_flashdata('error', 'Data Tidak Tersedia, Silahkan Cari Yang Sudah Tersedia');
			redirect('customer');
			
			// echo "<script>
			// 	alert('Data Tidak Tersedia, Silahkan Cari Yang Sudah Tersedia');
			// 	window.location='".base_url('customer')."';
			// </script>";
		}
	}

	public function process()
	{
		$pos = $this->input->post(null, true);
		if(isset($_POST['add'])){
			$this->customer->add($pos);
			if($this->db->affected_rows() > 0){
				$this->session->set_flashdata('success', 'Selamat, Data Berhasil Di Tambahkan');
				redirect('customer');
				
				// echo "<script>
				// 	alert('Selamat, Data Berhasil Di Tambahkan');
				// 	window.location='".base_url('customer')."';
				// </script>";
			}else{
				$this->session->set_flashdata('error', 'Data Gagal Di Tambahkan');
				redirect('customer');

				// echo "<script>
				// 	alert('Data Gagal Di Tambahkan');
				// 	window.location='".base_url('customer')."';
				// </script>";
			}
		}elseif(isset($_POST['edit'])){
			$this->customer->edit($pos);
			if($this->db->affected_rows() > 0){
				$this->session->set_flashdata('success', 'Selamat, Data Berhasil Di Update');
				redirect('customer');
				
				// echo "<script>
				// 	alert('Selamat, Data Berhasil Di Update');
				// 	window.location='".base_url('customer')."';
				// </script>";
			}else{
				$this->session->set_flashdata('error', 'Data Gagal Di Update');
				redirect('customer');
				
				// echo "<script>
				// 	alert('Data Gagal Di Update');
				// 	window.location='".base_url('customer')."';
				// </script>";
			}
		}

	}

	public function del()
	{
		$id = $this->input->post('customer_id');
		$this->customer->delete($id);
		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('success', 'Anda Berhasil Menghapus Data');
			redirect('customer');
			
			// echo "<script>
			// 	alert('Anda Berhasil Menghapus Data');
			// 	window.location='".base_url('customer')."';
			// </script>";
		}else{
			$this->session->set_flashdata('error', 'Gagal Menghapus Data, Silahkan Cek Kembali');
			redirect('customer');
			
			// echo "<script>
			// 	alert('Gagal Menghapus Data, Silahkan Cek Kembali');
			// 	window.location='".base_url('customer')."';
			// </script>";
		}
	}
}
