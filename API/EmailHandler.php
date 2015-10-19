<?php

 # Include the Autoloader (see "Libraries" for install instructions)
require 'vendor/autoload.php';
use Mailgun\Mailgun;

/**
 * Handling sending emails
 *
 * @author Leon Chen
 */
class EmailHandler {
 
    # Instantiate the client.
    private $mgClient;
    private $domain;
 
    function __construct() {     
        $this->mgClient = new Mailgun('key-01zs3m0dem69g1gxdmikjyeevl45ms81');
        $this->domain = 'sandbox78922.mailgun.org';
    }
    
    public function notifyWebsiteComment($name,$email,$comments) {
        $admin_email = "info@celitax.ca";
        $admin_email2 = "leon.chen@celitax.ca";
        
        $result = $this->mgClient->sendMessage("$this->domain",
                  array('from'    => "$email",
                        'to'      => "Admin <$admin_email>",
                        'subject' => "Celitax Website Comment from $name",
                        'text'    => "$comments"));
        
        $result2 = $this->mgClient->sendMessage("$this->domain",
                  array('from'    => "$email",
                        'to'      => "Admin <$admin_email2>",
                        'subject' => "Celitax Website Comment from $name",
                        'text'    => "$comments"));
        
        return $result;
    }
}

?>
