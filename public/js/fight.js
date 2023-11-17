// creation of constant and variable
const ennemieData = JSON.parse(ennemie.replaceAll('&quot;', '"'));
const allyData = JSON.parse(ally.replaceAll('&quot;', '"'));
var elements = JSON.parse(element.replaceAll('&quot;', '"'));
var types = JSON.parse(typeOfWeapon.replaceAll('&quot;', '"'));
var categorys = JSON.parse(categoryOfWeapon.replaceAll('&quot;', '"'));
// log div selected + default log to use
const logDiv = document.getElementById('logs');
const logLine = document.createElement('p');
logLine.classList.add('logLine');
const logNames = document.createElement('span');
// set max value to show
const maxAllyHp = allyData.personnage.Life.toString();
const maxEnnemieHp = ennemieData.personnage.Life.toString();
const maxAllyEnergy = allyData.personnage.Energy.toString();
const maxEnnemieEnergy = ennemieData.personnage.Energy.toString();
// set actual value 
var actualAllyHp = allyData.personnage.Life.toString();
var actualEnnemieHp = ennemieData.personnage.Life.toString();
var actualAllyEnergy = allyData.personnage.Energy.toString();
var actualEnnemieEnergy = ennemieData.personnage.Energy.toString();
// value to check if need to change status of action
var energySkillEnough = true;
var energyActionEnough = true;
// value to check if accessory action in ongoing
var accessoryActionAlly = 'none';
var accessoryActionEnnemie = 'none';
//value of damaged reduced
var reducedDamge = 0;
// inialize the turn to wait to 0
var waitSkillAlly = 0;
var waitActionAlly = 0;
var waitSkillEnnemie = 0;
var waitActionEnnemie = 0;


// Ally Actions


function allyAttack()
{
    let reduc = 1;
    if(accessoryActionEnnemie == 'Réduction de dégâts')
    {
        reduc = 1 - (ennemieData.accessory.StatAction * 0.01);
        accessoryActionEnnemie = 'none';
        console.log('atk ally redu');
    }
    let rawDamage = calculRawDamage('ally', 'base');
    let damage = Math.round(rawDamage * checkActionElement('baseAlly') * checkActionType('AllyToEnnemie') * checkActionCategory('AllyToEnnemie') * reduc);

    damageInflict('AllyToEnnemie', damage);
    rechargeEnergy('ally');

    setAllyTurn();
    useEnnemieAction();
}

function allySkill()
{
    let reduc = 1;
    if(accessoryActionEnnemie == 'Réduction de dégâts')
    {
        reduc = 1 - (ennemieData.accessory.StatAction * 0.01);
        accessoryActionEnnemie = 'none';
        console.log('skill ally redu');
    }
    let rawDamage = calculRawDamage('ally', 'skill');
    let damage = Math.round(rawDamage * checkActionElement('skillAlly') * checkActionType('AllyToEnnemie') * checkActionCategory('AllyToEnnemie') * reduc);

    // here check if energy is suffisent, if not break, keep the check even with made the disable function
    actualAllyEnergy = actualAllyEnergy - allyData.weapon.EnergyCost;

    // console.log(actualAllyEnergy);

    damageInflict('AllyToEnnemie', damage);
    rechargeEnergy('ally');

    // console.log(actualAllyEnergy);

    setAllyTurn();
    useEnnemieAction();
}

function allyAction()
{
    switch(allyData.accessory.NomTypeAction)
    {
        case "Réduction de dégâts" :
            accessoryActionAlly = "Réduction de dégâts";
            break;
        case "Protection Magique" :
            accessoryActionAlly = "Protection Magique";
            break;
        case "Protection Physique" :
            accessoryActionAlly = "Protection Physique";
            break;
    };

    actualAllyEnergy = actualAllyEnergy - allyData.accessory.EnergyCost;

    rechargeEnergy('ally');

    setAllyEnergy();

    useEnnemieAction();
}


// Ennemy Action


