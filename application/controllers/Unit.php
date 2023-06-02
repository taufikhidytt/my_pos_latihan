<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		off_session_login();
		$this->load->model('unit_model', 'unit');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'myPos | Data Units';
		$data['judul'] = 'Data Units';
		$data['data'] = $this->unit->get();
		$this->template->load('template','products/unit/index', $data);
	}

	public function add()
	{
		$unit = new stdClass();
		$unit->unit_id = null;
		$unit->name = null;
		$data = array(
			'page'	=>	'add',
			'data'	=>	$unit
		);
		$data['title'] = 'myPos | Create New Units';
		$data['judul'] = 'Create New Units';
		$this->template->load('template','products/unit/form_unit', $data);
	}

	public function update($id)
	{
		$query = $this->unit->get($id);
		if($query->num_rows() > 0){
			$unit = $query->row();
			$data = array(
				'page'	=>	'edit',
				'data'	=>	$unit
			);
			$data['title'] = 'myPos | Update Units';
			$data['judul'] = 'Update Units';
			$this->template->load('template','products/unit/form_unit', $data);
		}else{
			echo "<script>
				alert('Data Tidak Tersedia, Silahkan Cari Data Yang Tersedia');
				window.location='".base_url('unit')."';
			</script>";
		}
	}

	public function process()
	{
		$pos = $this->input->post(null, true);
		if(isset($_POST['add'])){
			$this->unit->add($pos);
			if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('success', 'Selamat, Data Berhasil Di Tambahkan');
                redirect('unit');
				// echo "<script>
				// 	alert('Selamat, Data Berhasil Di Tambahkan');
				// 	window.location='".base_url('unit')."';
				// </script>";
			}else{
                $this->session->set_flashdata('error', 'Data Gagal Di Tambahkan');
                redirect('unit');
				// echo "<script>
				// 	alert('Data Gagal Di Tambahkan');
				// 	window.location='".base_url('unit')."';
				// </script>";
			}
		}elseif(isset($_POST['edit'])){
			$this->unit->edit($pos);
			if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('success', 'Selamat, Data Berhasil Di Update');
                redirect('unit');
				// echo "<script>
				// 	alert('Selamat, Data Berhasil Di Update');
				// 	window.location='".base_url('unit')."';
				// </script>";
			}else{
                $this->session->set_flashdata('error', 'Data Gagal Di Update');
                redirect('unit');
				// echo "<script>
				// 	alert('Data Gagal Di Update');
				// 	window.location='".base_url('unit')."';
				// </script>";
			}
		}

	}

	public function del()
	{
		$id = $this->input->post('unit_id');
		$this->unit->delete($id);
		if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('success', 'Selamat, Anda Berhasil Menghapus Data');
            redirect('unit');
			// echo "<script>
			// 	alert('Anda Berhasil Menghapus Data');
			// 	window.location='".base_url('unit')."';
			// </script>";
		}else{
            $this->session->set_flashdata('error', 'Gagal Menghapus Data, Silahkan Cek Kembali');
            redirect('unit');
			// echo "<script>
			// 	alert('Gagal Menghapus Data, Silahkan Cek Kembali');
			// 	window.location='".base_url('unit')."';
			// </script>";
		}
	}
}
