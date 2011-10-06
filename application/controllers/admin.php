<?php

class admin extends Controller {

    function __construct() {
        parent::Controller();
        $this->quickauth->restrict('admin');
        $this->load->model("Io");
//		if (!$this->quickauth->is_logged_in())
//		{//The user is not logged in
//			// @todo also make sure they are an admin
//			redirect('auth/login' . uri_string());
//		}
//		//str_replace ( '/' , '$' , uri_string())
//		//echo ;
    }

    /* Admin Dashboard */

    function index() {

        $this->template->write_view('nav', 'parts/nav.php', NULL, true);
        $this->template->write_view('body', 'admin/admin.v.php', true);
        //$this->template->write('body', anchor('admin/user_edit', "view accts"), false);
        $this->template->render();
    }

    /* This function is responsible for generating the view page, which allows
     * Admins to edit all of a spesic user's inforamtion. */

    function user_edit($uid=-1) {

        if ($uid == -1)
            $uid = $this->session->userdata('userid');

        $this->load->model('user_model', 'um');


        //this tries to fix the undefined variable
        $row1 = $this->um->profile_get($uid);
        $wpfields = $this->user_model->getCols('profile');
        //this fill emptyies with ' ' a space character
        $row1 = blamkify($row1, $wpfields);
        $row1['act'] = 'fields_only';
        $row1['uid'] = $uid;

        //this tries to fix the undefined variable
        $row2 = $this->um->account_get($uid);
        $acfields = $this->user_model->getCols('account');
        //this fill emptyies with ' ' a space character
        $row2 = blamkify($row2, $acfields);
        $row2['act'] = 'fields_only';

        //this tries to fix the undefined variable
        $row3 = $this->um->econtact_get($uid);
        $ecfields = $this->user_model->getCols('econtact');
        //this fill emptyies with ' ' a space character
        $row3 = blamkify($row3, $ecfields);
        $row3['act'] = 'fields_only';

        $this->template->write_view('nav', 'parts/nav.php', NULL, true);
        $this->template->write('body', form_open('admin/user_update'), true);
        $this->template->write_view('body', 'e.profile.v.php', $row1, false);
        $this->template->write_view('body', 'e.account.v.php', $row2, false);
        $this->template->write_view('body', 'e.econtact.v.php', $row3, false);
        $this->template->write('body', form_submit('submit', "Update"), false);

        $this->template->write('body', form_close(), false);
        $this->template->render();
    }

    function user_update() {
        //print_r($_POST);

        if (empty($_POST))
            redirect("/");
        //$_POST
        $this->load->model('user_model', 'um');
        if (!$this->um->profile_update($_POST) || !$this->um->account_update($_POST) || !$this->um->econtact_update($_POST)) {
            //If this is true then error
            ui_set_error("There was a problem submitting your information");
            redirect('admin/users');
            //exit;
        }
        ui_set_message("Information about " . $_POST['myname2'] . " was successfully updated");
        redirect('admin/users');
        //echo anchor('admin/users', "Return");
    }

    /* This function is responsible for generating the list of users. */
    function users() {
        $this->load->model('user_model', 'um');

        $users = $this->um->allUsers();
        //This for loop adds information about the completeness of the users information
        foreach ($users as $row) {
            $row = get_object_vars($row);
            $uid = $row['id'];
            $row['web_state'] = $this->um->web_state($uid);
            $row['account_complete'] = $this->um->account_complete($uid);
            $row['econtact_complete'] = $this->um->econtact_complete($uid);
            $out[] = $row;
        }

        $data['users'] = $out;

        $this->template->write_view('nav', 'parts/nav.php', NULL, true);
        $this->template->write_view('body', 'admin/m.users.v.php', $data, true);
        $this->template->render();
    }

    /* This function is responsible for vreating the page that lists all the
     * users and the completeness of their information.
     */

