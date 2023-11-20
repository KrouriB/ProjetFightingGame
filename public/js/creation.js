// personnage



// constant and variable
const hpPerso = document.getElementById("personnage_life");


// calculate point
function showPoint()
{

}


// function more

function moreHpPerso()
{
    let button = document.getElementById('hpPlus');
    let value = parseInt(hpPerso.value, 10);
    value = isNaN(value) ? 200 : value;
    if(value < 500)
    {
        value = value + 25;
    }

    hpPerso.value = value;

    if(value == 500)
    {
        button.classList.add(grey);
    }
    else if(button.classList.contains(grey))
    {
        button.disabled.remove(grey);
    }
}


// function less

function lessHpPerso()
{
    let button = document.getElementById('hpMinus');
    var value = parseInt(hpPerso.value, 10);
    value = isNaN(value) ? 200 : value;

    if(value > 200)
    {
        value = value - 25;
    }

    hpPerso.value = value;

    if(value == 200)
    {
        button.classList.add(grey);
    }
    else if(button.classList.contains(grey))
    {
        button.disabled.remove(grey);
    }
}