function useEnnemieAction() // function to select randomly enemys action
{
    let action = 1;
    let what;
    if(actualEnnemieEnergy >= ennemieData.weapon.EnergyCost)
    {
        action += 1;
        what = 'skill';
    }
    if(actualEnnemieEnergy >= ennemieData.accessory.EnergyCost)
    {
        action += 1;
        what = 'action';
    }
    switch(Math.floor(Math.random() * action))
    {
        case 0 :
            console.log('actionAtk');
            ennemieAttack();
            break;
        case 1 :
            if(action == 1)
            {
                switch(what)
                {
                    case 'skill' :
                        console.log('actionSkill case1 switch');
                        ennemieSkill();
                        break;
                    case 'action' :
                        console.log('actionAcc case1 switch');
                        ennemieAction();
                        break;
                };
            }
            else
            {
                console.log('actionSkill case1 else');
                ennemieSkill();
                break;
            };
        case 2 :
            ennemieAction();
            console.log('actionAcc case2');
            break;
    };
    // let actions = [ennemieAttack(), ennemieSkill()];
    // actions[Math.floor(Math.random() * actions.length)];
    // console.log('random');
    // console.log(actions[Math.floor(Math.random() * actions.length)]);
    // return actions[Math.floor(Math.random() * actions.length)];
}

function ennemieAttack()
{
    let reduc = 1;
    if(accessoryActionAlly == 'Réduction de dégâts')
    {
        reduc = 1 - (allyData.accessory.StatAction * 0.01);
        accessoryActionAlly = 'none';
        console.log('atk ennemy reduc');
    }
    let rawDamage = calculRawDamage('ennemie', 'base');
    let damage = Math.round(rawDamage * checkActionElement('baseEnnemie') * checkActionType('EnnemieToAlly') * checkActionCategory('EnnemieToAlly') * reduc);

    damageInflict('EnnemieToAlly', damage);
    rechargeEnergy('ennemie');

    setEnnemieTurn();
}

function ennemieSkill()
{
    let reduc = 1;
    if(accessoryActionAlly == 'Réduction de dégâts')
    {
        reduc = 1 - (allyData.accessory.StatAction * 0.01);
        accessoryActionAlly = 'none';
        console.log('skill ennemy reduc');
    }
    let rawDamage = calculRawDamage('ennemie', 'skill');
    let damage = Math.round(rawDamage * checkActionElement('skillEnnemie') * checkActionType('EnnemieToAlly') * checkActionCategory('EnnemieToAlly') * reduc);

    // here check if energy is suffisent, if not break, keep the check even with made the disable function
    actualEnnemieEnergy = actualEnnemieEnergy - ennemieData.weapon.EnergyCost;

    // console.log(actualAllyEnergy);

    damageInflict('EnnemieToAlly', damage);
    rechargeEnergy('ennemie');

    // console.log(actualAllyEnergy);

    setEnnemieTurn();
}

function ennemieAction()
{
    switch(ennemieData.accessory.NomTypeAction)
    {
        case "Réduction de dégâts" :
            accessoryActionEnnemie = "Réduction de dégâts";
            break;
        case "Protection Magique" :
            accessoryActionEnnemie = "Protection Magique";
            break;
        case "Protection Physique" :
            accessoryActionEnnemie = "Protection Physique";
            break;
    };

    actualEnnemieEnergy = actualEnnemieEnergy - ennemieData.accessory.EnergyCost;

    rechargeEnergy('ennemie');

    setEnnemieEnergy();
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
    let skillButton = document.getElementById('skillButton');
    let actionButton = document.getElementById('actionButton');
    var allyEnergyInfo = actualAllyEnergy + "/" + maxAllyEnergy;
    let bar = document.getElementById('actualAllyEnergy');
    bar.innerText = allyEnergyInfo;
    // test pour activer/desactiver l'action
    switch(energyActionEnough)
    {
        case true :
            if(actualAllyEnergy < allyData.accessory.EnergyCost)
            {
                actionButton.classList.add('disabled');
                actionButton.setAttribute('onclick','');
                energyActionEnough = false;
            };
            break;
        case false :
            if(actualAllyEnergy >= allyData.accessory.EnergyCost)
            {
                actionButton.classList.remove('disabled');
                actionButton.setAttribute('onclick','');
                energyActionEnough = true;
            };
            break;
    }
    // test pour activer/desactiver la compétance
    switch(energySkillEnough)
    {
        case true :
            if(actualAllyEnergy < allyData.weapon.EnergyCost)
            {
                skillButton.classList.add('disabled');
                skillButton.setAttribute('onclick','');
                energySkillEnough = false;
            };
            break;
        case false :
            if(actualAllyEnergy >= allyData.weapon.EnergyCost)
            {
                skillButton.classList.remove('disabled');
                skillButton.setAttribute('onclick','allySkill()');
                energySkillEnough = true;
            };
            break;
    }
}

