<?php
require_once 'DbHandler.php';

if (isset($_GET['email']))
{
    $email = $_GET['email'];

    $db = new DbHandler();

    $db->addEmailAddressToTable($email);

    echo ADD_TO_MAILING_SUCCESS;
}
else
{
    echo ADD_TO_MAILING_FAILURE;
}

?>