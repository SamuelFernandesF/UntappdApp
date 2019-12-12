<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Comments_model extends CI_Model {
    
    public $id;
    public $comment;
    public $checkinId;
    public $userId;

    public function __construct($id=0) {
        $this->load->database();
        if ($id) {
            $this->db->where('id', $id);
            $result = $this->db->get('comments')->result()[0];
            $this->id           = $result->id;
            $this->comment      = $result->comment;
            $this->checkinId    = $result->checkinId;
            $this->userId       = $result->userId;
            
        }
    }

    public function saveUpdate () {
        return ($this->db->query('UPDATE comments SET comment="'.$this->comment.'",
                                            checkinId="'.$this->checkinId.'" ,
                                            comment="'.$this->comment.'",
                                            userId="'.$this->userId.'",
                                            WHERE id="'.$this->id.'"')) ? true : false;
    }

    public function save () {
        return ($this->db->insert('comments', $this)) ? true : false;
    }

    public function delete () {
        $this->db->delete('comments', array('id' => $this->id));
    }

    public static function get_from_id($id) {
        $CI =& get_instance();
        $CI->db->where('id', $id);
        $result = $CI->db->get('comments')->result();
        if(count($result) > 0) return new Comments_model($result[0]->id); 
        else return false;
    }

    public static function get_all_from_checkin($id) {
        $CI =& get_instance();
        $CI->db->where('checkinId', $id);
        $result = $CI->db->get('comments')->result();
        if(count($result) > 0) return $result; 
        else return false;
    }

    public static function get_all() {
        $CI =& get_instance();
        $results = $CI->db->get('comments')->result();
        return $results;
    }

    public static function search_all_columns($search_value) {
        $CI =& get_instance();
        $CI->db->like('id', $search_value);
        $CI->db->or_like('comment', $search_value);
        $CI->db->or_like('checkinId', $search_value);
        $CI->db->or_like('userId', $search_value);
        $results = $CI->db->get('comments')->result();
        return $results;
    }
}