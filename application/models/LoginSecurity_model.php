<?php 

 class LoginSecurity_model extends CI_Model{
    public function is_logged_in(){
        if($this->session->userdata('trade_user_data')){
             return true;
        }
        else{
             $this->session->set_flashdata('message','Unauthorized access. Please login!');
             redirect('User/signin');
       }
      }
    }