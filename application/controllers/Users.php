<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		off_session_login();
		check_admin();
		$this->load->model('user_model', 'user');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'myPos | Data Users';
		$data['judul'] = 'Users';
		$data['data'] = $this->user->get();
		$this->template->load('template','users/index', $data);
	}

	public function add()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]');
		$this->form_validation->set_rules('name', 'name', 'required|min_length[5]');
		$this->form_validation->set_rules('address', 'Address', 'required|min_length[5]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
		$this->form_validation->set_rules('password2', 'Konfirmasi password', 'required|matches[password]');
		$this->form_validation->set_rules('level', 'Level', 'required');

		$this->form_validation->set_message('required', '{field} tidak boleh kosong');
		$this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
		$this->form_validation->set_message('is_unique', '{field} sudah ada, silahkan cari username baru');
		$this->form_validation->set_message('matches', '{field} tidak sesuai');
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'myPos | Add Users';
			$data['judul'] = 'Create New Users';
			$this->template->load('template', 'users/add', $data);
		} else {
			$data = $this->input->post(null, true);
			$this->user->add($data);
			if($this->db->affected_rows() > 0)
			{
				echo "<script>
					alert('Selamat Anda Berhasil Menambahkan Data Baru');
					window.location='".base_url('users')."';
				</script>";
			}else{
				echo "<script>
					alert('Server Error, Silahkan Coba Lagi Nanti');
					window.location='".base_url('users')."';
				</script>";
			}
		}
	}

	public function update($id)
	{
		$this->form_validation->set_rules('username', 'Username', 'required|callback_username_check');
		$this->form_validation->set_rules('name', 'name', 'required|min_length[5]');
		$this->form_validation->set_rules('address', 'Address', 'required|min_length[5]');
		if($this->input->post('password')){
			$this->form_validation->set_rules('password', 'Password', 'min_length[5]');
			$this->form_validation->set_rules('password2', 'Konfirmasi password', 'matches[password]');
		}
		if($this->input->post('password2')){
			$this->form_validation->set_rules('password2', 'Konfirmasi password', 'matches[password]');
		}
		$this->form_validation->set_rules('level', 'Level', 'required');

		$this->form_validation->set_message('required', '{field} tidak boleh kosong');
		$this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
		$this->form_validation->set_message('is_unique', '{field} sudah ada, silahkan cari username baru');
		$this->form_validation->set_message('matches', '{field} tidak sesuai');
		if ($this->form_validation->run() == FALSE) {
			$query = $this->user->get($id);
			if($query->num_rows() > 0){
				$data['title'] = 'myPos | Update Users';
				$data['judul'] = 'Update Users';
				$data['data'] = $query->row();
				$this->template->load('template', 'users/update', $data);
			}else{
				echo "<script>
					alert('Data Tidak Di Temukan, Silahkan Cari Data Yang Tersedia');
					window.location='".base_url('users')."';
				</script>";
			}
		} else {
			$data = $this->input->post(null, true);
			$this->user->update($data);
			if($this->db->affected_rows() > 0)
			{
				echo "<script>
					alert('Selamat Anda Berhasil Mengupdate Data');
					window.location='".base_url('users')."';
				</script>";
			}else{
				echo "<script>
					alert('Tidak Ada Data Yang Di Update');
					window.location='".base_url('users')."';
				</script>";
			}
		}
	}

	public function username_check()
	{
		$pos = $this->input->post(null, true);
		$query = $this->db->query("SELECT * FROM USER WHERE username = '$pos[username]' AND user_id != '$pos[user_id]'");
		if($query->num_rows() > 0){
			$this->form_validation->set_message('username_check', '{field} sudah ada, silahkan cari username lain');
			return false;
		}else{
			return true;
		}
	}

	public function del()
	{
		$id = $this->input->post('user_id');
		$this->user->delete($id);
		if($this->db->affected_rows() > 0){
			echo "<script>
				alert('Anda Berhasil Menghapus Data');
				window.location='".base_url('users')."';
			</script>";
		}else{
			echo "<script>
				alert('Gagal Menghapus Data, Silahkan Cek Kembali');
				window.location='".base_url('users')."';
			</script>";
		}
	}
}
