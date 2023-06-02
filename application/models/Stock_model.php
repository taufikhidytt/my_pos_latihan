<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model
{
    // start datatables
    var $column_order = array('p_item.barcode', 'p_item.name', 'p_category.name', 'unit_name', 'price', 'stock'); //set column field database for datatable orderable
    var $column_search = array('p_item.barcode', 'p_item.name', 'price', 'p_category.name', 'p_unit.name'); //set column field database for datatable searchable
    var $order = array('barcode' => 'asc'); // default order 
 
    private function _get_datatables_query() {
        $this->db->select('p_item.*, p_category.name as category_name, p_unit.name as unit_name');
        $this->db->from('p_item');
        $this->db->join('p_category', 'p_item.category_id = p_category.category_id');
        $this->db->join('p_unit', 'p_item.unit_id = p_unit.unit_id');
        $i = 0;
        foreach ($this->column_search as $item) { // loop column 
            if(@$_POST['search']['value']) { // if datatable send POST for search
                if($i===0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }  else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables_item() {
        $this->_get_datatables_query();
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all() {
        $this->db->from('p_item');
        return $this->db->count_all_results();
    }
    // end datatables

    public function get_stock()
    {
        $this->db->select('t_stock.*, p_item.barcode, p_item.name as item_name, supplier.name as supplier_name, user.name as user_name');
        $this->db->from('t_stock');
        $this->db->join('p_item', 't_stock.item_id = p_item.item_id');
        $this->db->join('supplier', 't_stock.supplier_id = supplier.supplier_id');
        $this->db->join('user', 't_stock.user_id = user.user_id');
        $this->db->where('t_stock.type', 'in');
        $this->db->order_by('p_item.barcode', 'asc');
        $data = $this->db->get();
        return $data;
    }

    public function insert($pos)
    {
        date_default_timezone_set('Asia/Jakarta');
        $params = array(
            'item_id' => $pos['item_id'],
            'supplier_id' => $pos['supplier'],
            'user_id' => $this->session->userdata('user_id'),
            'type' => 'in',
            'detail' => $pos['detail'],
            'qty' => $pos['qty'],
            'date' => $pos['date'],
            'created' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('t_stock', $params);
    }

    public function delete($id)
    {
        $this->db->where('stock_id', $id);
        $this->db->delete('t_stock');
    }
}
?>