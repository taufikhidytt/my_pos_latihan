<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		off_session_login();
		$this->load->model('supplier_model', 'supplier');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'myPos | Data Suppliers';
		$data['judul'] = 'Data Suppliers';
		$data['data'] = $this->supplier->get();
		$this->template->load('template','suppliers/index', $data);
	}

	public function add()
	{
		$supplier = new stdClass();
		$supplier->supplier_id = null;
		$supplier->name = null;
		$supplier->phone = null;
		$supplier->address = null;
		$supplier->description = null;
		$data = array(
			'page'	=>	'add',
			'data'	=>	$supplier
		);
		$data['title'] = 'myPos | Create New Suppliers';
		$data['judul'] = 'Create New Suppliers';
		$this->template->load('template','suppliers/form_supplier', $data);
	}

	public function update($id)
	{
		$query = $this->supplier->get($id);
		if($query->num_rows() > 0){
			$supplier = $query->row();
			$data = array(
				'page'	=>	'edit',
				'data'	=>	$supplier
			);
			$data['title'] = 'myPos | Update Suppliers';
			$data['judul'] = 'Update Suppliers';
			$this->template->load('template','suppliers/form_supplier', $data);
		}else{
			$this->session->set_flashdata('error', 'Data Tidak Tersedia, Silahkan Cari Data Yang Tersedia');
			redirect('supplier');
			
			// echo "<script>
			// 	alert('Data Tidak Tersedia, Silahkan Cari Data Yang Tersedia');
			// 	window.location='".base_url('supplier')."';
			// </script>";
		}
	}

	public function process()
	{
		$pos = $this->input->post(null, true);
		if(isset($_POST['add'])){
			$this->supplier->add($pos);
			if($this->db->affected_rows() > 0){
				$this->session->set_flashdata('success', 'Selamat, Data Berhasil Di Tambahkan');
				redirect('supplier');
				
				// echo "<script>
				// 	alert('Selamat, Data Berhasil Di Tambahkan');
				// 	window.location='".base_url('supplier')."';
				// </script>";
			}else{
				$this->session->set_flashdata('error', 'Data Gagal Di Tambahkan');
				redirect('supplier');
				
				// echo "<script>
				// 	alert('Data Gagal Di Tambahkan');
				// 	window.location='".base_url('supplier')."';
				// </script>";
			}
		}elseif(isset($_POST['edit'])){
			$this->supplier->edit($pos);
			if($this->db->affected_rows() > 0){
				$this->session->set_flashdata('success', 'Selamat, Data Berhasil Di Update');
				redirect('supplier');
				
				// echo "<script>
				// 	alert('Selamat, Data Berhasil Di Update');
				// 	window.location='".base_url('supplier')."';
				// </script>";
			}else{
				$this->session->set_flashdata('error', 'Data Gagal Di Update');
				redirect('supplier');
				
				// echo "<script>
				// 	alert('Data Gagal Di Update');
				// 	window.location='".base_url('supplier')."';
				// </script>";
			}
		}

	}

	public function del($id)
	{
		// $id = $this->input->post('supplier_id');
		$this->supplier->delete($id);
		$error = $this->db->error();
		if($error['code'] != 0){
			$this->session->set_flashdata('error', 'Data Tidak Bisa Di Hapus, Data Masih Terpakai Di Modul Lain. Silahkan Cek Kembali');
			redirect('supplier');
			
			// echo "<script>
			// 	alert('Data Tidak Bisa Di Hapus, Data Masih Terpakai Di Modul Lain. Silahkan Cek Kembali');
			// 	window.location='".base_url('supplier')."';
			// 	</script>";

		}
		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('success', 'Anda Berhasil Menghapus Data');
			redirect('supplier');
			
			// echo "<script>
			// 	alert('Anda Berhasil Menghapus Data');
			// 	window.location='".base_url('supplier')."';
			// </script>";

		}else{
			$this->session->set_flashdata('error', 'Gagal Menghapus Data, Silahkan Cek Kembali');
			redirect('supplier');
			
			// echo "<script>
			// 	alert('Gagal Menghapus Data, Silahkan Cek Kembali');
			// 	window.location='".base_url('supplier')."';
			// </script>";
		}
	}
}
