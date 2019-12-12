<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Pub_model extends CI_Model {
    public $id;
    public $name;
    public $type;
    public $city;
    public $state;
    public $country;

    public function __construct($id=0) {
        $this->load->database();
        if ($id) {
            $this->db->where('id', $id);
            $result = $this->db->get('pub')->result()[0];
            $this->id         = $result->id;
            $this->name       = $result->name;
            $this->type       = $result->type;
            $this->city       = $result->city;
            $this->state      = $result->state;
            $this->country    = $result->country;
        }
    }

    public function saveUpdate () {
        return ($this->db->query('UPDATE pub SET name="'.$this->name.'",
                                            type="'.$this->type.'" ,
                                            city="'.$this->city.'",
                                            state="'.$this->state.'",
                                            country="'.$this->country.'"
                                            WHERE id="'.$this->id.'"')) ? true : false;
    }

    public function save () {
        $data = $this->db->insert('pub', $this);
        $this->id = $this->db->insert_id();
        return $this;
    }

    public function delete () {
        $this->db->delete('pub', array('id' => $this->id));
    }

    public static function get_from_id($id) {
        $CI =& get_instance();
        $CI->db->where('id', $id);
        $result = $CI->db->get('pub')->result();
        if(count($result) > 0) return new Pub_model($result[0]->id); 
        else return false;
    }

    public static function get_all() {
        $CI =& get_instance();
        $results = $CI->db->get('pub')->result();
        return $results;
    }

    public static function search_all_columns($search_value) {
        $CI =& get_instance();
        $CI->db->like('id', $search_value);
        $CI->db->or_like('name', $search_value);
        $CI->db->or_like('type', $search_value);
        $CI->db->or_like('city', $search_value);
        $CI->db->or_like('state', $search_value);
        $CI->db->or_like('country', $search_value);
        $results = $CI->db->get('pub')->result();
        return $results;
    }
}