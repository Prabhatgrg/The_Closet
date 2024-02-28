<?php

// Get User ID
function get_user_id()
{
    if (isset($_SESSION['user_id'])) :
        return $_SESSION['user_id'];
    endif;

    return null;
}

function is_login()
{
    if (isset($_SESSION['user_id'])) :
        return true;
    else :
        return false;
    endif;
}