function setEnnemieEnergy()
{
    var ennemieEnergyInfo = actualEnnemieEnergy + "/" + maxEnnemieEnergy;
    let bar = document.getElementById('actualEnnemieEnergy');
    bar.innerText = ennemieEnergyInfo;
}

// function to apply each offensive action

function setAllyTurn()
{
    setAllyEnergy();
    setEnnemieHp();
}

function setEnnemieTurn()
{
    setEnnemieEnergy();
    setAllyHp();
}



// check action to return multiplicator



function checkActionElement(action) // method to send element multiplicator depending of the case
{
    switch (action)
    {
        case 'baseAlly' :
            if(allyData.weapon.Element == allyData.weapon.ElementBase)
            {
                return 1.5;
            }
            else
            {
                return 1;
            };
        case 'skillAlly' :
            if(allyData.weapon.Element == allyData.weapon.ElementSkill)
            {
                return 1.75;
            }
            else
            {
                return 1;
            };
        case 'baseEnnemie' :
            if(ennemieData.weapon.Element == ennemieData.weapon.ElementBase)
            {
                return 1.5;
            }
            else
            {
                return 1;
            };
        case 'skillEnnemie' :
            if(ennemieData.weapon.Element == ennemieData.weapon.ElementSkill)
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
    typeWeaponAlly = typeWeaponAlly[0];
    let typeWeaponEnnemie = types.filter((typeWeapon) => typeWeapon.name == ennemieData.weapon.Type);
    typeWeaponEnnemie = typeWeaponEnnemie[0];
    // select the weapon type and not the personnage type for an amelioration where a caracter will have a possbility to choose all weapon from a category or a type
    switch (action)
    {
        case 'AllyToEnnemie' :
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
        case 'EnnemieToAlly' :
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
    categoryWeaponAlly = categoryWeaponAlly[0];
    let categoryWeaponEnnemie = categorys.filter((categoryWeapon) => categoryWeapon.name == ennemieData.weapon.Category);
    categoryWeaponEnnemie = categoryWeaponEnnemie[0];
    // select the weapon category and not the personnage category for an amelioration where a caracter will have a possbility to choose all weapon from a category or a category
    switch (action)
    {
        case 'AllyToEnnemie' :
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
        case 'EnnemieToAlly' :
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

function calculRawDamage(who, what) // function to calculate damage depending the case indicated
{
    // intialize some variable
    let perso;
    let adversaire;
    let attackStat;
    let magicStat;
    let resiMagic = 1;
    let resiPhysic = 1;
    
    // define who does the action
    switch(who)
    { 
        case 'ally' :
            perso = allyData;
            adversaire = ennemieData;
            if(accessoryActionEnnemie == 'Protection Magique')
            {
                resiMagic = 1 - (ennemieData.accessory.StatAction * 0.01);
                accessoryActionEnnemie ='none';
                console.log('ally magi res');
            };
            if(accessoryActionEnnemie == 'Protection Physique')
            {
                resiPhysic = 1 - (ennemieData.accessory.StatAction * 0.01);
                accessoryActionEnnemie ='none';
                console.log('ally atck res');
            };
            break;
        case 'ennemie' :
            perso = ennemieData;
            adversaire = allyData;
            if(accessoryActionAlly == 'Protection Magique')
            {
                resiMagic = 1 - (perso.accessory.StatAction * 0.01);
                accessoryActionAlly = 'none';
                console.log('ennemy magi res');
            };
            if(accessoryActionAlly == 'Protection Physique')
            {
                resiPhysic = 1 - (perso.accessory.StatAction * 0.01);
                accessoryActionAlly = 'none';
                console.log('ennemy atck res');
            };
            break;
    }

    // define if skill or base attck
    switch(what)
    {
        case 'base' :
            attackStat = perso.weapon.baseAttack;
            magicStat = perso.weapon.baseMagic;
            break;
        case 'skill' :
            attackStat = perso.weapon.skillAttack;
            magicStat = perso.weapon.skillMagic;
            break;
    }

    let physic = (perso.personnage.Attack * (attackStat / 10) + perso.accessory.Attack);
    let magic = (perso.personnage.Magic * (magicStat / 10) + perso.accessory.Magic);
    let physicDamage = (physic - adversaire.accessory.Defense) * resiPhysic;
    let magicDamage = (magic - adversaire.accessory.Resistance) * resiMagic;

    if(resiPhysic != 1)
    {
        reducedDamge = (physic - adversaire.accessory.Defense) - physicDamage;
    }
    else if(resiMagic != 1)
    {
        reducedDamge = (magic - adversaire.accessory.Resistance) - magicDamage;
    } 

    if(physicDamage < 0)
    {
        physicDamage = 0;
    }
    if(magicDamage < 0)
    {
        magicDamage = 0;
    }

    return physicDamage + magicDamage;
}

function rechargeEnergy(who) // function to recover energy and make no overflow of energy
{
    switch(who)
    {
        case 'ally' :
            actualAllyEnergy = parseFloat(allyData.accessory.Recovery) + parseFloat(actualAllyEnergy);
            if(actualAllyEnergy > allyData.personnage.Energy)
            {
                actualAllyEnergy = allyData.personnage.Energy;
            };
            break;
        case 'ennemie' :
            actualEnnemieEnergy = parseFloat(ennemieData.accessory.Recovery) + parseFloat(actualEnnemieEnergy);
            if(actualEnnemieEnergy > ennemieData.personnage.Energy)
            {
                actualEnnemieEnergy = ennemieData.personnage.Energy;
            };
            break;
    }
}

function damageInflict(who, damage) // function to inflict the damage and check if 0 hp
{
    switch(who)
    {
        case 'EnnemieToAlly' :
            actualAllyHp = parseFloat(actualAllyHp) - parseFloat(damage);
            if(actualAllyHp <= 0)
            {
                actualAllyHp = allyData.personnage.Hp; // here Game over to do
            };
            break;
        case 'AllyToEnnemie' :
            actualEnnemieHp = parseFloat(actualEnnemieHp) - parseFloat(damage);
            if(actualEnnemieHp <= 0)
            {
                actualEnnemieHp = ennemieData.personnage.Hp; // here Game over to do
            };
            break;
    }
}


// log creation


function actionLogs(who, what, damage)
{
    let newLogs = logLine.cloneNode();
    let firstUser = logNames.cloneNode();
    let otherUser = logNames.cloneNode();
    let accessoryOpposed;
    if(!damage) { //If the optional argument is not there, create a new variable with that name.
		let damage = "none";
	}
    switch(who)
    {
        case 'ally' :
            firstUser.innerText = allyData.personnage.Name;
            firstUser.classList.add('persoUser');
            otherUser.innerText = ennemieData.personnage.Name;
            otherUser.classList.add('ennemieUser');
            accessoryOpposed = accessoryActionEnnemie;
            break;
        case 'ennemie' :
            firstUser.innerText = ennemieData.personnage.Name;
            firstUser.classList.add('ennemieUser');
            otherUser.innerText = allyData.personnage.Name;
            otherUser.classList.add('persoUser');
            accessoryOpposed = accessoryActionAlly;
            break;
    }
    switch(what)
            {
                case 'attack' :
                    switch(accessoryOpposed)
                    {
                        case "Réduction de dégâts" :
                            newLogs.innerText = firstUser + ' ';
                            break;
                        case "Protection Magique" :
                            break;
                        case "Protection Physique" :
                            break;
                        case "none" :
                            break;
                    };
                case 'skill' :
                    switch(accessoryOpposed)
                    {
                        case "Réduction de dégâts" :
                            break;
                        case "Protection Magique" :
                            break;
                        case "Protection Physique" :
                            break;
                        case "none" :
                            break;
                    };
                case 'action' :
            }
}


// when loading the page


setAllyHp();
setEnnemieHp();
setAllyEnergy();
setEnnemieEnergy();