<?php

class Group extends Controller {

    function __construct() {
	parent::Controller();
	//make sure admin
	$this->quickauth->restrict('admin');
	$this->load->model('user_model', 'um');
    }

    function index() {
	$this->template->write_view('nav', 'parts/nav.php', NULL, true);
	$data['groups'] = $this->quickauth->get_groups();
	$this->template->write_view('body', 'admin/group/group.v.php', $data, true);

	$this->template->render();
    }

    function _create($title = null, $desc = null) {
	if (empty($title) && empty($desc)) {
	    $this->template->write_view('nav', 'parts/nav.php', NULL, true);
	    $this->template->write('body', 'Create group', true);
	    $this->template->render();
	} else {
	    if ($this->quickauth->create_group($title, $desc) == false)
		echo "Group '" . $title . "' already exists, It's ID is: " . $this->quickauth->get_group_id($title);
	    else
		echo "Group '" . $title . "' with ID " . $this->quickauth->get_group_id($title) . " has successfully been created";
	}
    }

    function create() {
	echo "create";
    }

    function list_users($gid) {

	$this->template->write_view('nav', 'parts/nav.php', NULL, true);

	$users["users"] = $this->quickauth->get_users_in_group($gid);

	$this->template->write_view('body', 'admin/group/g.users.v.php', $users, true);
	$this->template->render();

	//to be implemented
    }

    function remove() {
	//to be implemented
    }

    //adds the user to the group
    function _add_to($uid, $gid) {
	if ($this->quickauth->add($uid, $gid))
	    ui_set_message('User ' . $this->um->ID2FullName($uid, " ") . ' successfully added to group ' . $gid); //@todo resolve gid and uid to names
 redirect('group');
    }

    function add_user($gid) {

    }

}

?>
