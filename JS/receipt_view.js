var selectAllChecked = 0;
var selectedReceiptIDs = [];

$(document).ready(function()
{    
    if (typeof email != 'undefined' && typeof year != 'undefined' && typeof allReceipts != 'undefined')
    {
        var xmlhttp = new XMLHttpRequest();

        var data = new FormData();

        data.append('email', email);
        data.append('year', year);
        data.append('allReceipts', allReceipts);
        
        if (typeof receiptIDs != 'undefined')
        {
            data.append('receiptIDs', receiptIDs);
        }
        
        xmlhttp.onreadystatechange = function()
        {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                var response = xmlhttp.responseText;

                post("receipt_view.php", {'email': email, 'year': year, 'receiptInfos': response});
            }
        };

        xmlhttp.open("POST", "https://www.crave-n-save.ca/crave/Celitax-WebAPI/v1/getReceiptsInfo.php", true);
        xmlhttp.send(data);
    }
});

function post(path, params, method) 
{
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for (var key in params) 
    {
        if (params.hasOwnProperty(key)) 
        {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }

    var button = document.createElement("input");
    button.setAttribute('type', "submit");
    form.appendChild(button);
    document.body.appendChild(form);
    form.submit();
}

$( "div[id^='viewButton']" ).on('click', function() 
{
    var buttonName = this.id;
    var parts = buttonName.split('-');
    var buttonIndex = parts[1];
    
    console.log("Pressed View:" + buttonIndex);
           
    var pswpElement = document.querySelectorAll('.pswp')[0];

    // build items array
    var items = [];
    
    var urls = receiptImagesURLs[buttonIndex];
    
    var dimension = receiptImagesDimensions[buttonIndex];
    
    for (i = 0; i < urls.length; i++) 
    {
        var url = urls[i];
        
        console.log(url);
        console.log(dimension);
        
        var item = {'src' : url, 'w' : dimension[0], 'h' : dimension[1]};
        
        items.push(item);
    }

    // define options (if needed)
    var options = {
        // optionName: 'option value'
        // for example:
        index: 0 // start at first slide
    };

    // Initializes and opens PhotoSwipe
    var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
    gallery.init(); 
});

$( "div[id='downloadButton']" ).on('click', function() 
{
    if (selectAllChecked || selectedReceiptIDs.length > 0)
    {
        var xmlhttp = new XMLHttpRequest();

        var data = new FormData();

        data.append('email', email);
        data.append('year', year);
        
        console.log(email);
        console.log(year);

        if (selectAllChecked == false)
        {
            selectedReceiptIDsString = '';

            for (i = 0; i < selectedReceiptIDs.length; i++)
            {
                var selectedReceiptID = selectedReceiptIDs[i];
                
                if (i == 0)
                {
                    selectedReceiptIDsString = selectedReceiptID;
                }
                else
                {
                    selectedReceiptIDsString = selectedReceiptIDsString + ',' + selectedReceiptID;
                }
            }

            data.append('receiptIDs', selectedReceiptIDsString);
            console.log(selectedReceiptIDsString);
        }
        else
        {
            selectedReceiptIDsString = '';

            for (i = 0; i < receiptIDs.length; i++)
            {
                var receiptID = receiptIDs[i];

                selectedReceiptIDsString = selectedReceiptIDsString + ',' + receiptID;
            }

            data.append('receiptIDs', selectedReceiptIDsString);
            console.log(selectedReceiptIDsString);
        }

        xmlhttp.onreadystatechange = function()
        {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                var response = xmlhttp.responseText;
                
                if (response != 'ERROR')
                {
                    console.log('Download link: ' + response);
                
                    download(response);
                }
                else
                {
                    console.log('Download link error!');
                }
            }
        };

        xmlhttp.open("POST", "https://www.crave-n-save.ca/crave/Celitax-WebAPI/v1/generateReceiptImagesZip.php", true);
        xmlhttp.send(data);
    }
});

$("input[type='checkbox']").change(function() 
{
    var checkboxName = this.name;
    
    if (checkboxName == 'select_all')
    {
        if(this.checked)
        {
            selectAllChecked = 1;
            
            console.log('Selected All receipts:');
            console.log(receiptIDs);
        }
        else
        {
            selectAllChecked = 0;
        }
    }
    else
    {
        var parts = checkboxName.split('-');
        var checkboxIndex = parts[1];
        var receiptID = receiptIDs[checkboxIndex];
        
        if(this.checked)
        {
            selectedReceiptIDs = selectedReceiptIDs.filter(function(value) 
            { 
                return value != receiptID; 
            });
            
            selectedReceiptIDs.push(receiptID);
        }
        else
        {
            selectedReceiptIDs = selectedReceiptIDs.filter(function(value) 
            { 
                return value != receiptID; 
            });
        }
        
        console.log('Selected Receipts:');
        console.log(selectedReceiptIDs);
    }
});

function download(url) 
{
    window.location.href = url;
};