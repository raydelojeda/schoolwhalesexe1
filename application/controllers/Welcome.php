<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	function __construct() 
	{
        parent::__construct();
		$this->load->model('Model');
    }

	public function index()
	{
		$result = $this->Model->get();

		$record = array();
		$records = array();

		$totalResult = sizeof($result);

		for($i = 0; $i < $totalResult; $i++)
		{
			$record['ID'] = $result[$i]->ID;
			$record['name'] = $result[$i]->name;
			$record['lastName'] = $result[$i]->lastName;
			$record['email'] = $result[$i]->email;

			$records[$i] = $record;
		}

		$d['data'] = json_encode($records);

		$this->load->view('App/exercise', $d);
	}


	public function Add()
	{
		$result = $this->Model->insert($this->input->post('post'));

		if($result == 1)
			echo 'success';
		else
			echo 'fail';
	}
}
