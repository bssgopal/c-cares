<?php

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function loginCheck($user_name, $password) {
        $this->db->select('user.id,user.user_name,user.email_id,user.company_id,user.role,gstins.trade_name,gstins.location,gstins.id as trade_id');
        $this->db->where('password', md5($password));
        $this->db->where("(LOWER(email_id) = '" . $user_name . "')");
        $this->db->join('gstins', 'gstins.id = user.gstin_id');

        $query = $this->db->get('user');
        $result = $query->row();
//        echo $this->db->last_query();exit;
        if (count($result)>0) {
            $result = $query->row();
            $data = array(
                'login' => TRUE,
                'uid' => $result->id
                
            );
            $resultant_data =(array) $result;

           // echo "<PRE>";print_r($resultant_data);exit;
            $session_data = array(
                'user_id'=> $resultant_data['id'],
                'user_name'=>$resultant_data['user_name'],
                'email_id'=>$resultant_data['email_id'],
                'gstin_id'=>$resultant_data['trade_id'],
                'trade_name'=>$resultant_data['trade_name'],
                'role'=>$resultant_data['role'],
                );
            $ci = & get_instance();
            $ci->session->set_userdata('trade_user_data',$session_data);
            if(isset($result->status) && $result->status==0){
                return 1;
            }
            return $data;
        } else {
            return 0;
        }
    }

    function emailCheck($email) {
        $query = $this->db->select('id,fullname,user_email,user_cellphone,user_status,assigned_country,activation_code')->where('user_email', $email)->get('edt_users');
        if ($query->num_rows() > 0) {
            $result = $query->row();
            $data = array(
                'login' => TRUE,
                'uid' => $result->id,
                'uname' => $result->fullname,
                'uemail' => $result->user_email,
                'uphone' => $result->user_cellphone,
                'type' => $this->getUserType($result->id),
                'ustatus' => $result->user_status,
                'assigned_country' => $result->assigned_country,
                'activation_code' => $result->activation_code
            );
            return $data;
        } else {
            return FALSE;
        }
    }

    /*     * ** Updates password *** */

    public function update_password($password, $email, $forgot_request) {
        $this->db->where('user_email', $email);
        $this->db->set('user_pwd', $password);
        $this->db->set('forgotpwd_request', $forgot_request);
        $this->db->update('edt_users');
    }

    function insertUser($table_name,$data) {
        if ($this->db->insert($table_name, $data)) {
            return $this->db->insert_id();
        }
    }


    function getUserCategory($code) {
        $query = $this->db->select('id')->where('code', $code)->get('edt_user_categories');
        $result = $query->row();
        return $result->id;
    }


    function checkEmailExists($email, $phone) {
        $query = $this->db->select('*')->where('user_email', $email)->or_where('user_cellphone', $phone)->get('palyers');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    
    
    
/* fetch data */    
    
    function get_single_data($fields,$where,$table){
        $this->db->select($fields)->from($table)->where($where); 
        $query = $this->db->get();
        $ret = $query->row();
        return $ret->$fields;
    }
    
    function get_single_data_with_Join($table_data){
        $this->db->select($fields)->from($table)->where($where); 
        $query = $this->db->get();
        $ret = $query->row();
        return $ret->$fields;
    }

}

?>