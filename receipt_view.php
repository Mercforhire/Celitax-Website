<?php

$loadingData = true;

$receiptData = NULL;

if (isset($_GET['email']) && isset($_GET['year']) && isset($_GET['allreceipts']))
{
    $email = $_GET['email'];
    $year = $_GET['year'];
    $allReceipts = $_GET['allreceipts'];
    
    if ($allReceipts != 1)
    {
        if (isset($_GET['receiptIDs']))
        {
            $receiptIDsString = $_GET['receiptIDs'];
echo <<< RECEIPTIDS
        <script type="text/javascript">
            var receiptIDs = "$receiptIDsString";
        </script>
RECEIPTIDS;
        }
    }
    
    //save these variables to as JS variable and perform an Ajax call to getReceiptsInfo.php to get the data
echo <<< EMAIL
        <script type="text/javascript">
            var email = "$email";
        </script>
EMAIL;
echo <<< YEAR
        <script type="text/javascript">
            var year = "$year";
        </script>
YEAR;
echo <<< ALLRECEIPTS
        <script type="text/javascript">
            var allReceipts = "$allReceipts";
        </script>
ALLRECEIPTS;
    
    //after retrieving the receipts data, send it back to this page via a POST request to 'refresh' this page
    //and display the data
}
else if (isset($_POST['email']) && isset($_POST['year']) && isset($_POST['receiptInfos']))
{
    $loadingData = false;
     
    $email = $_POST['email'];
    
    $year = $_POST['year'];
    
    $receiptData = $_POST['receiptInfos'];
    
        //save these variables to as JS variable and perform an Ajax call to getReceiptsInfo.php to get the data
echo <<< EMAIL
        <script type="text/javascript">
            var email = "$email";
        </script>
EMAIL;
echo <<< YEAR
        <script type="text/javascript">
            var year = "$year";
        </script>
YEAR;
}

?>

<!DOCTYPE html>
<html lang="en">
    <head profile="http://www.w3.org/2005/10/profile">
        <title>Receipt View</title>
        <!-- View Port to fill mobile device screens -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="CSS/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="CSS/bootstrap-theme.min.css"> 
        <!-- Bootstrap Override Styling  -->
        <link rel="stylesheet" href="CSS/bootstrapOverride.css">  
        <!-- Personal Styling CSS file -->
        <link rel="stylesheet" href="CSS/receipt_view.css">
        
        <!-- Core CSS file -->
        <link rel="stylesheet" href="CSS/photoswipe.css"> 

        <!-- Skin CSS file (styling of UI - buttons, caption, etc.)
             In the folder of skin CSS file there are also:
             - .png and .svg icons sprite, 
             - preloader.gif (for browsers that do not support CSS animations) -->
        <link rel="stylesheet" href="CSS/default-skin/default-skin.css"> 

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
            <div class="firstGreenSectionHeaderWrap">
                <div id="greenLogo">
                    <img src="Images/CelitaxGreenLogo.png" width="90" height="33">
                </div>
                <div id='containerBottomWhiteBorder'>
                    <a href="./index.html"><div class="homeButton" id="topHomeButton">Home</div></a>
                </div>
            </div>
