<?php
    function fix_string($conn, $str_val)
    {
        return htmlentities($conn->quote($str_val));
    }
    function fix_wquote_string($conn, $str_val)
    {
        return htmlentities($str_val);
    }

    function chk_empty($fields){
        $is_invalid = false;
        foreach ($fields as $field)
        {
            if (empty($_POST[$field]))
            {
                $is_invalid = true;
            }
        }
        return $is_invalid;
    }
?>