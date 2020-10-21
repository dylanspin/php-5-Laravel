

var formBool = false;//review form
var standard = "fa fa-star starButton"; //star buttons

function writeReview()
{
    if(formBool)
    {
        document.getElementById('reviewButton').innerHTML = "Write A Review";
        document.getElementById('reviewForm').style.display = "none";
        formBool = false;
    }else{
        document.getElementById('reviewButton').innerHTML = "Stop Writing";
        document.getElementById('reviewForm').style.display = "block";
        formBool = true;
    }
}

function setStar(num)
{
    document.getElementById('starHidden').value = num; //sets hidden value
    for(var i=0; i<=num; i++)//selected
    {
        document.getElementById('star'+i).className = "selectedStar " + standard;
    }
    for(var i=4; i>num; i--)//unselect
    {
        document.getElementById('star'+i).className = "unselected " + standard;
    }
}

function stopPost()
{
    if ( window.history.replaceState ) {
          window.history.replaceState( null, null, window.location.href );
    }
}

function openSettings(clicked)
{
    // var num = clicked.charAt(1);
    document.getElementById('O'+clicked).style.display = "block";
    for(var i=1; i<=5; i++)
    {
        if(i != clicked)
        {
            document.getElementById('O'+i).style.display = "none";
        }
    }
}


function setGradient(g)
{
    if(g)
    {
        var color1 = document.getElementById('G1').value;
        var color2 = document.getElementById('G2').value;

        document.getElementById('gradientBar').style.background = "linear-gradient(118deg,"+color1+" 0%,"+color2+" 100%)";
    }else{
      var color1 = document.getElementById('H1').value;
      var color2 = document.getElementById('H2').value;

      document.getElementById('HoverBar').style.background = "linear-gradient(118deg,"+color1+" 0%,"+color2+" 100%)";
    }
}
