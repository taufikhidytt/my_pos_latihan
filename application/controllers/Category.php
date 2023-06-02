<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		off_session_login();
		$this->load->model('category_model', 'category');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'myPos | Data Categories';
		$data['judul'] = 'Data Categories';
		$data['data'] = $this->category->get();
		$this->template->load('template','products/category/index', $data);
	}

	public function add()
	{
		$category = new stdClass();
		$category->category_id = null;
		$category->name = null;
		$data = array(
			'page'	=>	'add',
			'data'	=>	$category
		);
		$data['title'] = 'myPos | Create New Categories';
		$data['judul'] = 'Create New Categories';
		$this->template->load('template','products/category/form_category', $data);
	}

	public function update($id)
	{
		$query = $this->category->get($id);
		if($query->num_rows() > 0){
			$category = $query->row();
			$data = array(
				'page'	=>	'edit',
				'data'	=>	$category
			);
			$data['title'] = 'myPos | Update Categories';
			$data['judul'] = 'Update Categories';
			$this->template->load('template','products/category/form_category', $data);
		}else{
			echo "<script>
				alert('Data Tidak Tersedia, Silahkan Cari Data Yang Tersedia');
				window.location='".base_url('category')."';
			</script>";
		}
	}

	public function process()
	{
		$pos = $this->input->post(null, true);
		if(isset($_POST['add'])){
			$this->category->add($pos);
			if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('success', 'Selamat, Data Berhasil Di Tambahkan');
                redirect('category');
				// echo "<script>
				// 	alert('Selamat, Data Berhasil Di Tambahkan');
				// 	window.location='".base_url('category')."';
				// </script>";
			}else{
                $this->session->set_flashdata('error', 'Data Gagal Di Tambahkan');
                redirect('category');
				// echo "<script>
				// 	alert('Data Gagal Di Tambahkan');
				// 	window.location='".base_url('category')."';
				// </script>";
			}
		}elseif(isset($_POST['edit'])){
			$this->category->edit($pos);
			if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('success', 'Selamat, Data Berhasil Di Update');
                redirect('category');
				// echo "<script>
				// 	alert('Selamat, Data Berhasil Di Update');
				// 	window.location='".base_url('category')."';
				// </script>";
			}else{
                $this->session->set_flashdata('error', 'Data Gagal Di Update');
                redirect('category');
				// echo "<script>
				// 	alert('Data Gagal Di Update');
				// 	window.location='".base_url('category')."';
				// </script>";
			}
		}

	}

	public function del()
	{
		$id = $this->input->post('category_id');
		$this->category->delete($id);
		if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('success', 'Selamat, Anda Berhasil Menghapus Data');
            redirect('category');
			// echo "<script>
			// 	alert('Anda Berhasil Menghapus Data');
			// 	window.location='".base_url('category')."';
			// </script>";
		}else{
            $this->session->set_flashdata('error', 'Gagal Menghapus Data, Silahkan Cek Kembali');
            redirect('category');
			// echo "<script>
			// 	alert('Gagal Menghapus Data, Silahkan Cek Kembali');
			// 	window.location='".base_url('category')."';
			// </script>";
		}
	}
}
