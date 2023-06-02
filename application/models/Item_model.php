<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_model extends CI_Model
{
    // start datatables
    var $column_order = array(null, 'barcode', 'p_item.name', 'p_category.name', 'unit_name', 'price', 'stock'); //set column field database for datatable orderable
    var $column_search = array('barcode', 'p_item.name', 'price', 'p_category.name', 'p_unit.name'); //set column field database for datatable searchable
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
    function get_datatables() {
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

    public function get($id = null)
    {
        $this->db->select('p_item.*, p_category.name as name_category, p_unit.name as name_unit');
        $this->db->from('p_item');
        $this->db->join('p_category', 'p_category.category_id = p_item.category_id');
        $this->db->join('p_unit', 'p_unit.unit_id = p_item.unit_id');
        if($id)
        {
            $this->db->where('item_id', $id);
        }
        $this->db->order_by('barcode', 'asc');
        $data = $this->db->get();
        return $data;
    }

    public function add($pos)
    {
        date_default_timezone_set('Asia/Jakarta');
        $params = array(
            'category_id'  =>  $pos['category_id'],
            'unit_id'  =>  $pos['unit_id'],
            'barcode'  =>  strtoupper($pos['barcode']),
            'name'  =>  $pos['name'],
            'price'  =>  $pos['price'],
            'image'  =>  $pos['image'],
            'created'   =>  date('Y-m-d H-i-s')
        );
        $this->db->insert('p_item', $params);
    }

    public function edit($pos)
    {
        date_default_timezone_set('Asia/Jakarta');
        $params = array(
            'category_id'  =>  $pos['category_id'],
            'unit_id'  =>  $pos['unit_id'],
            'barcode'  =>  strtoupper($pos['barcode']),
            'name'  =>  $pos['name'],
            'price'  =>  $pos['price'],
            'updated'   =>  date('Y-m-d H-i-s')
        );
        if($pos['image'] != null){
            $params['image'] = $pos['image'];
        }
        $this->db->where('item_id', $pos['item_id']);
        $this->db->update('p_item', $params);
    }

    public function hapusPhoto($id)
    {
        $params['image'] = null;
        $this->db->where('item_id', $id);
        $this->db->update('p_item', $params);
    }

    public function delete($id)
    {
        $this->db->delete('p_item', array('item_id' => $id));
    }

    public function check_barcode($code, $id=null)
    {
        $this->db->from('p_item');
        $this->db->where('barcode', $code);
        if($id != null)
        {
            $this->db->where('item_id !=', $id);
        }
        $query = $this->db->get();
        return $query;
    }
}