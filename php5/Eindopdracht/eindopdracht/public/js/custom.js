

var formBool = false;//review form
var standard = "fa fa-star starButton"; //star buttons
var types = ["Hour","Set","Discus"];
var selected = [];

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
      var color1 = document.getElementById('G1').value;
      var color2 = document.getElementById('G2').value;

      document.getElementById('D1').style.background = color1;
      document.getElementById('D2').style.background = color2;
      document.getElementById('gradientBar').style.background = "linear-gradient(118deg,"+color1+" 0%,"+color2+" 100%)";
}

function closeAdd()
{
    document.getElementById('list').style.height = "0";
    document.getElementById('holder').style.display = "none";
}

function addProduct()
{
    document.getElementById('list').style.height = "980px";
    document.getElementById('holder').style.display = "block";
   // document.getElementById('list').style.width = "40vw";
}

function setSelect(num)
{
    if(num == 1)
    {
        document.getElementById('hour').style.display = "block";
    }else{
        document.getElementById('hour').style.display = "none";
    }
    for(var i=1; i<=3; i++)
    {
        if(i == num)
        {
            document.getElementById(i).classList.add('gradient');
            document.getElementById(i).classList.remove('setSlot');
        }else{
            document.getElementById(i).classList.add('setSlot');
            document.getElementById(i).classList.remove('gradient');
        }
    }
    document.getElementById('setValue').innerHTML = "<h3>"+types[num-1]+" Price</h3>";
    document.getElementById('select').value = num;
}


function activateInput(num)
{
    document.getElementById('G'+num).click();
}

function closeCard()
{
    document.getElementById('card').style.height = "0px";
    document.getElementById('holder').style.display = "none";
}

function showProduct(int)
{
    document.getElementById('card').style.height = "600px";
    document.getElementById('holder').style.display = "block";

    //sets information of popup
    document.getElementById('setName').innerHTML = document.getElementById('nameCard'+int).innerHTML;
    document.getElementById('setPrice').innerHTML = document.getElementById('price'+int).innerHTML;
    document.getElementById('setHour').innerHTML = document.getElementById('hourPrice'+int).innerHTML;
    document.getElementById('setAbout').innerHTML = document.getElementById('aboutCard'+int).innerHTML;
}

function setBand(int)
{
    document.getElementById('bandId').value = int;
    document.getElementById('setBand').value = int;
    document.getElementById('bandManger').style.display = "block";
    document.getElementById('selectBand').style.display = "none";
    document.getElementById('H'+int).style.display = "block";
    document.getElementById('P'+int).style.display = "block";
    document.getElementById('G'+int).style.display = "block";
}

function goToSelect()
{
    var deselect = document.getElementById('bandId').value;
    document.getElementById('H'+deselect).style.display = "none";
    document.getElementById('P'+deselect).style.display = "none";
    document.getElementById('G'+deselect).style.display = "none";
    document.getElementById('bandManger').style.display = "none";
    document.getElementById('selectBand').style.display = "block";
}

function setGradientBand(g,b)
{
      var color1 = document.getElementById(b+'G1').value;
      var color2 = document.getElementById(b+'G2').value;

      document.getElementById('b+D1').style.background = color1;
      document.getElementById('b+D2').style.background = color2;
      document.getElementById('gradientBar').style.background = "linear-gradient(118deg,"+color1+" 0%,"+color2+" 100%)";
}

function inviteList(id)
{
    document.getElementById('bandList').style.display = "block";
    document.getElementById('HiddenId').value = id;
}
function closeInviteList()
{
    document.getElementById('bandList').style.display = "none";
}

function SelectBand(bandId)
{
    if(selected.includes(bandId))
    {
        document.getElementById('S'+bandId).innerHTML = "Select";
        var slot = selected.indexOf(bandId);
        selected.splice(slot,1);
    }else{
        document.getElementById('S'+bandId).innerHTML = "DeSelect";
        selected.push(bandId);
    }
    // var json = JSON.stringify(selected)
    var s = JSON.stringify(selected);
    document.getElementById('bandList').value = s;
    var values = document.getElementById('bandList').value;
    // alert(values);
}