    function reports() {
        $this->load->model('user_model', 'um');

        //This is so that the arrays are always defined.
        $web_pending = array();
        $web_approved = array();
        $web_incomplete = array();
        $account_complete = array();
        $account_incomplete = array();
        $econtact_complete = array();
        $econtact_incomplete = array();


        //Should be emoved to the model
        $sql = "SELECT * FROM `users` WHERE type='teamMember' ORDER BY firstname ASC";
        $qry = mysql_query($sql) or die(mysql_error());

        while ($row = mysql_fetch_assoc($qry)) {
            $tid = $row['id'];

            switch ($this->um->web_state($tid)) {
                case "pending":
                    $web_pending[] = $row;
                    break;
                case "approved":
                    $web_approved[] = $row;
                    break;
                case "incomplete":
                    $web_incomplete[] = $row;
                    break;
            }

            if ($this->um->account_complete($tid))
                $account_complete[] = $row;
            else
                $account_incomplete[] = $row;

            if ($this->um->econtact_complete($tid))
                $econtact_complete[] = $row;
            else
                $econtact_incomplete[] = $row;
        }

        $data['web_pending'] = $web_pending;
        $data['web_approved'] = $web_approved;
        $data['web_incomplete'] = $web_incomplete;

        $data['account_complete'] = $account_complete;
        $data['account_incomplete'] = $account_incomplete;

        $data['econtact_complete'] = $econtact_complete;
        $data['econtact_incomplete'] = $econtact_incomplete;

        $this->template->write_view('nav', 'parts/nav.php', NULL, true);
        $this->template->write_view('body', 'admin/a.report.v.php', $data, true);
        $this->template->render();
    }

    /* This function is responsible for the page that provide the ability to
     * Post to the team's facebook page.
     */

    function fb() {
        $this->template->write_view('nav', 'parts/nav.php', NULL, true);
        $this->template->write_view('body', 'admin/a.fb.v.php', null, true);
        $this->template->render();
    }

    /* The following function does the dirty work, and posts the text to the page
     */

    function fb_post() {
        $this->load->helper('mail_helper');
        if (mailer($_POST['to'], $_POST['post'], "")) {
            ui_set_message("Posted<br>" . anchor('http://www.facebook.com/pages/Oakland-ME/Team-2648/146072532332', "See the Post here", array('target' => '_blank')) . "<br>" . anchor('/', "Return to the dashboard"));
            redirect('/admin/fb');
        } else {
            ui_set_error("there was a problem with the post. Please try again later");
            redirect('/admin/fb');
        }
    }

    /* This function is responsible for page that provides the ability to
     * text message the entireteam.
     */

    function sms() {
        //show_error('This page has not yet been implemented');
        $this->template->write_view('nav', 'parts/nav.php', NULL, true);
        $this->template->write_view('body', 'a.sms.v.php', null, true);
        $this->template->render();
    }

    /* This function will do the dirty work and send the message to the selected recipients.
     */

