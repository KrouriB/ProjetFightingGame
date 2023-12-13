// personnage



// constant and variable
const atkStat = document.getElementById("weapon_attackStat");
const magStat = document.getElementById("weapon_magicStat");
const atkSkill = document.getElementById("weapon_attackSkill");
const magSkill = document.getElementById("weapon_magicSkill");
const nrjSkill = document.getElementById("weapon_energySkill");
const waitSkill = document.getElementById("weapon_waitSkill");

var cost;

function costCalc()
{
    let atkStatI = parseInt(atkStat.value, 10);
    let magStatI = parseInt(magStat.value, 10);
    let atkSkillI = parseInt(atkSkill.value, 10);
    let magSkillI = parseInt(magSkill.value, 10);
    let nrjSkillI = parseInt(nrjSkill.value, 10);
    let waitSkillI = parseInt(waitSkill.value, 10);

    let span = document.getElementById("cost");

    cost = ((atkStatI / 10) * 50) + ((magStatI / 10) * 50) + ((atkSkillI / 10) * 150) + ((magSkillI / 10) * 150) - (((nrjSkillI - 30) / 6) * 90) - (((waitSkillI - 1) / 1) * 150);

    span.innerText = cost;
}


// function more


function moreAtkStat()
{
    let button = document.getElementById('atkStatPlus');

    if(document.getElementById('atkStatMinus').classList.contains('grey'))
    {
        document.getElementById('atkStatMinus').classList.remove('grey');
    }

    let value = parseInt(atkStat.value, 10);
    value = isNaN(value) ? 20 : value;
    if(value < 200)
    {
        value = value + 10;
        costCalc();
    }

    atkStat.value = value;

    if(value == 200)
    {
        button.classList.add('grey');
    }
    else if(button.classList.contains('grey'))
    {
        button.classList.remove('grey');
    }
}

function moreMagStat()
{
    let button = document.getElementById('magStatPlus');

    if(document.getElementById('magStatMinus').classList.contains('grey'))
    {
        document.getElementById('magStatMinus').classList.remove('grey');
    }

    let value = parseInt(magStat.value, 10);
    value = isNaN(value) ? 20 : value;
    if(value < 200)
    {
        value = value + 10;
        costCalc();
    }

    magStat.value = value;

    if(value == 200)
    {
        button.classList.add('grey');
    }
    else if(button.classList.contains('grey'))
    {
        button.classList.remove('grey');
    }
}

function moreAtkSkill()
{
    let button = document.getElementById('atkSkillPlus');

    if(document.getElementById('atkSkillMinus').classList.contains('grey'))
    {
        document.getElementById('atkSkillMinus').classList.remove('grey');
    }

    let value = parseInt(atkSkill.value, 10);
    value = isNaN(value) ? 50 : value;
    if(value < 500)
    {
        value = value + 10;
        costCalc();
    }

    atkSkill.value = value;

    if(value == 500)
    {
        button.classList.add('grey');
    }
    else if(button.classList.contains('grey'))
    {
        button.classList.remove('grey');
    }
}

function moreMagSkill()
{
    let button = document.getElementById('magSkillPlus');

    if(document.getElementById('magSkillMinus').classList.contains('grey'))
    {
        document.getElementById('magSkillMinus').classList.remove('grey');
    }

    let value = parseInt(magSkill.value, 10);
    value = isNaN(value) ? 50 : value;
    if(value < 500)
    {
        value = value + 10;
        costCalc();
    }

    magSkill.value = value;

    if(value == 500)
    {
        button.classList.add('grey');
    }
    else if(button.classList.contains('grey'))
    {
        button.classList.remove('grey');
    }
}

function moreNrjSkill()
{
    let button = document.getElementById('nrjPlus');

    if(document.getElementById('nrjMinus').classList.contains('grey'))
    {
        document.getElementById('nrjMinus').classList.remove('grey');
    }

    let value = parseInt(nrjSkill.value, 10);
    value = isNaN(value) ? 30 : value;
    if(value < 180)
    {
        value = value + 6;
        costCalc();
    }

    nrjSkill.value = value;

    if(value == 180)
    {
        button.classList.add('grey');
    }
    else if(button.classList.contains('grey'))
    {
        button.classList.remove('grey');
    }
}

