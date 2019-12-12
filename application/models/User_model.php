<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {
    public $id;
    public $name;
    public $email;
    public $password;
    public $beer_counter;
    public $total_beers;
    public $description;
    public $picture;

    public function __construct($id=0) {
        $this->load->database();
        if ($id) {
            $this->db->where('id', $id);
            $result = $this->db->get('users')->result()[0];
            $this->id             = $result->id;
            $this->name           = $result->name;
            $this->email          = $result->email;
            $this->password       = $result->password;
            $this->beer_counter   = $result->beer_counter;
            $this->total_beers    = $result->total_beers;
            $this->description    = $result->description;
            $this->picture        = $result->picture;
        }
    }

    public function saveUpdate () {
        return ($this->db->query('UPDATE users SET name="'.$this->name.'",
                                            email="'.$this->email.'" ,
                                            password="'.$this->password.'",
                                            beer_counter="'.$this->beer_counter.'",
                                            total_beers="'.$this->total_beers.'",
                                            description="'.$this->description.'",
                                            picture="'.$this->picture.'"
                                            WHERE id="'.$this->id.'"')) ? true : false;
    }

    public function saveInsert () {
        $data = $this->db->insert('users', $this);
        $this->id = $this->db->insert_id();
        return $this;
    }

    public static function check_user($username, $password) {
        $CI =& get_instance();
        $CI->db->where('name', $username);
        $CI->db->where('password', $password);
        $result = $CI->db->get('users')->result();

        if(count($result) > 0) return new User_model($result[0]->id);
        else return false; 
    }

    public function delete () {
        $this->db->delete('users', array('id' => $this->id));
    }

    public static function get_from_id($id) {
        $CI =& get_instance();
        $CI->db->where('id', $id);
        $result = $CI->db->get('users')->result();
        if(count($result) > 0) return new User_model($result[0]->id); 
        else return false;
    }

    public static function get_all() {
        $CI =& get_instance();
        $results = $CI->db->get('users')->result();
        return $results;
    }

    public static function search_all_columns($search_value) {
        $CI =& get_instance();
        $CI->db->like('id', $search_value);
        $CI->db->or_like('name', $search_value);
        $CI->db->or_like('email', $search_value);
        $CI->db->or_like('password', $search_value);
        $CI->db->or_like('beer_counter', $search_value);
        $CI->db->or_like('total_beers', $search_value);
        $CI->db->or_like('description', $search_value);
        $CI->db->or_like('picture', $search_value);
        $results = $CI->db->get('users')->result();
        return $results;
    }
}