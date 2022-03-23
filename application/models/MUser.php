<?php
Class MUser extends CI_Model
{
    function __construct() {
        parent::__construct();
      }

    public function read()
    {
        $query = $this->db->get('user');
        return $query->result();
    }

    public function create($params)
    {
        $insert = array();
        $insert['name'] = $params['name'];
        $insert['lastName'] = $params['lastName'];
        $insert['email'] = $params['email'];
       
        $result = $this->db->insert('user', $insert);
        
        return $result;
    }

    public function update($params)
    {
        $update = array();
        $update['name'] = $params['name'];
        $update['lastName'] = $params['lastName'];
        $update['email'] = $params['email'];
        
        $this->db->where('ID', $params['ID']);
        $result = $this->db->update('user', $update);

        return $result;
    }

    public function delete($ID)
    {
        $params = array();
        $params['ID'] = $ID;

        $result = $this->db->delete('user', $params);

        return $result;
    }

}
?>
