// personnage



// constant and variable
var points = 31;
const hpPerso = document.getElementById("personnage_life");
const atkPerso = document.getElementById("personnage_attack");
const magPerso = document.getElementById("personnage_magic");
const nrjPerso = document.getElementById("personnage_energy");


// calculate point
function showPoints(pts)
{
    let spanPts = document.getElementById("pointAllouable");
    spanPts.innerText = pts + '/31';
}


// function more


function moreHpPerso()
{
    let button = document.getElementById('hpPlus');

    if(document.getElementById('hpMinus').classList.contains('grey'))
    {
        document.getElementById('hpMinus').classList.remove('grey');
    }

    let value = parseInt(hpPerso.value, 10);
    value = isNaN(value) ? 200 : value;
    if(value < 500 && points > 0)
    {
        value = value + 25;
        showPoints(--points);
    }

    hpPerso.value = value;

    if(value == 500)
    {
        button.classList.add('grey');
    }
    else if(button.classList.contains('grey'))
    {
        button.classList.remove('grey');
    }
}

function moreAtkPerso()
{
    let button = document.getElementById('atkPlus');

    if(document.getElementById('atkMinus').classList.contains('grey'))
    {
        document.getElementById('atkMinus').classList.remove('grey');
    }

    let value = parseInt(atkPerso.value, 10);
    value = isNaN(value) ? 0 : value;
    if(value < 40 && points > 0)
    {
        value = value + 4;
        showPoints(--points);
    }

    atkPerso.value = value;

    if(value == 40)
    {
        button.classList.add('grey');
    }
    else if(button.classList.contains('grey'))
    {
        button.classList.remove('grey');
    }
}

function moreMagPerso()
{
    let button = document.getElementById('magPlus');

    if(document.getElementById('magMinus').classList.contains('grey'))
    {
        document.getElementById('magMinus').classList.remove('grey');
    }

    let value = parseInt(magPerso.value, 10);
    value = isNaN(value) ? 0 : value;
    if(value < 40 && points > 0)
    {
        value = value + 4;
        showPoints(--points);
    }

    magPerso.value = value;

    if(value == 40)
    {
        button.classList.add('grey');
    }
    else if(button.classList.contains('grey'))
    {
        button.classList.remove('grey');
    }
}

function moreNrjPerso()
{
    let button = document.getElementById('nrjPlus');

    if(document.getElementById('nrjMinus').classList.contains('grey'))
    {
        document.getElementById('nrjMinus').classList.remove('grey');
    }

    let value = parseInt(nrjPerso.value, 10);
    value = isNaN(value) ? 60 : value;
    if(value < 180 && points > 0)
    {
        value = value + 8;
        showPoints(--points);
    }

    nrjPerso.value = value;

    if(value == 180)
    {
        button.classList.add('grey');
    }
    else if(button.classList.contains('grey'))
    {
        button.classList.remove('grey');
    }
}


// function less


function lessHpPerso()
{
    let button = document.getElementById('hpMinus');

    if(document.getElementById('hpPlus').classList.contains('grey'))
    {
        document.getElementById('hpPlus').classList.remove('grey');
    }

    var value = parseInt(hpPerso.value, 10);
    value = isNaN(value) ? 200 : value;

    if(value > 200)
    {
        value = value - 25;
        showPoints(++points);
    }

    hpPerso.value = value;

    if(value == 200)
    {
        button.classList.add('grey');
    }
    else if(button.classList.contains('grey'))
    {
        button.classList.remove('grey');
    }
}

function lessAtkPerso()
{
    let button = document.getElementById('atkMinus');

    if(document.getElementById('atkPlus').classList.contains('grey'))
    {
        document.getElementById('atkPlus').classList.remove('grey');
    }

    var value = parseInt(atkPerso.value, 10);
    value = isNaN(value) ? 0 : value;

    if(value > 0)
    {
        value = value - 4;
        showPoints(++points);
    }

    atkPerso.value = value;

    if(value == 0)
    {
        button.classList.add('grey');
    }
    else if(button.classList.contains('grey'))
    {
        button.classList.remove('grey');
    }
}

function lessMagPerso()
{
    let button = document.getElementById('magMinus');

    if(document.getElementById('magPlus').classList.contains('grey'))
    {
        document.getElementById('magPlus').classList.remove('grey');
    }

    var value = parseInt(magPerso.value, 10);
    value = isNaN(value) ? 0 : value;

    if(value > 0)
    {
        value = value - 4;
        showPoints(++points);
    }

    magPerso.value = value;

    if(value == 0)
    {
        button.classList.add('grey');
    }
    else if(button.classList.contains('grey'))
    {
        button.classList.remove('grey');
    }
}

function lessNrjPerso()
{
    let button = document.getElementById('nrjMinus');

    if(document.getElementById('nrjPlus').classList.contains('grey'))
    {
        document.getElementById('nrjPlus').classList.remove('grey');
    }

    let value = parseInt(nrjPerso.value, 10);
    value = isNaN(value) ? 60 : value;
    if(value > 60)
    {
        value = value - 8;
        showPoints(++points);
    }

    nrjPerso.value = value;

    if(value == 60)
    {
        button.classList.add('grey');
    }
    else if(button.classList.contains('grey'))
    {
        button.classList.remove('grey');
    }
}


// when validate


async function makeNotDisable(stat){
    hpPerso.disabled = stat;
    atkPerso.disabled = stat;
    magPerso.disabled = stat;
    nrjPerso.disabled = stat;
}

async function validate()
{
    await makeNotDisable(false);
    document.getElementById("personnage_valider").click();
}


// initialize

showPoints(points);
makeNotDisable(true);