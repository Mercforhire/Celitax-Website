<?php

include_once 'Config.php';
/**
 * Class to handle all db operations
 * This class will have CRUD methods for database tables
 *
 * @author Leon Chen
 */

class DbHandler
{

    private $conn;

    function __construct()
    {
        require_once 'DbConnect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    /* ------------- `email_addresses` table method ------------------ */

    public function isEmailExists($email)
    {
        $stmt = $this->conn->prepare("SELECT email_address FROM `celiqvpx_mailing_list`.`email_addresses` WHERE email_address = ?;");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }

    public function addEmailAddressToTable($email)
    {
        if ($this->isEmailExists($email))
        {
            return true;
        }
        
        $stmt = $this->conn->prepare("INSERT INTO `celiqvpx_mailing_list`.`email_addresses`
                                        (`email_address`) VALUES (?);");
        $stmt->bind_param("s", $email);
        if ($stmt->execute())
        {
            $stmt->close();
            return true;
        }
        else
        {
            $stmt->close();
            return false;
        }
    }
}

?>