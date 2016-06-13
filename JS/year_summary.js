$(document).ready(function(){
    if (typeof email != 'undefined' && typeof reportid != 'undefined')
    {
        var xmlhttp = new XMLHttpRequest();

        var data = new FormData();

        data.append('email', email);
        data.append('reportid', reportid);
        
        xmlhttp.onreadystatechange = function()
        {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                var response = xmlhttp.responseText;
                
                post("year_summary.php", {'data': response});
            }
        };

        xmlhttp.open("POST", "https://www.crave-n-save.ca/crave/Celitax-WebAPI/v1/getDataReport.php", true);
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

function viewDetailsClicked()
{
    $('.secondSectionContentWrap').show();
    
    $('html, body').animate( {
            scrollTop: $(".secondSectionContentWrap").offset().top
    }, 700);
    
    var chart = new CanvasJS.Chart("chartContainer",
            {
                animationEnabled: true,
                data: [
                    {
                        indexLabelFontSize: 13,
                        indexLabelFontFamily: "lato",
                        indexLabelFontColor: "black",
                        indexLabelLineColor: "lightgray",
                        indexLabelPlacement: "outside",
                        type: "pie",
                        showInLegend: false,
                        toolTipContent: "${y} - <strong>#percent%</strong>",
                        dataPoints: dataPoints
                    }
                ]
            });
    chart.render();
}