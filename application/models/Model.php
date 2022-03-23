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

    public function edit($params)
    {
        $update = array();
        $update['name'] = $params['name'];
        $update['lastName'] = $params['lastName'];
        $update['email'] = $params['email'];
        
        $this->db->where('ID', $params['ID']);
        $result = $this->db->update('data', $update);

        return $result;
    }

    public function del($ID)
    {
        $params = array();
        $params['ID'] = $ID;

        $result = $this->db->delete('data', $params);

        return $result;
    }

}
?>