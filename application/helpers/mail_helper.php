<?php

function mailer($to, $subject, $body) {
    //include "vars.php";
    $ci = get_instance();
    $bfig = $ci->config->item('bfig');

    $headers = "From: " . $bfig['sysabrev'] . "@team2648.com\r\n" .
            "X-Mailer: php";
    return (mail($to, $subject, $body, $headers));
}

function mutlipleMailer($addresses, $subject, $body) {
    $noerror = true;
    foreach ($addresses as $addy) {
//		echo $addy;
        if (mailer($addy, $subject, $body) != true)
            $noerror = false;
    }
    return $noerror;
}

?>
