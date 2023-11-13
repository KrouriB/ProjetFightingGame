const ennemieData = JSON.parse(ennemie.replaceAll('&quot;', '"'));
const allyData = JSON.parse(ally.replaceAll('&quot;', '"'));
var ennemieInfo = JSON.parse(ennemieInfo.replaceAll('&quot;', '"'));
var allyInfo = JSON.parse(allyInfo.replaceAll('&quot;', '"'));
var elements = JSON.parse(element.replaceAll('&quot;', '"'));
var types = JSON.parse(type.replaceAll('&quot;', '"'));
var categorys = JSON.parse(category.replaceAll('&quot;', '"'));

function allyAttack()
{


    console.log(allyData);
    console.log(elements)
}




// update of view


function setAllyHp()
{
    
}

function setEnnemieHp()
{
    
}

function setAllyEnergy()
{
    
}

function setEnnemieyEnergy()
{
    
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