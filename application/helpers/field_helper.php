<?php

//this fill emptyies with ' ' a space character
function blamkify($row, $fields) {
    //this fill emptyies with ' ' a space character
    if (!is_array($row) || count($row) < count($fields)) {
        if (!is_array($row)) {
            $row = array(); //should empty row ??
            foreach ($fields as $val)
                $row[$val] = '';
        }
        else
            foreach ($fields as $val)
                if (!isset($row[$val]))
                    $row[$val] = '';
    }
    return $row;
}

function banchor($uri, $title)
{
    return anchor($uri, $title, 'class="button"');
}

?>
