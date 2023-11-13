// creation of constant and variable

const ennemieData = JSON.parse(ennemie.replaceAll('&quot;', '"'));
const allyData = JSON.parse(ally.replaceAll('&quot;', '"'));
var elements = JSON.parse(element.replaceAll('&quot;', '"'));
var types = JSON.parse(typeOfWeapon.replaceAll('&quot;', '"'));
var categorys = JSON.parse(categoryOfWeapon.replaceAll('&quot;', '"'));
// set max value to show
const maxAllyHp = allyData.personnage.Life.toString();
const maxEnnemieHp = ennemieData.personnage.Life.toString();
const maxAllyEnergy = allyData.personnage.Energy.toString();
const maxEnnemieEnergy = ennemieData.personnage.Energy.toString();
// set acual value 
var actualAllyHp = allyData.personnage.Life.toString();
var actualEnnemieHp = ennemieData.personnage.Life.toString();
var actualAllyEnergy = allyData.personnage.Energy.toString();
var actualEnnemieEnergy = ennemieData.personnage.Energy.toString();
// inialize the turn to wait to 0
var waitSkillAlly = 0;
var waitActionAlly = 0;
var waitSkillEnnemie = 0;
var waitActionEnnemie = 0;



function allyAttack()
{


    console.log(allyInfo.hp);
    console.log(allyData.personnage.Life);
}


// update of view


function setAllyHp()
{
    var allyHealthInfo = actualAllyHp + "/" + maxAllyHp;
    let bar = document.getElementById('actualAllyHp');
    bar.innerText = allyHealthInfo;
}

function setEnnemieHp()
{
    var ennemieHealthInfo = actualEnnemieHp + "/" + maxEnnemieHp;
    let bar = document.getElementById('actualEnnemieHp');
    bar.innerText = ennemieHealthInfo;
}

function setAllyEnergy()
{
    var allyEnergyInfo = actualAllyEnergy + "/" + maxAllyEnergy;
    let bar = document.getElementById('actualAllyEnergy');
    bar.innerText = allyEnergyInfo;
}

function setEnnemieEnergy()
{
    var ennemieEnergyInfo = actualEnnemieEnergy + "/" + maxEnnemieEnergy;
    let bar = document.getElementById('actualEnnemieEnergy');
    bar.innerText = ennemieEnergyInfo;
}




// check action to return multiplicator



function checkActionElement(action) // method to send element multiplicator depending of the case
{
    switch (action)
    {
        case 'base' :
            if(allyData.weapon.Element == allyData.weapon.ElementBase)
            {
                return 1.5;
            }
            else
            {
                return 1;
            }
        case 'skill' :
            if(allyData.weapon.Element == allyData.weapon.ElementSkill)
            {
                return 1.75;
            }
            else
            {
                return 1;
            };
        case 'atkFromAlly' :
            let elementWeaponBase = elements.filter((elem) => elem.name == allyData.weapon.ElementBase);
            let elementEnnemieAtk = elements.filter((elem) => elem.name == ennemieData.personnage.Element);
            if(elementWeaponBase.advantage == elementEnnemieAtk.id)
            {
                return elementWeaponBase.advantageMultiplicator;
            }
            else if(elementWeaponBase.disadvantage == elementEnnemieAtk.id)
            {
                return elementWeaponBase.disadvantageMultiplicator;
            }
            else
            {
                return 1;
            };
        case 'skillFromAlly' :
            let elementWeaponSkill = elements.filter((elem) => elem.name == allyData.weapon.ElementSkill);
            let elementEnnemieSkill = elements.filter((elem) => elem.name == ennemieData.personnage.Element);
            if(elementWeaponSkill.advantage == elementEnnemieSkill.id)
            {
                return elementWeaponSkill.advantageMultiplicator;
            }
            else if(elementWeaponSkill.disadvantage == elementEnnemieSkill.id)
            {
                return elementWeaponSkill.disadvantageMultiplicator;
            }
            else
            {
                return 1;
            };
        case 'atkFromEnnemie' :
            let elementEnnemieWeaponBase = elements.filter((elem) => elem.name == ennemieData.weapon.ElementBase);
            let elementAllyAtk = elements.filter((elem) => elem.name == allyData.personnage.Element);
            if(elementEnnemieWeaponBase.advantage == elementAllyAtk.id)
            {
                return elementEnnemieWeaponBase.advantageMultiplicator;
            }
            else if(elementEnnemieWeaponBase.disadvantage == elementAllyAtk.id)
            {
                return elementEnnemieWeaponBase.disadvantageMultiplicator;
            }
            else
            {
                return 1;
            };
        case 'skillFromEnnemie' :
            let elementEnnemieWeaponSkill = elements.filter((elem) => elem.name == ennemieData.weapon.ElementSkill);
            let elementAllySkill = elements.filter((elem) => elem.name == allyData.personnage.Element);
            if(elementEnnemieWeaponSkill.advantage == elementAllySkill.id)
            {
                return elementEnnemieWeaponSkill.advantageMultiplicator;
            }
            else if(elementEnnemieWeaponSkill.disadvantage == elementAllySkill.id)
            {
                return elementEnnemieWeaponSkill.disadvantageMultiplicator;
            }
            else
            {
                return 1;
            };
    }
}