<?php
if (!$loadingData && $receiptData != NULL)
{
echo <<< TABLEHEAD
                <div class="firstSectionContentWrap">
                <div class='firstSectionContent'>
                    <div id="titleLabel">Receipt View</div>
                    </br>
                    <div id="subtitleLabel">Select any or all receipts to download for your tax records.</div>
                    <div class="tableRow">
                        <div class="selectAllLabel">Select All</div>
                    </div>
                    <div class="tableRow">
                        <input id="checkbox" type="checkbox" name="select_all" value="all"/>
                        <div class="dateTitleLabel">Upload Date</div>
                        <div class="timeTitleLabel">Upload Time</div>
                    </div>
TABLEHEAD;

$dataArray = json_decode($receiptData, true);

echo <<< CREATE_ARRAY
<script type="text/javascript">
    var receiptIDs = [];
    var receiptImagesURLs = [];
    var receiptImagesDimensions = [];
</script>
CREATE_ARRAY;

for ($i = 0; $i < count($dataArray); $i++)
{
    $rowDictionary = $dataArray[$i];
    
    $dateAndTime = $rowDictionary['date_created'];
    
    $date = date('d-m-Y', strtotime($dateAndTime));
    $time = date('h:i A', strtotime($dateAndTime));
    
echo <<< CREATE_ARRAY
<script type="text/javascript">
    var receiptImagesURLForRow = [];
</script>
CREATE_ARRAY;

    $receiptURLs = $rowDictionary['imageURLs'];
    
    foreach ($receiptURLs as $url)
    {
echo <<< ADD_ITEM
<script type="text/javascript">
    receiptImagesURLForRow.push('$url');
</script>
ADD_ITEM;
    }

    $receiptImageDimensions = $rowDictionary['imageDimensions'];
    
    foreach ($receiptImageDimensions as $dimension)
    {
        if (count($dimension) == 2)
        {
echo <<< ADD_ITEM
<script type="text/javascript">
    var receiptImagesDimensionsForRow = [];
    receiptImagesDimensionsForRow.push('$dimension[0]');
    receiptImagesDimensionsForRow.push('$dimension[1]');
</script>
ADD_ITEM;
        }
        
echo <<< ADD_ITEM
<script type="text/javascript">
    receiptImagesDimensions.push(receiptImagesDimensionsForRow);
</script>
ADD_ITEM;

    }
    
    $receiptID = $rowDictionary['identifier'];
    
echo <<< ADD_ITEM
<script type="text/javascript">
    receiptIDs.push('$receiptID');
    receiptImagesURLs.push(receiptImagesURLForRow);
</script>
ADD_ITEM;
    
echo <<< ROW
                    <div class="tableRow">
                        <input id="checkbox" type="checkbox" name="checkbox-$i" value="all"/>
                        <div class="timeLabel" >$date</div>
                        <div class="timeLabel2">$time</div>
                        <div class="viewButton" id="viewButton-$i">View</div>
                    </div>
ROW;
}
               
echo <<< TABLEBOTTOM
                    <div class="tableFooter">
                        <div id="downloadButton">Download Selected</div>
                    </div>
                </div>
            </div>
TABLEBOTTOM;
}
else
{
echo <<< LOADINGDATA
            <div class="firstSectionContentWrap2">
                <div id="titleLabel">Loading Data...</div>
            </div>
LOADINGDATA;
}
?>
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
        
        <!-- Local Custom Import -->
        <script src="JS/receipt_view.js"></script>
        
        <!-- Core JS file -->
        <script src="JS/photoswipe.min.js"></script> 

        <!-- UI JS file -->
        <script src="JS/photoswipe-ui-default.min.js"></script> 
        
        <!-- Root element of PhotoSwipe. Must have class pswp. -->
        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

            <!-- Background of PhotoSwipe. 
                 It's a separate element as animating opacity is faster than rgba(). -->
            <div class="pswp__bg"></div>

            <!-- Slides wrapper with overflow:hidden. -->
            <div class="pswp__scroll-wrap">

                <!-- Container that holds slides. 
                    PhotoSwipe keeps only 3 of them in the DOM to save memory.
                    Don't modify these 3 pswp__item elements, data is added later on. -->
                <div class="pswp__container">
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                </div>

                <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                <div class="pswp__ui pswp__ui--hidden">

                    <div class="pswp__top-bar">

                        <!--  Controls are self-explanatory. Order can be changed. -->

                        <div class="pswp__counter"></div>

                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                        <button class="pswp__button pswp__button--share" title="Share"></button>

                        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                        <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                        <!-- element will get class pswp__preloader--active when preloader is running -->
                        <div class="pswp__preloader">
                            <div class="pswp__preloader__icn">
                                <div class="pswp__preloader__cut">
                                    <div class="pswp__preloader__donut"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                        <div class="pswp__share-tooltip"></div> 
                    </div>

                    <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                    </button>

                    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                    </button>

                    <div class="pswp__caption">
                        <div class="pswp__caption__center"></div>
                    </div>

                </div>

            </div>

        </div>
    </body>
</html>