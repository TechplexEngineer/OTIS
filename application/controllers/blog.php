<?php

class Blog extends Controller {

    function __construct() {
	parent::Controller();
	$this->quickauth->restrict("auth");
//		if (!$this->quickauth->is_logged_in())
//		{//The user is not logged in
//			redirect('auth/login/blog');
//		}
	$this->load->model("blog_model");
    }

    function index() {
	//this tries to fix the undefined variable
	$uid = $this->session->userdata('userid');
	$penname = $this->user_model->ID2FirstName($uid);
	$row = array('penname' => $penname); //= $row = $this->uim->account_get($uid);
	$fields = $this->user_model->getCols('blog');

	//this fill emptyies with ' ' a space character
	//$row = blamkify($row, $fields);


	$this->template->write_view('nav', 'parts/nav.php', NULL, true);
	$this->template->write_view('body', 'blog.v.php', $row, true);
	//$this->template->write('body', 'Admin Area <br>', true);
	//$this->template->write('body', anchor('admin/user_edit', "view accts"), false);
	$this->template->render();
	//$this->load->view('blog.v.php');
    }

    function submit() {
	
	if ($_REQUEST['action'] == "Submit") {
	    if (strlen($_POST['title']) <= 3) {
		ui_set_error("You title must be longer than 3 characters.");
		redirect('/blog');
	    }

	    if (strlen($_POST['author']) <= 3) {
		ui_set_error("You author name must be longer than 3 characters.");
		redirect('/blog'); // @todo use ci's form fill thingy library
	    }

	    $date = $_POST['eventDate'];
	    //$date = str_replace(",", "|", $var);

	    $post = $_POST['entry'];
	    //f-ing tinymce style shit
	    if ("<div style=\"" == substr($post, 0, 12))
		$out = substr($post, strrpos($post, "\">") + 2, -6);
	    else if ("<div>" == substr($post, 0, 5))
		$out = substr($post, 6, -6);
	    else
		$out= $post;
		$date = mysql_real_escape_string($date);

		$time = strtotime( $date );
		$mdate = date( 'y-m-d', $time );

	    //$sql = "INSERT "
	    $sql = "INSERT INTO `blog` ( `title`, `date`, `mdate`, `created`, `lastUpdate`, `post`, `author`, `approved`) \n"
		    . "VALUES (
				    '" . mysql_real_escape_string($_POST['title']) . "',
				    '" . $date . "',
				    '" . $mdate. "',
                                    '".date("m.d.y")."',
                                    '".date("m.d.y")."',
				    '" . mysql_real_escape_string($out) . "',
				    '" . mysql_real_escape_string($_POST['author']) . "', 'False')\n";

	    //echo $sql;
	    $qry = mysql_query($sql) or die(mysql_error());

	    ui_set_message("Entry added to database, It will appear on the website as soon as it has been approved.");
	    redirect('/blog');
	}
    }

    /*
     * This generates the list of the blog entries
     */

    function admin($function=null, $data=null) {
	$this->quickauth->restrict("admin");
	if ($function == null) {
	    $this->template->write_view('nav', 'parts/nav.php', true);
	    $this->template->write_view('body', 'admin/manage.blog.entries.v.php', true);
	    $this->template->render();
	} elseif ($function == "edit") {
	    $this->_edit($data);
	} elseif ($function == "update") {
	    $this->_update($data);
	}
	//show_error('This page has not yet been implemented');
    }

    function _edit($bid = null) {
	if ($bid == null)
	    redirect("/blog/admin");
	else {
	    $this->template->write_view('nav', 'parts/nav.php', true);

	    $entry = $this->blog_model->getEntryArray($bid);
	    $data['bid'] = $bid;
	    $data['btitle'] = $entry['title'];
	    $data['date'] = $entry['date'];
	    $data['entry'] = $entry['post'];
	    $data['author'] = $entry['author'];
	    $data['status'] = $entry['approved'];
	    $this->template->write_view('body', 'admin/edit.blog.entry.v.php', $data, true);
	    $this->template->render();
	}
    }

    function _update($bid = null) {
	if ($bid == null)
	    redirect("/blog/admin");
	else {

	    $data['id'] = $_POST['bid'];
	    $data['title'] = $_POST['title'];
	    $data['date'] = $_POST['eventDate'];
	    $data['post'] = $_POST['entry'];
	    $data['author'] = $_POST['author'];
	    if ($_POST["action"] == "Update & Approve") {
		$this->blog_model->approve($_POST["bid"]);
	    }elseif ($_POST["action"] == "Update & UnApprove")
		$this->blog_model->unapprove($_POST["bid"]);
	    elseif($_POST["action"] == "delete")
		echo "TO Be Implemented";
	    
	    if ($this->blog_model->update($data))
		ui_set_message("Blog successfully updated");
	    redirect("blog/admin");
	    //$this->template->write_view('nav', 'parts/nav.php', true);
	    //$this->template->write_view('body', 'admin/edit.blog.entry.v.php', true);
	    //$this->template->write('body', 'you found the admin blog updateg page', true);
	    //$this->template->render();
	    //echo("you found the admin blog editing page");
	}
    }

}

?>
