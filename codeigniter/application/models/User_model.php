<?php

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function loginCheck($user_name, $password) {
        $this->db->select('playerID,password,firstName,lastName,email,role,status');
        $this->db->where('password', $password);
        $this->db->where("(LOWER(email) = '" . $user_name . "')");
        $query = $this->db->get('players');
        $result = $query->row();
//        echo $this->db->last_query();exit;
        if (count($result)>0) {
            $result = $query->row();
            $data = array(
                'login' => TRUE,
                'uid' => $result->playerID,
                'uname' => $result->firstName,
                'uemail' => $result->email,
                'catid' => $result->role,
                'ustatus' => $result->status
                
            );
            if($result->status==0){
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
}

?>