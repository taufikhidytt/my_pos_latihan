<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Stock_model', 'stock');
        $this->load->model('Supplier_model', 'supplier');
    }

    public function index()
    {
        $data['title'] = 'myPos | Data Stock In';
		$data['judul'] = 'Data Stock In';
		$data['data'] = $this->stock->get_stock();
		$this->template->load('template','transaction/stockin/index', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('barcode', 'Barcode', 'required');
        $this->form_validation->set_rules('supplier', 'Supplier', 'required');
        $this->form_validation->set_rules('detail', 'Detail', 'required');
        $this->form_validation->set_rules('qty', 'Qty', 'required');
        $this->form_validation->set_message('required', '{field} tidak boleh kosong');

        if($this->form_validation->run() == false){
            $data['title'] = 'myPos | Create Stock In';
            $data['judul'] = 'Create Stock In';
            $data['suppliers'] = $this->supplier->get();
            $this->template->load('template','transaction/stockin/add', $data);
        }else{
            $pos = $this->input->post(null, true);
            $this->stock->insert($pos);
            $this->db->query("UPDATE p_item SET stock = stock + $pos[qty] WHERE item_id = $pos[item_id]");
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('success', 'Selamat, Anda Berhasil Menambahkan Data');
                redirect('stock');
            }else{
                $this->session->set_flashdata('error', 'Gagal Menambahkan Data');
                redirect('stock/add');
            }
        }
    }

    function get_ajax_item() {
        $list = $this->stock->get_datatables_item();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            // $no++;
            $row = array();
            // $row[] = $no.".";
            $row[] = $item->barcode.'<br>
					<a href="'.base_url('item/barcode_qrcode/'.$item->item_id).'" class="btn btn-adn btn-xs">
						Generate <i class="fa fa-barcode"></i> <i class="fa fa-qrcode"></i>
					</a>';
					
            $row[] = $item->name;
            $row[] = "Rp.". number_format($item->price,2,",",".");
            $row[] = $item->category_name;
            $row[] = $item->unit_name;
            $row[] = $item->stock != null ? $item->stock : 0;
            // add html for action
            $row[] = '<button type="button" class="btn btn-primary btn-xs" id="select"
                        data-item_id="'.$item->item_id.'"
                        data-barcode="'.$item->barcode.'"
                        data-name="'.$item->name.'"
                        data-category_name="'.$item->category_name.'"
                        data-price="'.$item->price.'"
                        data-unit_name="'.$item->unit_name.'"
                        data-stock="'.$item->stock.'"
                        >
                        <i class="fa fa-check"></i> Selected
                    </button>
                    ';

			$data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->stock->count_all(),
                    "recordsFiltered" => $this->stock->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

    public function del($stock_id)
    {
        // $this->db->query("UPDATE p_item SET stock = stock - $qty WHERE item_id = $item_id");
        $this->stock->delete($stock_id);
        if($this->db->affected_rows() > 0 ){
            $this->session->set_flashdata('success', 'Selamat, Anda Berhasil Menghapus Data Baru');
            redirect('stock');
        }else{
            $this->session->set_flashdata('error', 'Gagal Menghapus Data');
            redirect('stock');
        }
    }
}

?>