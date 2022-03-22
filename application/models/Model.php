<?php
Class Model extends CI_Model
{
    function __construct() {
        parent::__construct();

        $this->load->database();
      }

    public function get()
    {
        $query = $this->db->get('data');

        return $query->result();
    }

    public function insert($params)
    {
        $insert = array();
        $insert['name'] = $params['name'];
        $insert['lastName'] = $params['lastName'];
        $insert['email'] = $params['email'];
       
        $result = $this->db->insert('data', $insert);
        
        return $result;
    }

}
?>