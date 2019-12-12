<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Checkin_model extends CI_Model {
    
    public $id;
    public $pubId;
    public $beerId;
    public $comment;
    public $rating;
    public $userId;

    public function __construct($id=0) {
        $this->load->database();
        if ($id) {
            $this->db->where('id', $id);
            $result = $this->db->get('checkin')->result()[0];
            $this->id       = $result->id;
            $this->pubId    = $result->pubId;
            $this->beerId   = $result->beerId;
            $this->comment  = $result->comment;
            $this->rating   = $result->rating;
            $this->userId   = $result->userId;
        }
    }

    public function saveUpdate () {
        return ($this->db->query('UPDATE checkin SET pubId="'.$this->pubId.'",
                                            beerId="'.$this->beerId.'" ,
                                            comment="'.$this->comment.'",
                                            rating="'.$this->rating.'",
                                            userId="'.$this->userId.'"
                                            WHERE id="'.$this->id.'"')) ? true : false;
    }

    public function save () {
        return ($this->db->insert('checkin', $this)) ? true : false;
    }

    public function delete () {
        $this->db->delete('checkin', array('id' => $this->id));
    }

    public static function get_from_id($id) {
        $CI =& get_instance();
        $CI->db->where('id', $id);
        $result = $CI->db->get('checkin')->result();
        if(count($result) > 0) return new Checkin_model($result[0]->id); 
        else return false;
    }

    public static function get_all_from_user($id) {
        $CI =& get_instance();
        $CI->db->where('userId', $id);
        $result = $CI->db->get('checkin')->result();
        if(count($result) > 0) return $result; 
        else return false;
    }

    public static function get_all_from_beer($id) {
        $CI =& get_instance();
        $CI->db->where('beerId', $id);
        $result = $CI->db->get('checkin')->result();
        if(count($result) > 0) return $result; 
        else return false;
    }

    public static function get_all_from_pub($id) {
        $CI =& get_instance();
        $CI->db->where('pubId', $id);
        $result = $CI->db->get('checkin')->result();
        if(count($result) > 0) return $result; 
        else return false;
    }

    public static function get_all() {
        $CI =& get_instance();
        $results = $CI->db->get('checkin')->result();
        return $results;
    }

    public static function search_all_columns($search_value) {
        $CI =& get_instance();
        $CI->db->like('id', $search_value);
        $CI->db->or_like('comment', $search_value);
        $results = $CI->db->get('checkin')->result();
        return $results;
    }
}