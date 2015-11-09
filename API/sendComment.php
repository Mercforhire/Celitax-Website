<?php

require_once 'EmailHandler.php';

$emailer = new EmailHandler();

$name = $email = $comments = "";

if ( isset($_POST['name']) && isset($_POST['email']) && isset($_POST['comments']) )
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comments = $_POST['comments'];

    if ( strlen($name) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($comments) > 0 )
    {
        $emailer->notifyWebsiteComment($name, $email, $comments);

        echo SEND_COMMENT_SUCCESS;
    }
    else
    {
        echo SEND_COMMENT_INVALID_EMAIL;
    }
}
else
{
    echo SEND_COMMENT_FAILURE;
}

?>