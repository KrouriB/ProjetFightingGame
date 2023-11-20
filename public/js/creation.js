// personnage



// constant and variable
const hpPerso = document.getElementById("personnage_life");


// function more

function moreHpPerso()
{
    let value = parseInt(hpPerso.value, 10);
    value = isNaN(value) ? 200 : value;
    if(value < 500)
    {
        value = value + 100;
    }

    hpPerso.value = value;
}


// function less

function lessHpPerso()
{
    var value = parseInt(hpPerso.value, 10);
    value = isNaN(value) ? 200 : value;

    if(value > 200)
    {
        value = value - 100;
    }

    hpPerso.value = value;
}