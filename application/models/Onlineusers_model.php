<?php

class Onlineusers_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_all_session_data() {
        $query = $this->db->select('user_data')->get('ci_sessions');
        return $query;
    }

}

?>