    function sms_send() {
        /* ob_start(); // begin collecting output
          include 'http://team2648.com/OTIS2/admin/smscontacts.php';
          $result = ob_get_clean(); */

        //checks to see if the haystack(string) contains any needles
        function contains($needle, $haystack, $ignorecase=true) {
            if ($ignorecase) {
                $needle = strtolower($needle);
                $haystack = strtolower($haystack);
            }
            return strpos($haystack, $needle) ? true : false;
        }

        //checks to see if the haystack(array) contains any needles
        function arr_contains($needle, $haystack) {
            foreach ($haystack as $value) {
                if (contains($needle, $value))
                    return true;
            }
            return false;
        }

        //removes all the needles from the haystack(array)
        function arr_removealloccur($needle, $haystack) {
            foreach ($haystack as $key => $val) {
                if (contains($needle, $val)) {
                    unset($haystack[$key]);
                }
            }
            return $haystack;
        }

        //removes all the blank entries from the array supplied
        function arr_removeblank($haystack) {
            foreach ($haystack as $key => $val) {
                if (empty($val)) {
                    unset($haystack[$key]);
                }
            }
            return $haystack;
        }

        //Check for valid addresses
        //print_r($addresses);

        $addresses = explode(", ", $_POST['ToText']);
        $needle = "All Team Members";
        if (arr_contains($needle, $addresses))
            $addresses = array_merge($addresses, explode(", ", $_POST['smsCSV']));

        $addresses = arr_removealloccur($needle, $addresses);
        $addresses = arr_removeblank($addresses);

        //break out address from it bounding brackets <>, store it where it came from
        function chopmail($element) {
            if (contains('>', $element))
                return substr($element, strpos($element, "<") + 1, strpos($element, ">") - strlen($element));
            else
                return $element;
        }

        foreach ($addresses as $key => $value) {
            $addresses[$key] = chopmail($value);
        }
        //print_r($addresses);

        $this->load->helper('mail_helper');

        if (isset($addresses)) {
            if (mutlipleMailer($addresses, $_POST['Subject'], $_POST['MessageText'])) {
                $author = $this->session->userdata('username');
                $sql = "INSERT INTO `OIS`.`sms_archive` ( `timestamp`, `author`, `to`, `subject`, `message`)" .
                        " VALUES (
		    '" . mysql_real_escape_string(date("Y-m-d")) . "',
		    '" . mysql_real_escape_string($author) . "',
		    '" . mysql_real_escape_string($_POST['ToText']) . "',
		    '" . mysql_real_escape_string($_POST['Subject']) . "',
		    '" . mysql_real_escape_string($_POST['MessageText']) . "')";
                $qry = mysql_query($sql) or die(mysql_error());
                ui_set_message("Messages Sent successfully");
            }
            else
                ui_set_error("There has been a Serious error");
        }
        redirect('/admin/sms');
    }

    function vocab($function=null, $data=null) {
        $this->quickauth->restrict("admin");

        $this->load->model('vocab_model');
        if ($function == null) {
            $this->template->write_view('nav', 'parts/nav.php', true);
            $this->template->write_view('body', 'admin/vocab.v.php', true);
            $this->template->render();
        } elseif ($function == "add") {
            $this->_edit_vocab($data = "new");
        } elseif ($function == "edit") {
            $this->_edit_vocab($data);
        } elseif ($function == "update") {
            $this->_update_vocab($data);
        }
        //show_error('This page has not yet been implemented');
    }

    function _edit_vocab($bid = null) {
        if ($bid == null)
            redirect("/admin/vocab");
        if ($bid == "new") {
            $data['new'] = "new";
            $data['word'] = "";
            $data['def'] = "";
        } else {
            $data['new'] = "";
            $row = $this->vocab_model->get(str_replace('_', ' ', $bid));
            $data['word'] = $row['word'];
            $data['def'] = $row['def'];
            //$data  array_merge(, $data);
        }
        $this->template->write_view('nav', 'parts/nav.php', true);
        $this->template->write_view('body', 'admin/edit.vocab.v.php', $data, true);
        $this->template->render();
    }

    function _update_vocab($bid = null) {
        if ($bid == "new") {
            if (empty($_POST['word']) || empty($_POST['def'])) {
                ui_set_message("You must enter both a word and a definition");
                redirect("/admin/vocab/add");
            }

            $data['word'] = $_POST['word'];
            $data['def'] = $_POST['def'];

            if ($this->vocab_model->addorupdate($data))
                ui_set_message("Vocab word successfully added.");
            redirect("/admin/vocab");
        }
        else {
            $data['word'] = $_POST['word'];
            $data['def'] = $_POST['def'];

            if ($this->vocab_model->addorupdate($data))
                ui_set_message("Vocab word successfully modified.");
            redirect("/admin/vocab");
        }
    }

    /**
     * This function stands as a way to update the data stored in the vars table
     * forms submitted to this function must have an name and value
     * Optionally they can have:
     *  a msg, which will be displayed to the user
     *  a to, or where to redirect the user - Default for this is /admin
     *
     */
    function io() {
        $this->Io->set($_POST['name'], $_POST['value']);

        if (isset($_POST['msg']))
            ui_set_message($_POST['msg']);

        if (isset($_POST['to']))
            redirect($_POST['to']);
        else
            redirect("/admin");

        //print_r($_POST);
    }

    function _pack() {
        $pieces = array('line1', 'date', 'line2', 'event', 'fm1', 'fm2');
        foreach ($pieces as $key) {
            $pieces[$key] = $this->Io->get($key);
        }
        return $pieces;
    }

    function countdown() {


        $data = $this->_pack();

        $this->template->write_view('nav', 'parts/nav.php', true);
        $this->template->write_view('body', 'admin/countdown.v.php', $data, true);
        $this->template->render();
    }

}

?>
