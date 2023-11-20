// creation of constant and variable
const ennemieData = JSON.parse(ennemie.replaceAll('&quot;', '"'));
const allyData = JSON.parse(ally.replaceAll('&quot;', '"'));
var elements = JSON.parse(element.replaceAll('&quot;', '"'));
var types = JSON.parse(typeOfWeapon.replaceAll('&quot;', '"'));
var categorys = JSON.parse(categoryOfWeapon.replaceAll('&quot;', '"'));
// log div selected + default log to use
const logDiv = document.getElementById("logs");
const logLine = document.createElement("p");
logLine.classList.add("logLine");
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
//value of damaged reduced and damage done on turn and action type if set
var turnDamage = 0;
var reducedDamage = 0;
var accessoryAction = 'none';
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
        accessoryAction = accessoryActionEnnemie;
        accessoryActionEnnemie = 'none';
    }
    let rawDamage = calculRawDamage('ally', 'base');
    let damage = Math.round(rawDamage * checkActionElement('baseAlly') * checkActionType('AllyToEnnemie') * checkActionCategory('AllyToEnnemie') * reduc);
    
    if(reduc != 1)
    {
        reducedDamage = ((Math.round(rawDamage * checkActionElement('baseAlly') * checkActionType('AllyToEnnemie') * checkActionCategory('AllyToEnnemie'))) - damage);
    }
    turnDamage = damage;

    damageInflict('AllyToEnnemie', damage);
    rechargeEnergy('ally');

    setAllyTurn();
    actionLogs('ally','attack');
    useEnnemieAction();
}

function allySkill()
{
    let reduc = 1;
    if(accessoryActionEnnemie == 'Réduction de dégâts')
    {
        reduc = 1 - (ennemieData.accessory.StatAction * 0.01);
        accessoryAction = accessoryActionEnnemie;
        accessoryActionEnnemie = 'none';
    }
    let rawDamage = calculRawDamage('ally', 'skill');
    let damage = Math.round(rawDamage * checkActionElement('skillAlly') * checkActionType('AllyToEnnemie') * checkActionCategory('AllyToEnnemie') * reduc);

    if(reduc != 1)
    {
        reducedDamage = (Math.round(rawDamage * checkActionElement('skillAlly') * checkActionType('AllyToEnnemie') * checkActionCategory('AllyToEnnemie'))) - damage;
        turnDamage = damage;
    }
    turnDamage = damage;

    // here check if energy is suffisent, if not break, keep the check even with made the disable function
    actualAllyEnergy = actualAllyEnergy - allyData.weapon.EnergyCost;

    damageInflict('AllyToEnnemie', damage);
    rechargeEnergy('ally');

    waitSkillAlly = allyData.weapon.turnWait;

    setAllyTurn();
    actionLogs('ally','skill');
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

    waitActionAlly = allyData.accessory.turnWait;

    setAllyEnergy();

    actionLogs('ally','action');
    useEnnemieAction();
}


// Ennemy Action


function useEnnemieAction() // function to select randomly enemys action
{
    let action = 1;
    let what;

    if(actualEnnemieEnergy >= ennemieData.weapon.EnergyCost && waitSkillEnnemie == 0)
    {
        action += 1;
        what = 'skill';
    }
    else
    {
        if(waitSkillEnnemie > 0)
        {
            waitSkillEnnemie = waitSkillEnnemie - 1; // reduce skill wait turn
        };
    };

    if(actualEnnemieEnergy >= ennemieData.accessory.EnergyCost && waitActionEnnemie == 0)
    {
        action += 1;
        what = 'action';
    }
    else
    {
        if(waitActionEnnemie > 0)
        {
            waitActionEnnemie = waitActionEnnemie - 1; // reduce action wait turn
        };
    };

    switch(Math.floor(Math.random() * action))
    {
        case 0 :
            ennemieAttack();
            break;
        case 1 :
            if(action == 1)
            {
                switch(what)
                {
                    case 'skill' :
                        ennemieSkill();
                        break;
                    case 'action' :
                        ennemieAction();
                        break;
                };
            }
            else
            {
                ennemieSkill();
                break;
            };
        case 2 :
            ennemieAction();
            break;
    };
}

