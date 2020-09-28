

var formBool = false;
function writeReview()
{
    if(formBool)
    {
        document.getElementById('reviewButton').innerHTML = "Write A Review";
        // document.getElementById('reviewForm').style.display = "none";
        document.getElementById('reviewForm').style.transform = "scale(1,0)";

        formBool = false;
    }else{
        document.getElementById('reviewButton').innerHTML = "Stop Writing";
        document.getElementById('reviewForm').style.transform = "scale(1,1)";

        // document.getElementById('reviewForm').style.display = "block";
        formBool = true;
    }
}



function setStar(num)
{
    var standard = "fa fa-star starButton";
    document.getElementById('starHidden').value = num; //sets hidden value
    for(var i=0; i<num; i++)//selected
    {
        document.getElementById('star'+i).className = "selectedStar " + standard;
    }
    for(var i=4; i>num; i--)//unselect
    {
        document.getElementById('star'+i).className = "unselected " + standard;
    }
}