function checkActionType(action) // method to send type multiplicator depending of the case
{
    let typeWeaponAlly = types.filter((typeWeapon) => typeWeapon.name == allyData.weapon.Type);
    let typeWeaponEnnemie = types.filter((typeWeapon) => typeWeapon.name == ennemieData.weapon.Type);
    // select the weapon type and not the personnage type for an amelioration where a caracter will have a possbility to choose all weapon from a category or a type
    switch (action)
    {
        case 'allyToEnnemie' :
            if(typeWeaponAlly.advantage == typeWeaponEnnemie.id)
            {
                return typeWeaponAlly.advantageMultiplicator;
            }
            else if(typeWeaponAlly.disadvantage == typeWeaponEnnemie.id)
            {
                return typeWeaponAlly.disadvantageMultiplicator;
            }
            else
            {
                return 1;
            };
        case 'ennemieToAlly' :
            if(typeWeaponEnnemie.advantage == typeWeaponAlly.id)
            {
                return typeWeaponEnnemie.advantageMultiplicator;
            }
            else if(typeWeaponEnnemie.disadvantage == typeWeaponAlly.id)
            {
                return typeWeaponEnnemie.disadvantageMultiplicator;
            }
            else
            {
                return 1;
            };
    }
}

function checkActionCategory(action) // method to send category multiplicator depending of the case
{
    let categoryWeaponAlly = categorys.filter((categoryWeapon) => categoryWeapon.name == allyData.weapon.Category);
    let categoryWeaponEnnemie = categorys.filter((categoryWeapon) => categoryWeapon.name == ennemieData.weapon.Category);
    // select the weapon category and not the personnage category for an amelioration where a caracter will have a possbility to choose all weapon from a category or a category
    switch (action)
    {
        case 'allyToEnnemie' :
            if(categoryWeaponAlly.advantage == categoryWeaponEnnemie.id)
            {
                return categoryWeaponAlly.advantageMultiplicator;
            }
            else if(categoryWeaponAlly.disadvantage == categoryWeaponEnnemie.id)
            {
                return categoryWeaponAlly.disadvantageMultiplicator;
            }
            else
            {
                return 1;
            };
        case 'ennemieToAlly' :
            if(categoryWeaponEnnemie.advantage == categoryWeaponAlly.id)
            {
                return categoryWeaponEnnemie.advantageMultiplicator;
            }
            else if(categoryWeaponEnnemie.disadvantage == categoryWeaponAlly.id)
            {
                return categoryWeaponEnnemie.disadvantageMultiplicator;
            }
            else
            {
                return 1;
            };
    }
}

// when loading the page

setAllyHp();
setEnnemieHp();
setAllyEnergy();
setEnnemieEnergy();