<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Friends_model extends CI_Model {
    public $id;
    public $user1;
    public $user2;
    public $status;

    public function __construct($id=0) {
        $this->load->database();
        if ($id) {
            $this->db->where('id', $id);
            $result = $this->db->get('friends')->result()[0];
            $this->id         = $result->id;
            $this->user1       = $result->user1;
            $this->user2       = $result->user2;
            $this->status       = $result->status;
        }
    }

    public function saveUpdate () {
        return ($this->db->query('UPDATE friends SET user1="'.$this->user1.'",
                                            user2="'.$this->user2.'", 
                                            status="'.$this->status.'"
                                            WHERE id="'.$this->id.'"')) ? true : false;
    }

    public function save () {
        $data = $this->db->insert('friends', $this);
        $this->id = $this->db->insert_id();
        return $this;
    }

    public function delete () {
        $this->db->delete('friends', array('id' => $this->id));
    }

    public static function get_unnacepted_solicitation($id) {
        $CI =& get_instance();
        $CI->db->where('user2', $id);
        $CI->db->where('status', 0);
        $result = $CI->db->get('friends')->result();
        if(count($result) > 0) return $result; 
        else return false;
    }

    public static function get_solicitations_to_user($id) {
        $CI =& get_instance();
        $CI->db->where('user2', $id);
        $result = $CI->db->get('friends')->result();
        if(count($result) > 0) return $result; 
        else return false;
    }

    public static function get_from_users($user1, $user2) {
        $CI =& get_instance();
        
        $CI->db->group_start();
        $CI->db->where('user1', $user1);
        $CI->db->or_where('user1', $user2);
        $CI->db->group_end();

        $CI->db->group_start();
        $CI->db->where('user2', $user2);
        $CI->db->or_where('user2', $user1);
        $CI->db->group_end();

        $result = $CI->db->get('friends')->result();
        if(count($result) > 0) return new Friends_model($result[0]->id); 
        else return false;
    }

    public static function get_friends($id) {
        $CI =& get_instance();
        
        $CI->db->group_start();
        $CI->db->where('user1', $id);
        $CI->db->or_where('user2', $id);
        $CI->db->group_end();

        $CI->db->where('status', '1');
        $result = $CI->db->get('friends')->result();
        if(count($result) > 0) return $result; 
        else return false;
    }

    public static function get_all() {
        $CI =& get_instance();
        $results = $CI->db->get('friends')->result();
        return $results;
    }

    public static function search_all_columns($search_value) {
        $CI =& get_instance();
        $CI->db->like('id', $search_value);
        $CI->db->or_like('user1', $search_value);
        $CI->db->or_like('user2', $search_value);
        $CI->db->or_like('status', $search_value);
        $results = $CI->db->get('friends')->result();
        return $results;
    }
}