function ennemieAttack()
{
    let reduc = 1;
    if(accessoryActionAlly == 'Réduction de dégâts')
    {
        reduc = 1 - (allyData.accessory.StatAction * 0.01);
        accessoryAction = accessoryActionAlly;
        accessoryActionAlly = 'none';
    }
    let rawDamage = calculRawDamage('ennemie', 'base');
    let damage = Math.round(rawDamage * checkActionElement('baseEnnemie') * checkActionType('EnnemieToAlly') * checkActionCategory('EnnemieToAlly') * reduc);

    if(reduc != 1)
    {
        reducedDamage = (Math.round(rawDamage * checkActionElement('baseEnnemie') * checkActionType('EnnemieToAlly') * checkActionCategory('EnnemieToAlly'))) - damage;
    }
    turnDamage = damage;

    damageInflict('EnnemieToAlly', damage);
    rechargeEnergy('ennemie');

    actionLogs('ennemie','attack');
    setEnnemieTurn();
}

function ennemieSkill()
{
    let reduc = 1;
    if(accessoryActionAlly == 'Réduction de dégâts')
    {
        reduc = 1 - (allyData.accessory.StatAction * 0.01);
        accessoryAction = accessoryActionAlly;
        accessoryActionAlly = 'none';
    }
    let rawDamage = calculRawDamage('ennemie', 'skill');
    let damage = Math.round(rawDamage * checkActionElement('skillEnnemie') * checkActionType('EnnemieToAlly') * checkActionCategory('EnnemieToAlly') * reduc);

    if(reduc != 1)
    {
        reducedDamage = (Math.round(rawDamage * checkActionElement('skillEnnemie') * checkActionType('EnnemieToAlly') * checkActionCategory('EnnemieToAlly'))) - damage;
    }
    turnDamage = damage;

    // here check if energy is suffisent, if not break, keep the check even with made the disable function
    actualEnnemieEnergy = actualEnnemieEnergy - ennemieData.weapon.EnergyCost;

    damageInflict('EnnemieToAlly', damage);
    rechargeEnergy('ennemie');

    waitSkillEnnemie = ennemieData.weapon.turnWait

    actionLogs('ennemie','skill');
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

    waitActionEnnemie = ennemieData.accessory.turnWait;

    actionLogs('ennemie','action');
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
    console.log(waitActionAlly,waitSkillAlly);
    let skillButton = document.getElementById('skillButton');
    let actionButton = document.getElementById('actionButton');
    var allyEnergyInfo = actualAllyEnergy + "/" + maxAllyEnergy;
    let bar = document.getElementById('actualAllyEnergy');
    bar.innerText = allyEnergyInfo;
    // test pour activer/desactiver l'action
    switch(energyActionEnough)
    {
        case true :
            console.log('energyActionEnough : ' + energyActionEnough);
            if(actualAllyEnergy < allyData.accessory.EnergyCost || waitActionAlly > 0)
            {
                actionButton.classList.add('disabled');
                actionButton.disabled = true;
                actionButton.setAttribute('onclick','');
                energyActionEnough = false;

                if(waitActionAlly > 0)
                {
                    waitActionAlly = waitActionAlly - 1;
                };
            };

            break;
        case false :
            console.log('energyActionEnough : ' + energyActionEnough);
            console.log(actualAllyEnergy);
            console.log(waitActionAlly);

            if(actualAllyEnergy >= allyData.accessory.EnergyCost && waitActionAlly == 0)
            {
                actionButton.classList.remove('disabled');
                actionButton.disabled = false;
                actionButton.setAttribute('onclick','allyAction()');
                energyActionEnough = true;
            };
            console.log(waitActionAlly > 0);
            if(waitActionAlly > 0)
            {
                waitActionAlly = waitActionAlly - 1;
            };

            break;
    }
    // test pour activer/desactiver la compétance
    switch(energySkillEnough)
    {
        case true :
            if(actualAllyEnergy < allyData.weapon.EnergyCost || waitSkillAlly > 0)
            {
                skillButton.classList.add('disabled');
                skillButton.disabled = true;
                skillButton.setAttribute('onclick','');
                energySkillEnough = false;
                
                if(waitSkillAlly > 0)
                {
                    waitSkillAlly = waitSkillAlly - 1;
                };
            };

            break;
        case false :
            if(actualAllyEnergy >= allyData.weapon.EnergyCost && waitSkillAlly == 0)
            {
                skillButton.classList.remove('disabled');
                skillButton.disabled = false;
                skillButton.setAttribute('onclick','allySkill()');
                energySkillEnough = true;
            };

            if(waitSkillAlly > 0)
            {
                waitSkillAlly = waitSkillAlly - 1;
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
                accessoryAction = accessoryActionEnnemie;
                accessoryActionEnnemie = 'none';
            };
            if(accessoryActionEnnemie == 'Protection Physique')
            {
                resiPhysic = 1 - (ennemieData.accessory.StatAction * 0.01);
                accessoryAction = accessoryActionEnnemie;
                accessoryActionEnnemie = 'none';
            };
            break;
        case 'ennemie' :
            perso = ennemieData;
            adversaire = allyData;
            if(accessoryActionAlly == 'Protection Magique')
            {
                resiMagic = 1 - (perso.accessory.StatAction * 0.01);
                accessoryAction = accessoryActionAlly;
                accessoryActionAlly = 'none';
            };
            if(accessoryActionAlly == 'Protection Physique')
            {
                resiPhysic = 1 - (perso.accessory.StatAction * 0.01);
                accessoryAction = accessoryActionAlly;
                accessoryActionAlly = 'none';
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
        reducedDamage = (physic - adversaire.accessory.Defense) - physicDamage;
    }
    else if(resiMagic != 1)
    {
        reducedDamage = (magic - adversaire.accessory.Resistance) - magicDamage;
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
    let attackButton = document.getElementById('attackButton');
    let skillButton = document.getElementById('skillButton');
    let actionButton = document.getElementById('actionButton');
    let loseButton = document.getElementById('loseButton');
    switch(who)
    {
        case 'EnnemieToAlly' :
            actualAllyHp = parseFloat(actualAllyHp) - parseFloat(damage);
            if(actualAllyHp <= 0)
            {
                attackButton.disabled = true;
                skillButton.disabled = true;
                actionButton.disabled = true;
                loseButton.disabled = true;
                window.location = "fight/lose" 
                window.location.replace();
            };
            break;
        case 'AllyToEnnemie' :
            actualEnnemieHp = parseFloat(actualEnnemieHp) - parseFloat(damage);
            if(actualEnnemieHp <= 0)
            {
                attackButton.disabled = true;
                skillButton.disabled = true;
                actionButton.disabled = true;
                loseButton.disabled = true;
                window.location = "fight/win"
                window.location.replace();
            };
            break;
    }
}


// log creation


function actionLogs(who, what)
{
    let newLogs = logLine.cloneNode();
    let firstUser;
    let otherUser;
    let firstUserData;
    let accessoryOpposed = accessoryAction;
    let accessoryUsed;

    
    // console.log(allyData)
    // switch(who)
    // {
    //     case 'ally' :
    //         firstUserData = allyData;
    //         accessoryUsed = accessoryActionAlly;
    //         break;
    //     case 'ennemie' :
    //         firstUserData = ennemieData;
    //         accessoryUsed = accessoryActionEnnemie;
    //         break;
    // }

    switch(who)
    {
        case 'ally' :
            firstUserData = allyData;
            accessoryUsed = accessoryActionAlly;
            // firstUser.innerText = allyData.personnage.Name;
            firstUser = '<span class="persoUser">'+allyData.personnage.Name+'</span>';
            // firstUser.classList.add('persoUser');
            // otherUser.innerText = ennemieData.personnage.Name;
            otherUser = '<span class="persoUser">'+ennemieData.personnage.Name+'</span>';
            // otherUser.classList.add('ennemieUser');
            break;
        case 'ennemie' :
            firstUserData = ennemieData;
            accessoryUsed = accessoryActionEnnemie;
            // firstUser.innerText = ennemieData.personnage.Name;
            firstUser = '<span class="persoUser">'+ennemieData.personnage.Name+'</span>';
            // firstUser.classList.add('ennemieUser');
            // otherUser.innerText = allyData.personnage.Name;
            otherUser = '<span class="persoUser">'+allyData.personnage.Name+'</span>';
            // otherUser.classList.add('persoUser');
            break;
    }
    // newLogs.appendChild(otherUser);
    
    switch(what)
    {
        case 'attack' :
            switch(accessoryOpposed)
            {
                case "Réduction de dégâts" :
                    newLogs.innerHTML = firstUser + ' a fait ' + turnDamage + ' de dégats avec une resistance au dégat totaux de ' + reducedDamage + ' à ' + otherUser;
                    accessoryAction = 'none';
                    turnDamage = 0;
                    reducedDamage = 0;
                    break;
                    case "Protection Magique" :
                        newLogs.innerHTML = firstUser + ' a fait ' + turnDamage + ' de dégats avec une resistance au dégats magique pure de ' + reducedDamage + ' à ' + otherUser;
                        accessoryAction = 'none';
                        turnDamage = 0;
                    reducedDamage = 0;
                    break;
                    case "Protection Physique" :
                        newLogs.innerHTML = firstUser + '  a fait ' + turnDamage + ' de dégats avec une resistance au dégats physique pure de ' + reducedDamage + ' à  ' + otherUser;
                    
                        accessoryAction = 'none';
                        turnDamage = 0;
                        reducedDamage = 0;
                        break;
                    case "none" :
                        newLogs.innerHTML = firstUser + ' a fait ' + turnDamage + ' de dégats à ' + otherUser;
                        text = ' a fait ' + turnDamage + ' de dégats à ';
                        break;
            };

            break;
        case 'skill' :
            switch(accessoryOpposed)
            {
                case "Réduction de dégâts" :
                    newLogs.innerHTML = firstUser + ' a utiliser ' + firstUserData.weapon.skillName + ' sur ' + otherUser + ', il a infliger ' + turnDamage + ' de dégats avec une resistance au dégat totaux de ' + reducedDamage;
                    
                    accessoryAction = 'none';
                    turnDamage = 0;
                    reducedDamage = 0;
                    break;
                case "Protection Magique" :
                    newLogs.innerHTML = firstUser + ' a utiliser ' + firstUserData.weapon.skillName + ' sur ' + otherUser + ', il a infliger ' + turnDamage + ' de dégats avec une resistance au dégats magique pure de ' + reducedDamage;
                    
                    accessoryAction = 'none';
                    turnDamage = 0;
                    reducedDamage = 0;
                    break;
                case "Protection Physique" :
                    newLogs.innerHTML = firstUser + ' a utiliser ' + firstUserData.weapon.skillName + ' sur ' + otherUser + ', il a infliger ' + turnDamage + ' de dégats avec une resistance au dégats physique pure de ' + reducedDamage;
                    
                    accessoryAction = 'none';
                    turnDamage = 0;
                    reducedDamage = 0;
                    break;
                case "none" :
                    newLogs.innerHTML = firstUser + ' a utiliser ' + firstUserData.weapon.skillName + ' sur ' + otherUser + ', il a infliger ' + turnDamage;
                    
                    break;
            };

            
            break;
        case 'action' :
            switch(accessoryUsed)
            {
                case "Réduction de dégâts" :
                    newLogs.innerHTML = firstUser + ' a utiliser ' + firstUserData.accessory.actionName + ' il aura le bonus ' + accessoryUsed;
                    
                    accessoryUsed = 'none';
                    break;
                case "Protection Magique" :
                    newLogs.innerHTML = firstUser + ' a utiliser ' + firstUserData.accessory.actionName + ' il aura le bonus ' + accessoryUsed;
                    
                    accessoryUsed = 'none';
                    break;
                case "Protection Physique" :
                    newLogs.innerHTML = firstUser + ' a utiliser ' + firstUserData.accessory.actionName + ' il aura le bonus ' + accessoryUsed;
                    
                    accessoryUsed = 'none';
                    break;
            };

            break;
    }
    logDiv.appendChild(newLogs);
    
}


// when loading the page


setAllyHp();
setEnnemieHp();
setAllyEnergy();
setEnnemieEnergy();