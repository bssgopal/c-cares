<?php

class Dashboard_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

  

   

    function insertUser($table_name,$data) {
        if ($this->db->insert($table_name, $data)) {
            return $this->db->insert_id();
        }
    }
    
    function updateData($table,$update_data,$update_condition){
        if(!empty($update_condition) && !empty($update_data) && !empty($table)){
            $this->db->where($update_condition);
            $this->db->update($table,$update_data);
            $afftectedRows = $this->db->affected_rows();
        return $afftectedRows;
        }
    }

    function deleteData($data){
        $delete_col = $data['colomn'];
        $delete_records = $data['delete_records'];
        $table = $data['table'];
$this->db->where_in( $delete_col, $delete_records);
$this->db->delete($table);
return $this->db->affected_rows();
    }
/* fetch data */    
    
    function get_single_data($fields,$where,$table,$additional_data=null){
        $this->db->select($fields)->from($table)->where($where); 
        if(isset($additional_data['order']))
        {
            foreach ($additional_data['order'] as $oderkey => $orderby) {
                $this->db->order_by($oderkey, $orderby);    
            }
            
        }
        if(isset($additional_data['limit']))
        {
            $limit = $additional_data['limit'];
            $this->db->limit($limit);    
        }
        

        $query = $this->db->get();
        $ret = $query->row();
        $resultant_data =(array) $ret;
        return $resultant_data;
    }
    
    function get_single_data_with_Join($table_data){
        //echo "<PRE>";print_r($table_data);exit;
        $this->db->select($table_data['fields'])->from($table_data['table'])->where($table_data['where']);
        if(isset($table_data['join']) && !empty($table_data['join'])){
            foreach ($table_data['join'] as $key => $value) {
                $this->db->join($key,$value);
            }
        }
        if(isset($table_data['group_by']) && !empty($table_data['group_by'])){
            $this->db->group_by($table_data['group_by']);
        }
        $query = $this->db->get();
        $ret = $query->row();
        $resultant_data =(array) $ret;
        return $resultant_data;
    }

    function get_multirows_with_Join($table_data){
        //echo "<PRE>";print_r($table_data);exit;
        $this->db->select($table_data['fields'])->from($table_data['table'])->where($table_data['where']);
        if(isset($table_data['join']) && !empty($table_data['join'])){
            $jointype = (isset($table_data['join_type']) && !empty($table_data['join_type'])) ? $table_data['join_type'] : 'left';
            foreach ($table_data['join'] as $key => $value) {
                $this->db->join($key,$value,$jointype);
            }
        }
        if(isset($table_data['group_by']) && !empty($table_data['group_by'])){
            $this->db->group_by($table_data['group_by']);
        }
        $query = $this->db->get();
        $ret = $query->result_array();
        //$resultant_data =(array) $ret;
        //return $resultant_data;
        return $ret;
    }    

     function get_multirows($table_data){
        //echo "<PRE>";print_r($table_data);exit;
        $this->db->select($table_data['fields'])->from($table_data['table'])->where($table_data['where']);
        if(isset($table_data['order']))
        {
                    foreach ($table_data['order'] as $oderkey => $orderby) {
                $this->db->order_by($oderkey, $orderby);    
            }
            
        }
        $query = $this->db->get();
        $resultant_data =  $query->result_array(); 
        $result  =(array) $resultant_data;
        return $result;
    }    

    function insertData($table_name,$data) {
        if ($this->db->insert($table_name, $data)) {
            return $this->db->insert_id();
        }
    }

    function insert_batch_data($table_name,$data){
        $this->db->insert_batch($table_name, $data);
    }

}

?>