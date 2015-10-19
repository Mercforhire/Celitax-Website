$(document).ready(function(){
    //page scroll
    $('.scrollButton').click(function() {
        $('html, body').animate({
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
    console.log("About Contact");

    $('html, body').animate({
        scrollTop: $(".sixthSectionWrap").offset().top
    }, 700);
}

function submitComment()
{
    document.forms["comment_form"].submit();
}