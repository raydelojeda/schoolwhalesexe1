<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CUser extends CI_Controller {

	function __construct()
	{
        parent::__construct();
		$this->load->model('MUser');
    }

	public function read()
	{
		$result = $this->MUser->read();

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
		$this->load->view('user/listView', $d);
	}

	public function create()
	{
		$params = $this->input->post('post');
		$result = $this->MUser->create($params);

		$d['bodyMessage'] = 'A new user was created.';
		$d['name'] = $params['name'] . ' ' . $params['lastName'];
		$d['email'] = $params['email'];

		if($result == 1)
		{
			$this->load->library('SendEmail');
			$objMail = new SendEmail();

			$fromEmail = 'do.not.reply.the.msg@gmail.com';
			$fromName = 'School of Whales';
			$emailTo = ADMIN_EMAIL;
			$emailToName = ADMIN_NAME;
			$replyToEmail = '';
			$replyToName = '';
			$subject = 'A new user was created.';
			$body = $this->load->view('emailTemplate/newUser', $d,true);
			$attachments = '';
			$cc = '';

			$return = $objMail->SendEmail($fromEmail, $fromName, $emailTo, $emailToName, $replyToEmail, $replyToName, $subject, $body, $attachments, $cc);

			echo $return;
		}
		else
			echo 'fail';
	}

	public function update()
	{
		$param = $this->input->post('post');
		$result = $this->MUser->update($param);

		if($result == true)
			echo 'success';
		else
			echo 'fail';
	}

	public function delete()
	{
		$param = $this->input->post('post');
		$result = $this->MUser->delete($param);

		if($result == true)
			echo 'success';
		else
			echo 'fail';
	}
}
