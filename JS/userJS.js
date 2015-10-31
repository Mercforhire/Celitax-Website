$(document).ready(function(){
    //page scroll
    $('.scrollButtonOutline').click(function() 
    {
        $('html, body').animate( {
            scrollTop: $(".secondSectionWrap").offset().top
        }, 700);
    });
}); 

function contactClicked()
{
    console.log("Pressed Contact");

    $('.contactSectionWrap').show();

    $('html, body').animate({
        scrollTop: $(".contactSectionWrap").offset().top
    }, 700);
}

function aboutClicked()
{
    console.log("Pressed About");

    $('html, body').animate({
        scrollTop: $(".sixthSectionWrap").offset().top
    }, 700);
}

function submitComment()
{
    //get string from #nameField, #emailField, and #commentField
    var name = $('#nameField').val();
    var email = $('#emailField').val();
    var comment = $('#commentField').val();
    
    //make sure all 3 strings are non-empty
    if ($('#nameField').val().length == 0 || $('#emailField').val().length == 0 || $('#commentField').val().length == 0) 
    {
        return;
    }
    
    //make sure the email string is valid
    if ( !validateEmail(email) )
    {
        return;
    }
    
    //if yes, send it to sendComment.php and display 'thank you' in #commentField
    var xmlhttp = new XMLHttpRequest();
    
    var data = new FormData();
    
    data.append('name', name);
    data.append('email', email);
    data.append('comments', comment);
    
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            var response = xmlhttp.responseText;

            console.log(response);

            $('#commentField').val("Thank you for the message!");
        }
    };

    xmlhttp.open("POST", "sendComment.php", true);
    xmlhttp.send(data);
}

function submitEmail()
{
    //get string from #emailSubmttionField
    var email = $('#emailSubmttionField').val();
    
    //check string to see if's valid email address
    if ( validateEmail(email) )
    {
        //if yes, send it to addToMailingList.php and display 'thank you' in #emailSubmttionField
        
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function()
        {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                var response = xmlhttp.responseText;
                
                console.log(response);
                
                $('#emailSubmttionField').val("Thank you!");
            }
        };

        xmlhttp.open("GET", "addToMailingList.php?email=" + email, true);
        xmlhttp.send();
    }
}

/*Email Validation Function Regex*/
function validateEmail(sEmail) 
{
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    
    if (filter.test(sEmail)) 
    {
        return true;
    }
    else 
    {
        return false;
    }
}