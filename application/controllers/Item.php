<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		off_session_login();
		$this->load->model('Item_model', 'item');
		$this->load->model('Category_model', 'category');
		$this->load->model('Unit_model', 'unit');
		$this->load->library('form_validation');
	}

	function get_ajax() {
        $list = $this->item->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $item->barcode.'<br>
					<a href="'.base_url('item/barcode_qrcode/'.$item->item_id).'" class="btn btn-adn btn-xs">
						Generate <i class="fa fa-barcode"></i> <i class="fa fa-qrcode"></i>
					</a>';
					
            $row[] = $item->name;
            $row[] = 'Rp.'. idr_format($item->price);
            $row[] = $item->category_name;
            $row[] = $item->unit_name;
            $row[] = $item->stock;
            $row[] = $item->image != null ? 
					'<a href="'.base_url('upload/product/'.$item->image).'" target="blank">
						<img src="'.('upload/product/'.$item->image).'" alt="Photo Item" width="100%">
					</a>' : null;

            // add html for action
            $row[] = '<a href="'.base_url('item/update/'.$item->item_id).'" class="btn btn-xs btn-primary">
						<i class="fa fa-edit"></i>
					</a>    |
					<form action="'.base_url('item/del').'" method="post" class="inline">
						<input type="hidden" name="item_id" value="'.$item->item_id.'">
							<button class="btn btn-xs btn-danger" onclick="return confirm(\'Apakah Anda Ingin Menghapus Data Ini?\')">
							<i class="fa fa-trash"></i>
						</button>
					</form>';

			$data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->item->count_all(),
                    "recordsFiltered" => $this->item->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

	public function index()
	{
		$data['title'] = 'myPos | Data Items';
		$data['judul'] = 'Data Items';
		$data['data'] = $this->item->get();
		$this->template->load('template','products/item/index', $data);
	}

	public function add()
	{
		$item = new stdClass();
		$item->item_id = null;
		$item->barcode = null;
		$item->name = null;
		$item->price = null;
		$item->category_id = null;
		$item->unit_id = null;
		$category = $this->category->get();
		$unit = $this->unit->get();
		$data = array(
			'page'		=>	'add',
			'data'		=>	$item,
			'category'	=>	$category,
			'unit'		=>	$unit,
		);
		$data['title'] = 'myPos | Create New Items';
		$data['judul'] = 'Create New Items';
		$this->template->load('template','products/item/form_item', $data);
	}

	public function update($id)
	{
		$category = $this->category->get();
		$unit = $this->unit->get();
		$query = $this->item->get($id);
		if($query->num_rows() > 0){
			$item = $query->row();
			$data = array(
				'page'	=>	'edit',
				'data'	=>	$item,
				'category'	=>	$category,
				'unit'		=>	$unit,
			);
			$data['title'] = 'myPos | Update Items';
			$data['judul'] = 'Update Items';
			$this->template->load('template','products/item/form_item', $data);
		}else{
			echo "<script>
				alert('Data Tidak Tersedia, Silahkan Cari Data Yang Tersedia');
				window.location='".base_url('item')."';
			</script>";
		}
	}

	public function process()
	{
		date_default_timezone_set('Asia/Jakarta');
		$pos = $this->input->post(null, true);

		$config['upload_path']	=	'./upload/product/';
		$config['allowed_types']	=	'gif|jpg|jpeg|png';
		$config['max_size']		=	2048;
		$config['file_name']	=	'product_item-'.date('Y-m-d,H-i-s');
		$this->load->library('upload', $config);

		if(isset($_POST['add'])){
			if($this->item->check_barcode($pos['barcode'])->num_rows() > 0)
			{
				$this->session->set_flashdata('error', "Barcode $pos[barcode] sudah di gunakan");
                redirect('item/add');
			}else{
				if($_FILES['image']['name'] != null){
					if($this->upload->do_upload('image')){
						$pos['image'] = $this->upload->data('file_name');
						$this->item->add($pos);
						if($this->db->affected_rows() > 0){
							$this->session->set_flashdata('success', 'Selamat, Data Berhasil Di Tambahkan');
							redirect('item');
						}else{
							$this->session->set_flashdata('error', 'Data Gagal Di Tambahkan');
							redirect('item/add');
						}
					}else{
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('error', $error);
						redirect('item/add');
					}
				}else{
					$pos['image'] = null;
					$this->item->add($pos);
					if($this->db->affected_rows() > 0){
						$this->session->set_flashdata('success', 'Selamat, Data Berhasil Di Tambahkan');
						redirect('item');
					}else{
						$this->session->set_flashdata('error', 'Data Gagal Di Tambahkan');
						redirect('item/add');
					}
				}
			}
		}elseif(isset($_POST['edit'])){
			if($this->item->check_barcode($pos['barcode'], $pos['item_id'])->num_rows() > 0){
				$this->session->set_flashdata('error', "Barcode $pos[barcode] sudah di gunakan");
                redirect('item/update/'.$pos['item_id']);
			}else{
				if($_FILES['image']['name'] != null){
					if($this->upload->do_upload('image')){

						// fitur replace image di directory

						// $item = $this->item->get($pos['item_id'])->row();
						// if($item->image != null){
						// 	$target_file = './upload/product/'.$item->image;
						// 	unlink($target_file);
						// }

						$pos['image'] = $this->upload->data('file_name');
						$this->item->edit($pos);
						if($this->db->affected_rows() > 0){
							$this->session->set_flashdata('success', 'Selamat, Data Berhasil Di Update');
							redirect('item');
						}else{
							$this->session->set_flashdata('error', 'Data Gagal Di Update');
							redirect('item/update/'.$pos['item_id']);
						}
					}else{
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('error', $error);
						redirect('item/update/'.$pos['item_id']);
					}
				}else{
					$pos['image'] = null;
					$this->item->edit($pos);
					if($this->db->affected_rows() > 0){
						$this->session->set_flashdata('success', 'Selamat, Data Berhasil Di Update');
						redirect('item');
					}else{
						$this->session->set_flashdata('error', 'Data Gagal Di Update');
						redirect('item/update/'.$pos['item_id']);
					}
				}
			}
		}
	}

	public function hapusPhoto($id)
	{
		// fitur untuk menghapus image di directory sekaligus

		// $item = $this->item->get($id)->row();
		// if($item->image != null){
		// 	$target_file = './upload/product/'.$item->image;
		// 	unlink($target_file);
		// }

		$this->item->hapusPhoto($id);
		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('success', 'Selamat, Anda Berhasil Menghapus Photo');
			redirect('item');
		}else{
			$this->session->set_flashdata('error', 'Gaagl Menghapus Photo');
			redirect('item');
		}
	}

	public function del()
	{
		$id = $this->input->post('item_id');

		// fitur untuk menghapus image di directory sekaligus

		// $item = $this->item->get($id)->row();
		// if($item->image != null){
		// 	$target_file = './upload/product/'.$item->image;
		// 	unlink($target_file);
		// }

		$this->item->delete($id);
		if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('success', 'Selamat, Anda Berhasil Menghapus Data');
            redirect('item');
		}else{
            $this->session->set_flashdata('error', 'Gagal Menghapus Data, Silahkan Cek Kembali');
            redirect('item');
		}
	}

	public function barcode_qrcode($id)
	{
		$query = $this->item->get($id);
		if($this->db->affected_rows() > 0){
			$data['barcode'] 	= $query->row();
			$data['title'] 		= 'Generate Barcode Dan QrCode';
			$data['judul'] 		= 'Generate Barcode Dan QrCode';
			$this->template->load('template', 'products/item/barcode_qrcode', $data);
		}else{
			$this->session->set_flashdata('error', 'Data Tidak Ditemukan, Silahkan Cari Data Yang Tersedia');
			redirect('item');
		}
	}

	public function barcode_print($id)
	{
		$query = $this->item->get($id);
		$return['data'] = $query->row();
		if($query->num_rows() > 0){
			$data['row'] = $query->row();
			$html = $this->load->view('products/item/barcode_print', $data, true);
			$this->fungsi_user->pdfgenerator($html, 'barcode-'.$data['row']->barcode, 'A4', 'landscape');
		}else{
			$this->session->set_flashdata('error', 'Data tidak di temukan, silahkan cari data yang tersedia');
			redirect('item');
		}
	}

	public function qrcode_print($id)
	{
		$query = $this->item->get($id);
		$return['data'] = $query->row();
		if($query->num_rows() > 0){
			$data['row'] = $query->row();
			$html = $this->load->view('products/item/qrcode_print', $data, true);
			$this->fungsi_user->pdfgenerator($html, 'qrcode-'.$data['row']->barcode, 'A4', 'landscape');
		}else{
			$this->session->set_flashdata('error', 'Data tidak di temukan, silahkan cari data yang tersedia');
			redirect('item');			
		}
	}
}
