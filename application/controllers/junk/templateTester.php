<?php

class TemplateTester extends Controller
{

    function index()
    {
        //regions

//    'title',
//    'header',
//    'nav',
//    'body',
//    'footer',

        //$this->template->write($region, $content);
	$this->template->render();
    }
}

?>
