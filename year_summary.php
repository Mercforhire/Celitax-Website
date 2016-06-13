<?php

$loadingData = true;

$reportData = NULL;

if (isset($_GET['email']) && isset($_GET['reportid']))
{
    $email = $_GET['email'];
    $reportid = $_GET['reportid'];
    
    //save these variables to as JS variable and perform an Ajax call to getDataReport.php to get the data
echo <<< EMAIL
        <script type="text/javascript">
            var email = "$email";
        </script>
EMAIL;
echo <<< REPORTID
        <script type="text/javascript">
            var reportid = "$reportid";
        </script>
REPORTID;
    
    //after retrieving the receipts data, send it back to this page via a POST request to 'refresh' this page
    //and display the data
}
else if (isset($_POST['data']))
{
    $loadingData = false;
    
    $reportData = $_POST['data'];
    
    //convert $reportData to a dictionary
    $dataDictionary = json_decode($reportData, true);
    
    $taxyear = $dataDictionary['TaxYear'];
    
    $totalSavings = $dataDictionary['TotalSaving'];
    
    $totalSavings = number_format($totalSavings, 2, '.', '');
    
    $summaryRows = $dataDictionary['SummaryRows'];
    
    $categories = $dataDictionary['Categories'];
}

function findCategoryOfID($categoryID, $categories)
{
    if ($categoryID == NULL || $categories == NULL)
    {
        return NULL;
    }
    
    foreach ($categories as $category)
    {
        if ($category['CategoryID'] == $categoryID)
        {
            return $category;
        }
    }
    
    return NULL;
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
        <link rel="stylesheet" href="CSS/year_summary.css">

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
                    <a href="./index.html"><img src="Images/CelitaxGreenLogo.png" width="90" height="33"></a>
                </div>
                <div id='containerBottomWhiteBorder'>
                    <a href="./index.html"><div class="homeButton" id="topHomeButton">Home</div></a>
                </div>
            </div>
            <div class="firstSectionContentWrap">
                
<?php
if (!$loadingData && $dataDictionary != NULL)
{
echo <<< NORMAL
            <div class='firstSectionContent'>
                    </br>
                    <div id='titleLabel'>Your $taxyear Savings:</div>
                    <div id='amountLabel'>$$totalSavings</div>
                    </br>
                    <div id='viewDetailsButton' onclick="viewDetailsClicked()">View Details</div>
                </div>
            </div>
NORMAL;
}
else if ($loadingData && $dataDictionary == NULL)
{
echo <<< LOADING
            <div class='firstSectionContent'>
                    </br>
                    <div id='titleLabel'>Loading Data...</div>
            </div>
LOADING;
} 
else if (!$loadingData && $reportData != NULL && $dataDictionary == NULL)
{
echo <<< ERROR
            <div class='firstSectionContent'>
                    </br>
                    <div id='titleLabel'>Data Report Expired or Invalid</div>
            </div>
ERROR;
}
?>
            <div class="secondSectionContentWrap">
                <div class='secondSectionContent'>
                    <div id="chartContainer"></div>
                    <div class="tableHeader">
                        <div class="columnLabel1">GF Savings</div>
                        <div class="columnLabel2">Total Avg.<br/>NGF Cost</div>
                        <div class="columnLabel3">Total Spent</div>
                    </div>
<?php
if (!$loadingData && $summaryRows != NULL)
{
echo <<< DATAPOINTS
        <script type="text/javascript">
            var dataPoints = [];
        </script>
DATAPOINTS;
    $i = 0;
    foreach ($summaryRows as $row)
    {
        $categoryID = $row['CategoryID'];
        
        $thisCategory = findCategoryOfID($categoryID, $categories);

        $colorString = $thisCategory['Color'];
       
        $name = $row['Name'];

        $GFSavings = $row['GFSavings'];
        $GFSavings = number_format($GFSavings, 2, '.', '');

        $totalAvg = $row['TotalAvg'];
        $totalAvg = number_format($totalAvg, 2, '.', '');

        $totalSpent = $row['TotalSpent'];
        $totalSpent = number_format($totalSpent, 2, '.', '');
        

echo <<< ADD_ROW
                    <div class="tableRow">
                        <div class="categoryColorBox" style="background:$colorString" id="categoryColorBox-$i"></div>
                        <div class="categoryNameLabel" id="categoryNameLabel-$i">$name</div>
                        <div class="gfSavings" id="gfSavings-$i"><b>$$GFSavings</b></div>
                        <div class="totalAvgLabel" id="totalAvgLabel-$i"><b>$$totalAvg</b></div>
                        <div class="totalSpentLabel" id="totalSpentLabel-$i"><b>$$totalSpent</b></div>
                    </div>
                    <script type="text/javascript">
                        var dataPoint = {y: $totalSpent, legendText: "$name", indexLabel: "$name", color: "$colorString"};
                        dataPoints.push(dataPoint);
                    </script>
ADD_ROW;
    }
}                 
?>
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
        <script type="text/javascript" src="/JS/canvasjs.js"></script>
        <script src="JS/year_summary.js"></script>
    </body>
</html>