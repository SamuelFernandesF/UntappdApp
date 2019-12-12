<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Beer_model extends CI_Model {
    
    public $id;
    public $name;
    public $type;
    public $alcoholicStrength;

    public function __construct($id=0) {
        $this->load->database();
        if ($id) {
            $this->db->where('id', $id);
            $result = $this->db->get('beers')->result()[0];
            $this->id                 = $result->id;
            $this->name               = $result->name;
            $this->type               = $result->type;
            $this->alcoholicStrength  = $result->alcoholicStrength;
        }
    }

    public function saveUpdate () {
        return ($this->db->query('UPDATE beers SET name="'.$this->name.'",
                                            type="'.$this->type.'" ,
                                            alcoholicStrength="'.$this->alcoholicStrength.'"
                                            WHERE id="'.$this->id.'"')) ? true : false;
    }

    public function save () {
        $data = $this->db->insert('beers', $this);
        $this->id = $this->db->insert_id();
        return $this;
    }

    public function delete () {
        $this->db->delete('beers', array('id' => $this->id));
    }

    public static function get_from_id($id) {
        $CI =& get_instance();
        $CI->db->where('id', $id);
        $result = $CI->db->get('beers')->result();
        if(count($result) > 0) return new Beer_model($result[0]->id); 
        else return false;
    }

    public static function get_all() {
        $CI =& get_instance();
        $results = $CI->db->get('beers')->result();
        return $results;
    }

    public static function search_all_columns($search_value) {
        $CI =& get_instance();
        $CI->db->like('id', $search_value);
        $CI->db->or_like('name', $search_value);
        $CI->db->or_like('type', $search_value);
        $CI->db->or_like('alcoholicStrength', $search_value);
        $results = $CI->db->get('beers')->result();
        return $results;
    }
}