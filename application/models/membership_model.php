<?php

class Membership_model extends Model
{

	function validate()
	{
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', md5($this->input->post('password')));
		$query = $this->db->get('membership');

		if ($query->num_rows == 1)
		{
			return true;
		}
	}

	function create_member()
	{
		$new_member_insert_data = array(
			'firstname' => $_POST['first_name'],
			'lastname' => $_POST['last_name'],
			'email' => $_POST['email_address'],
			'user' => $_POST['username'],
			'pass' => sha1($_POST['password']),
			'type' => $_POST['type']
		);
		$insert = $this->db->insert('users', $new_member_insert_data);
		return $insert;
	}

}

?>