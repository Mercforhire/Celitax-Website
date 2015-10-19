<?php
require_once 'API/EmailHandler.php';

$emailer = new EmailHandler();

$name = $email = $comments = "";
$sent_comment = "no";

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['comments']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comments = $_POST['comments'];

    if ( strlen($name) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($comments) )
    {
        $emailer->notifyWebsiteComment($name, $email, $comments);

        $sent_comment = "yes";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head profile="http://www.w3.org/2005/10/profile">
        <title>CeliTax</title>
        <!-- View Port to fill mobile device screens -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="CSS/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="CSS/bootstrap-theme.min.css"> 
        <!-- Bootstrap Override Styling  -->
        <link rel="stylesheet" href="CSS/bootstrapOverride.css">  
        <!-- Personal Styling CSS file -->
        <link rel="stylesheet" href="CSS/css.css"> 
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
                <div id='firstSectionBackgroundGradient'>
                                
                </div>
                <div class="firstGreenSectionHeaderWrap">
                    <div id='containerBottomWhiteBorder'>
                        <a href="https://twitter.com/CeliTax" target="_blank"><img class="socialImgTop" src="Images/twitter.png" width="30"></a>
                        <a href="https://www.facebook.com/CeliTax-421212698083887/timeline/" target="_blank"><img class="socialImgTop" src="Images/facebook.png" width="30"></a>
                        <div class="firstSectionButton" id="aboutButton" onclick="aboutClicked()">About</div>
                        <div class="firstSectionButton" id='contactUsButton' onclick="contactClicked()">Contact</div>
                    </div>
                </div>
                <div class="firstSectionContentWrap">
                    <img src="Images/celitaxTitleImage.png" width="204" height="75">
                    </br>
                    </br>
                    <div class="firstSectionTitle">
                        CeliTax is a simple, easy-to-use tax tool designed specifically for Celiacs.
                    </div>
                    </br>
                    <div class="firstSectionTitle2">
                        The stress-free way to calculate your Gluten Free (GF) tax claim!
                    </div>
                    </br>
                    <div class="appLinkWrapOuter">
                        <div class="appLinkWrapInner">
                            <div class="appleApp">
                                <img src="Images/appleAppDark.png" width="87" height="32">
                            </div>
                            <div class="googleApp">
                                <img src="Images/googleAppDark.png" width="87" height="32">
                            </div>
                            </br>
                            </br>
                            <div class="firstSectionSmallText" id="comingSoonText">
                                Coming soon
                            </div>
                            </br>
                            <div class="firstSectionSmallText" id="availableInFallText">
                                Available fall 2015
                            </div>
                        </div>
                    </div>
                </div>
                <div class="firstSectionArrowWrap hidden-xs">
                    <div class="scrollButtonOutline">
                        <div class="scrollButton">
                            <img src="Images/downArrow.png" width="23" height="25">
                        </div>
                    </div>
                </div>
            </div>
        </main>
    
        <div class="secondSectionWrap">
            <div class="container">
                <!-- Bootstrap Empty Col area to take up space for large screen widths -->
                <div class="col-md-1 col-sm-0 col-xs-0"> </div>
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <div class="secondSectionContentContainer">
                        <div class="secondSectionTextContainer">
                            <div class="secondSectionTitle">
                                Simplify life. Pay less tax.
                            </div>
                            </br>
                            <div class="secondSectionAboutParagraph">
                                You already have enough to worry about, keeping track of hundreds of receipts should not be one of them. Forget manual calculations or time consuming spreadsheets. Let us help you maximize your tax return with CeliTax.
                            </div>
                            </br>
                            <div class="secondSectionAboutParagraph">
                                Most Celiacs are unaware of this beneficial tax claim, get the facts and try CeliTax today!
                            </div>
                            </br>
                            </br>
                            <b>Verify your eligibility below</b>
                            </br>
                            <a href="http://www.cra-arc.gc.ca/gluten-free/" target="_blank"><img class="flag" src="Images/CDN.png" width="60" height="29"></a>
                            <a href="https://celiac.org/celiac-disease/resources/tax-deductions/" target="_blank"><img class="flag" src="Images/USA.png" width="60" height="29"></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <div class="secondSectionContentContainer" id="appScreenShot">
                        <img class="aboutImage" src="Images/loginScreen.png" width="300">
                    </div>
                </div>
                <!-- Bootstrap Empty Col area to take up space for large screen widths -->
                <div class="col-md-1 col-sm-0 col-xs-0"> </div>
            </div>
        </div>

        <div class="thirdSectionWrap">
            <div id='thirdGreenSectionBackground'>

            </div>
            <div id='thirdGreenSectionGradient'>

            </div>
            <div class="container">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="featureContainerOuter">
                        <div class="featureContainerInner">
                            <div class="featureTextWrap">
                                <img class="imgCenter" src="Images/photo.png" width="90" height="90">
                                </br>
                                <div class="featuresTitle">Digitalize</div>
                                Digital receipts - go paperless 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="featureContainerOuter">
                        <div class="featureContainerInner">
                            <div class="featureTextWrap">     
                                <img class="imgCenter" src="Images/list.png" width="90" height="90">
                                </br>
                                <div class="featuresTitle">Allocate</div>
                                Keep all purchases organized in custom GF categories 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="featureContainerOuter">
                        <div class="featureContainerInner">
                            <div class="featureTextWrap">
                                <img class="imgCenter" src="Images/Save.png" width="90" height="90">
                                </br>
                                <div class="featuresTitle">Store</div>
                                Easy storage solution for every receipt. Quickly review/download receipts anytime 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="featureContainerOuter">
                        <div class="featureContainerInner">
                            <div class="featureTextWrap">
                                <img class="imgCenter" src="Images/Calculator.png" width="90" height="90">
                                </br>
                                <div class="featuresTitle">Calculate</div>
                                Simple one-click tax calculation
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    
        <div class="forthSectionWrap">
            <div class="container">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="pagesContainerOuter">
                        <img class="pagesImage" src="Images/receiptViewScreen.png" width="260">
                        <div class="pagesText">
                            After you shop, snap a photo of your receipt and allocate your purchases to customized GF categories.
                        </div>
                    </div>
                    <div class="pagesContainerOuterSmall">
                        <img class="pagesImage" src="Images/receiptViewScreen.png" width="189" height="363">
                        <div class="pagesText">
                            After you shop, snap a photo of your receipt and allocate your purchases to customized GF categories.
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="pagesContainerOuter">
                        <img class="pagesImage" src="Images/accountScreen.png" width="260">
                        <div class="pagesText">
                            See a visual breakdown of all GF purchases.
                        </div>
                    </div>  
                    <div class="pagesContainerOuterSmall">
                        <img class="pagesImage" src="Images/accountScreen.png" width="189" height="363">
                        <div class="pagesText">
                            See a visual breakdown of all GF purchases.
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="pagesContainerOuter">
                        <img class="pagesImage" src="Images/yearSummaryScreen.png" width="260">
                        <div class="pagesText">
                            One-click tax claim calculation!
                        </div>
                    </div>
                    <div class="pagesContainerOuterSmall">
                        <img class="pagesImage" src="Images/yearSummaryScreen.png" width="189" height="363">
                        <div class="pagesText">
                            One-click tax claim calculation!
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="fifthSectionWrap">
            <div id='fifthSectionBackground'>

            </div>
            <div id='fifthSectionBackgroundGradient'>

            </div>
            <div class="fifthSectionContentWrap">
                <img src="Images/celitaxTitleImage.png" width="204" height="75">
                </br>
                </br>
                <div class="appLinkWrapOuter">
                    <div class="appLinkWrapInner">
                        <div class="appleApp">
                            <img src="Images/appleAppDark.png" width="87" height="32">
                        </div>
                        <div class="googleApp">
                            <img src="Images/googleAppDark.png" width="87" height="32">
                        </div>
                        </br>
                        </br>
                        <div class="firstSectionSmallText" id="comingSoonText">
                            Coming soon
                        </div>
                        </br>
                        <div class="firstSectionSmallText" id="availableInFallText">
                            Available fall 2015
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="sixthSectionWrap">
            <div id='sixthSectionBackground'>

            </div>
            <div id='sixthSectionBackgroundGradient'>

            </div>
            <div class="sixthSectionContentWrap">
                    <b>Who I am:</b>
                    </br>
                    My name is Justin Gravelle, a 25-year-old accountant from Toronto, Canada who happened to fall in love with a beautiful woman diagnosed with Celiac disease. I have witnessed first hand the day-to-day hardships that a Celiac faces. Seeing her suffer on a regular basis had taken its toll. I felt helpless, as all I could do was comfort her. I needed to do more for her!
                    </br></br>
                    When she had mentioned the Gluten-Free tax claim, I instantly became intrigued. Upon further research, very few Celiacs were taking advantage of this hidden gem, and for obvious reasons. It is one giant pain in the butt! Nobody has the time or the patience for complicated spreadsheets and tedious calculations. It hardly seemed like a real "benefit" at all. With that said, CeliTax was born.
                    </br></br>
                    I promised her I would fix this issue, so myself, as well as my technical team worked hard to bring all of you a much simpler, easier way to get the tax deduction you deserve!
                    </br></br>
                    Cheers.
                    </br></br>
                    -Justin Gravelle
                    </br></br>
                    <i>CEO/Founder</i>
            </div>
        </div>
    
        <div class="contactSectionWrap">
            <div class="col-sm-6 col-xs-12">
                <div class="contactInfoWrap">
                    <div class="contactInfoContainer">
                        <img src="Images/celitaxTitleImage.png" width="204" height="75">
                        </br>
                        </br>
                        <div class="contactInfoText">
                            CeliTax
                            </br>
                            5-455 Claridge Rd.
                            </br>
                            Burlington, Ontario
                            </br>
                            L7N 2S1
                            </br>
                            (905) 599-0411
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6 col-xs-12">
                <div class="contactFieldsWrap">
                    <div class="contactFieldsContainer">
                        <form method='post' id='comment_form' action='index.php'>
                            <input type="text" id="nameField" size="100" name = "name" placeholder="Name"/>
                            <input type="text" id="emailField" size="100" name = "email" placeholder="Email address"/>
                            <TEXTAREA id="commentField" name="comments" rows="20" cols="100" placeholder="Message"></TEXTAREA>
                            </br>
                            </br>
                            <div id="submit_button" onclick="submitComment()">
                                Submit
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
        <footer>
            <div class="col-sm-6 col-xs-12 hidden-sm hidden-md hidden-lg">
                <div class="socialMediaWrap" id="socialMediaWrapMobile">
                    <a href="https://www.facebook.com/CeliTax-421212698083887/timeline/" target="_blank"><img class="socialImg" src="Images/facebook.png" width="40"></a>
                    <a href="https://twitter.com/CeliTax" target="_blank"><img class="socialImg" src="Images/twitter.png" width="40"></a>
                </div>
                <div class="footerLinks" id="footerLinksMobile">
                    <ul class="FooterMenu">
                        <li onclick="contactClicked()">Contact</li>
                        <li onclick="aboutClicked()">About</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-sm-6 col-xs-12 hidden-sm hidden-md hidden-lg">
                <div class="copyRightText" id="copyRightTextMobile">Copyright 2015 CeliTax. All rights reserved.</div>
            </div>
            
            <div class="col-sm-6 col-xs-12 hidden-xs">
                <div class="copyRightText">Copyright 2015 CeliTax. All rights reserved.</div>
            </div>
            
            <div class="col-sm-6 col-xs-12 hidden-xs">
                <div class="socialMediaWrap">
                    <a href="https://www.facebook.com/CeliTax-421212698083887/timeline/" target="_blank"><img class="socialImg" src="Images/facebook.png" width="40"></a>
                    <a href="https://twitter.com/CeliTax" target="_blank"><img class="socialImg" src="Images/twitter.png" width="40"></a>
                </div>
                <div class="footerLinks">
                    <ul class="FooterMenu">
                        <li onclick="contactClicked()">Contact</li>
                        <li onclick="aboutClicked()">About</li>
                    </ul>
                </div>
            </div>
        </footer>
        
        <!-- Javascript Imports -->
        <!-- Google jQuery Import -->
        <script src="JS/jQuery.js"></script>
        <!-- Local bootstrap jQuery Import -->
        <script src="JS/bootstrap.js"></script>
        <!-- User jQuery Import -->
        <script src="JS/userJS.js"></script>
    </body>
</html>