function moreWaitSkill()
{
    let button = document.getElementById('waitPlus');

    if(document.getElementById('waitMinus').classList.contains('grey'))
    {
        document.getElementById('waitMinus').classList.remove('grey');
    }

    let value = parseInt(waitSkill.value, 10);
    value = isNaN(value) ? 1 : value;
    if(value < 10)
    {
        value = value + 1;
        costCalc();
    }

    waitSkill.value = value;

    if(value == 10)
    {
        button.classList.add('grey');
    }
    else if(button.classList.contains('grey'))
    {
        button.classList.remove('grey');
    }
}


// function less


function lessAtkStat()
{
    let button = document.getElementById('atkStatMinus');

    if(document.getElementById('atkStatPlus').classList.contains('grey'))
    {
        document.getElementById('atkStatPlus').classList.remove('grey');
    }

    var value = parseInt(atkStat.value, 10);
    value = isNaN(value) ? 0 : value;

    if(value > 20)
    {
        value = value - 10;
        costCalc();
    }

    atkStat.value = value;

    if(value == 20)
    {
        button.classList.add('grey');
    }
    else if(button.classList.contains('grey'))
    {
        button.classList.remove('grey');
    }
}

function lessMagStat()
{
    let button = document.getElementById('magStatMinus');

    if(document.getElementById('magStatPlus').classList.contains('grey'))
    {
        document.getElementById('magStatPlus').classList.remove('grey');
    }

    var value = parseInt(magStat.value, 10);
    value = isNaN(value) ? 20 : value;

    if(value > 20)
    {
        value = value - 10;
        costCalc();
    }

    magStat.value = value;

    if(value == 20)
    {
        button.classList.add('grey');
    }
    else if(button.classList.contains('grey'))
    {
        button.classList.remove('grey');
    }
}

function lessAtkSkill()
{
    let button = document.getElementById('atkSkillMinus');

    if(document.getElementById('atkSkillPlus').classList.contains('grey'))
    {
        document.getElementById('atkSkillPlus').classList.remove('grey');
    }

    var value = parseInt(atkSkill.value, 10);
    value = isNaN(value) ? 50 : value;

    if(value > 50)
    {
        value = value - 10;
        costCalc();
    }

    atkSkill.value = value;

    if(value == 50)
    {
        button.classList.add('grey');
    }
    else if(button.classList.contains('grey'))
    {
        button.classList.remove('grey');
    }
}

function lessMagSkill()
{
    let button = document.getElementById('magSkillMinus');

    if(document.getElementById('magSkillPlus').classList.contains('grey'))
    {
        document.getElementById('magSkillPlus').classList.remove('grey');
    }

    var value = parseInt(magSkill.value, 10);
    value = isNaN(value) ? 50 : value;

    if(value > 50)
    {
        value = value - 10;
        costCalc();
    }

    magSkill.value = value;

    if(value == 50)
    {
        button.classList.add('grey');
    }
    else if(button.classList.contains('grey'))
    {
        button.classList.remove('grey');
    }
}

function lessNrjSkill()
{
    let button = document.getElementById('nrjMinus');

    if(document.getElementById('nrjPlus').classList.contains('grey'))
    {
        document.getElementById('nrjPlus').classList.remove('grey');
    }

    let value = parseInt(nrjSkill.value, 10);
    value = isNaN(value) ? 30 : value;
    if(value > 30)
    {
        value = value - 6;
        costCalc();
    }

    nrjSkill.value = value;

    if(value == 30)
    {
        button.classList.add('grey');
    }
    else if(button.classList.contains('grey'))
    {
        button.classList.remove('grey');
    }
}

function lessWaitSkill()
{
    let button = document.getElementById('waitMinus');

    if(document.getElementById('waitPlus').classList.contains('grey'))
    {
        document.getElementById('waitPlus').classList.remove('grey');
    }

    var value = parseInt(waitSkill.value, 10);
    value = isNaN(value) ? 1 : value;

    if(value > 1)
    {
        value = value - 1;
        costCalc();
    }

    waitSkill.value = value;

    if(value == 1)
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
    atkStat.disabled = stat;
    magStat.disabled = stat;
    atkSkill.disabled = stat;
    magSkill.disabled = stat;
    nrjSkill.disabled = stat;
    waitSkill.disabled = stat;
}

async function validate()
{
    await makeNotDisable(false);
    document.getElementById("weapon_valider").click();
}


// initialize

costCalc();
makeNotDisable(true);