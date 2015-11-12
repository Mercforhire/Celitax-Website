<?php
$tokenid = "";

$tokenInvalid = false;

if (isset($_GET['tokenid']))
{
    $tokenid = $_GET['tokenid'];

echo <<< TOKENID
        <script type="text/javascript">
            var tokenid = "$tokenid";
        </script>
TOKENID;
}
else
{
    $tokenInvalid = true;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head profile="http://www.w3.org/2005/10/profile">
        <title>Reset Password</title>
        <!-- View Port to fill mobile device screens -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="CSS/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="CSS/bootstrap-theme.min.css"> 
        <!-- Bootstrap Override Styling  -->
        <link rel="stylesheet" href="CSS/bootstrapOverride.css">  
        <!-- Personal Styling CSS file -->
        <link rel="stylesheet" href="CSS/reset.css"> 
        <link rel="apple-touch-icon" sizes="57x57" href="apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
    </head>
    <body>
        <!-- Landing Page, 100% height until user scrolls page -->
        <main>
            <div id="firstGreenSection">   
                <div id='firstGreenSectionBackground'>
                                
                </div>
                <div class="firstGreenSectionHeaderWrap">
                    <div id="greenLogo">
                        <img src="Images/CelitaxGreenLogo.png" width="90" height="33">
                    </div>
                    <div id='containerBottomWhiteBorder'>
                        <a href="./index.html"><div class="homeButton" id="topHomeButton">Home</div></a>
                    </div>
                </div>
<?php
if (!$tokenInvalid)
{
echo <<< NORMAL
                <div class="firstSectionContentWrap">
                    <div id="resetLabel">Reset Password</div>
                    </br>
                    </br>
                    <div class="textFieldLabel">Please Enter New Password</div>
                    <input type="password" class="passwordField" id = "password" name = "password" placeholder="Password"/>
                    </br>
                    </br>
                    <div class="textFieldLabel">Please Re-Enter New Password</div>
                    <input type="password" class="passwordField" id = "password2" name = "password2" placeholder="Repeat Password"/>
                    </br>
                    <div class="textFieldLabel" id="errorLabel">Please make sure the password is at least 6 characters long and both fields match.</div>
                    <div class="textFieldLabel" id="successLabel">Great, the password has been changed!</div>
                    <div class="textFieldLabel" id="errorLabel2">Password Reset Session Expired or Invalid</div>
                    </br>
                    </br>
                    <div id="change_password_button" onclick="submitNewPassword()">
                        Change Password
                    </div>
                </div>
NORMAL;
}
else
{
echo <<< ERROR
                <div class="firstSectionContentWrap2">
                    <div id="resetLabel">Password Reset Session Invalid</div>
                </div>
ERROR;
}
?>
                <div class="firstSectionContentWrap3">
                    <div id="resetLabel">Password has been changed.</div>
                </div>
            </div>
        </main>
        <footer>
            <div class="col-sm-6 col-xs-12 hidden-sm hidden-md hidden-lg">
                <div class="socialMediaWrap" id="socialMediaWrapMobile">
                    <a href="https://www.facebook.com/CeliTax-421212698083887/timeline/" target="_blank"><img class="socialImg" src="Images/facebook_green.png" width="40"></a>
                    <a href="https://twitter.com/CeliTax" target="_blank"><img class="socialImg" src="Images/twitter_green.png" width="40"></a>
                </div>
                <a href="./index.html"><div class="homeButton" id="bottomHomeButton">Home</div></a>
            </div>
            
            <div class="col-sm-6 col-xs-12 hidden-sm hidden-md hidden-lg">
                <div class="copyRightText" id="copyRightTextMobile">Copyright 2015 CeliTax. All rights reserved.</div>
            </div>
            
            <div class="col-sm-6 col-xs-12 hidden-xs">
                <div class="copyRightText">Copyright 2015 CeliTax. All rights reserved.</div>
            </div>
            
            <div class="col-sm-6 col-xs-12 hidden-xs">
                <div class="socialMediaWrap">
                    <a href="https://www.facebook.com/CeliTax-421212698083887/timeline/" target="_blank"><img class="socialImg" src="Images/facebook_green.png" width="40"></a>
                    <a href="https://twitter.com/CeliTax" target="_blank"><img class="socialImg" src="Images/twitter_green.png" width="40"></a>
                </div>
                <a href="./index.html"><div class="homeButton" id="bottomHomeButton">Home</div></a>
            </div>
        </footer>
        
        <!-- Javascript Imports -->
        <!-- Google jQuery Import -->
        <script src="JS/jQuery.js"></script>
        <!-- Local bootstrap jQuery Import -->
        <script src="JS/bootstrap.js"></script>
        <script src="JS/userJS.js"></script>
    </body>
</html>