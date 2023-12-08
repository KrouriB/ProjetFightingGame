// creation of constant and variable
const ennemieData = JSON.parse(ennemie.replaceAll('&quot;', '"'));
const allyData = JSON.parse(ally.replaceAll('&quot;', '"'));
const elements = JSON.parse(element.replaceAll('&quot;', '"'));
const types = JSON.parse(typeOfWeapon.replaceAll('&quot;', '"'));
const categorys = JSON.parse(categoryOfWeapon.replaceAll('&quot;', '"'));
// log div selected + default log to use
const logDiv = document.getElementById("logs");
const logLine = document.createElement("p");
logLine
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
var accessoryAction = 'none';
var turnDamage = 0;
var reducedDamage = 0;
// inialize the turn to wait to 0
var waitSkillAlly = 0;
var waitActionAlly = 0;
var waitSkillEnnemie = 0;
var waitActionEnnemie = 0;
// value pourcent of life and enregy for bar
var pourecentMultiplicatorAllyHp = 1;
var pourecentMultiplicatorEnnemieHp = 1;
var pourecentMultiplicatorAllyEnergy = 1;
var pourecentMultiplicatorEnnemieEnergy = 1;
var pourecentAllyHp = "100%";
var pourecentEnnemieHp = "100%";
var pourecentAllyEnergy = "100%";
var pourecentEnnemieEnergy = "100%";
var infoFight = {
    "--healthAllyInfo": pourecentAllyHp,
    "--healthEnnemieInfo": pourecentEnnemieHp,
    "--energyAllyInfo": pourecentAllyEnergy,
    "--energyEnnemieInfo": pourecentEnnemieEnergy,
}


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
    let damage = Math.round(rawDamage * checkActionElement('atkFromAlly') * checkActionType('AllyToEnnemie') * checkActionCategory('AllyToEnnemie') * reduc);
    // console.log(checkActionElement('atkFromAlly'))
    
    if(reduc != 1)
    {
        reducedDamage = ((Math.round(rawDamage * checkActionElement('atkFromAlly') * checkActionType('AllyToEnnemie') * checkActionCategory('AllyToEnnemie'))) - damage);
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
    let damage = Math.round(rawDamage * checkActionElement('skillFromAlly') * checkActionType('AllyToEnnemie') * checkActionCategory('AllyToEnnemie') * reduc);

    if(reduc != 1)
    {
        reducedDamage = (Math.round(rawDamage * checkActionElement('skillFromAlly') * checkActionType('AllyToEnnemie') * checkActionCategory('AllyToEnnemie'))) - damage;
    }
    turnDamage = damage;

    // here check if energy is suffisent, if not break, keep the check even with made the disable function
    actualAllyEnergy = actualAllyEnergy - allyData.weapon.EnergyCost;
    waitSkillAlly = allyData.weapon.turnWait;

    damageInflict('AllyToEnnemie', damage);
    rechargeEnergy('ally');


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
    waitActionAlly = allyData.accessory.turnWait;

    rechargeEnergy('ally');


    setAllyEnergy();

    actionLogs('ally','action');
    useEnnemieAction();
}


// Ennemy Action


function useEnnemieAction() // function to select randomly enemys action
{
    let action = 0;
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
    let damage = Math.round(rawDamage * checkActionElement('atkFromEnnemie') * checkActionType('EnnemieToAlly') * checkActionCategory('EnnemieToAlly') * reduc);

    if(reduc != 1)
    {
        reducedDamage = (Math.round(rawDamage * checkActionElement('atkFromEnnemie') * checkActionType('EnnemieToAlly') * checkActionCategory('EnnemieToAlly'))) - damage;
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
    let damage = Math.round(rawDamage * checkActionElement('skillFromEnnemie') * checkActionType('EnnemieToAlly') * checkActionCategory('EnnemieToAlly') * reduc);

    if(reduc != 1)
    {
        reducedDamage = (Math.round(rawDamage * checkActionElement('skillFromEnnemie') * checkActionType('EnnemieToAlly') * checkActionCategory('EnnemieToAlly'))) - damage;
    }
    turnDamage = damage;

    // here check if energy is suffisent, if not break, keep the check even with made the disable function
    actualEnnemieEnergy = actualEnnemieEnergy - ennemieData.weapon.EnergyCost;
    waitSkillEnnemie = ennemieData.weapon.turnWait

    damageInflict('EnnemieToAlly', damage);
    rechargeEnergy('ennemie');


    actionLogs('ennemie','skill');
    setEnnemieTurn();
}

function ennemieAction()
{
    switch(ennemieData.accessory.NomTypeAction)
    {
        case "Réduction de dégâts" :
            accessoryActionEnnemie = ennemieData.accessory.NomTypeAction;
            break;
        case "Protection Magique" :
            accessoryActionEnnemie = ennemieData.accessory.NomTypeAction;
            break;
        case "Protection Physique" :
            accessoryActionEnnemie = ennemieData.accessory.NomTypeAction;
            break;
    };

    actualEnnemieEnergy = actualEnnemieEnergy - ennemieData.accessory.EnergyCost;
    waitActionEnnemie = ennemieData.accessory.turnWait;

    rechargeEnergy('ennemie');


    actionLogs('ennemie','action');
    setEnnemieEnergy();
}


// update of view


function setAllyHp()
{
    let bar = document.getElementById('actualAllyHp');
    pourecentAllyHp = ((actualAllyHp / maxAllyHp)*100) + "%";
    document.documentElement.style.setProperty('--healthAllyInfo', pourecentAllyHp);
    bar.innerText = actualAllyHp + "/" + allyData.personnage.Life;
}

function setEnnemieHp()
{
    let bar = document.getElementById('actualEnnemieHp');
    pourecentEnnemieHp = ((actualEnnemieHp / maxEnnemieHp)*100) + "%";
    document.documentElement.style.setProperty('--healthEnnemieInfo', pourecentEnnemieHp);
    bar.innerText = actualEnnemieHp + "/" + ennemieData.personnage.Life;
}

function setAllyEnergy()
{
    let skillButton = document.getElementById('skillButton');
    let actionButton = document.getElementById('actionButton');
    let bar = document.getElementById('actualAllyEnergy');
    pourecentAllyEnergy = ((actualAllyEnergy / maxAllyEnergy)*100) + "%";
    document.documentElement.style.setProperty('--energyAllyInfo', pourecentAllyEnergy);
    bar.innerText = actualAllyEnergy + "/" + allyData.personnage.Energy;
    // test pour activer/desactiver l'action
    switch(energyActionEnough)
    {
        case true :
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
            if(actualAllyEnergy >= allyData.accessory.EnergyCost && waitActionAlly == 0)
            {
                actionButton.classList.remove('disabled');
                actionButton.disabled = false;
                actionButton.setAttribute('onclick','allyAction()');
                energyActionEnough = true;
            }
            else if(waitActionAlly > 0)
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
            }
            else if(waitSkillAlly > 0)
            {
                waitSkillAlly = waitSkillAlly - 1;
            };
            
            break;
    }
}

function setEnnemieEnergy()
{
    let bar = document.getElementById('actualEnnemieEnergy');
    pourecentEnnemieEnergy = ((actualEnnemieEnergy / maxEnnemieEnergy)*100) + "%";
    document.documentElement.style.setProperty('--energyEnnemieInfo', pourecentEnnemieEnergy);
    bar.innerText = actualEnnemieEnergy + "/" + ennemieData.personnage.Energy;
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
    let selfBonus = 1;
    let elementeWeapon;
    let elementOpposant;
    switch (action)
    {
        case 'atkFromAlly' :
            elementeWeapon = elements.filter((elem) => elem.name == allyData.weapon.ElementBase);
            elementOpposant = elements.filter((elem) => elem.name == ennemieData.personnage.Element);
            elementeWeapon = elementeWeapon[0];
            elementOpposant = elementOpposant[0];
            if(allyData.weapon.Element == allyData.weapon.ElementBase)
            {
                selfBonus = 1.5;
            };
            if(elementeWeapon.advantage == elementOpposant.id)
            {
                console.log('advantage', elementeWeapon, elementOpposant)
                return elementeWeapon.advantageMultiplicator * selfBonus;
            }
            else if(elementeWeapon.disadvantage == elementOpposant.id)
            {
                console.log('disadvantage')
                return elementeWeapon.disadvantageMultiplicator * selfBonus;
            }
            else
            {
                console.log(selfBonus)
                return 1 * selfBonus;
            };
        case 'skillFromAlly' :
            elementeWeapon = elements.filter((elem) => elem.name == allyData.weapon.ElementSkill);
            elementOpposant = elements.filter((elem) => elem.name == ennemieData.personnage.Element);
            elementeWeapon = elementeWeapon[0];
            elementOpposant = elementOpposant[0];
            if(allyData.weapon.Element == allyData.weapon.ElementSkill)
            {
                selfBonus = 1.75;
            };
            if(elementeWeapon.advantage == elementOpposant.id)
            {
                return elementeWeapon.advantageMultiplicator * selfBonus;
            }
            else if(elementeWeapon.disadvantage == elementOpposant.id)
            {
                return elementeWeapon.disadvantageMultiplicator * selfBonus;
            }
            else
            {
                return 1 * selfBonus;
            };
        case 'atkFromEnnemie' :
            elementeWeapon = elements.filter((elem) => elem.name == ennemieData.weapon.ElementBase);
            elementOpposant = elements.filter((elem) => elem.name == allyData.personnage.Element);
            elementeWeapon = elementeWeapon[0];
            elementOpposant = elementOpposant[0];
            if(ennemieData.weapon.Element == ennemieData.weapon.ElementBase)
            {
                selfBonus = 1.5;
            };
            if(elementeWeapon.advantage == elementOpposant.id)
            {
                return elementeWeapon.advantageMultiplicator * selfBonus;
            }
            else if(elementeWeapon.disadvantage == elementOpposant.id)
            {
                return elementeWeapon.disadvantageMultiplicator * selfBonus;
            }
            else
            {
                return 1 * selfBonus;
            };
        case 'skillFromEnnemie' :
            elementeWeapon = elements.filter((elem) => elem.name == ennemieData.weapon.ElementSkill);
            elementOpposant = elements.filter((elem) => elem.name == allyData.personnage.Element);
            elementeWeapon = elementeWeapon[0];
            elementOpposant = elementOpposant[0];
            if(ennemieData.weapon.Element == ennemieData.weapon.ElementSkill)
            {
                selfBonus = 1.75;
            };
            if(elementeWeapon.advantage == elementOpposant.id)
            {
                return elementeWeapon.advantageMultiplicator * selfBonus;
            }
            else if(elementeWeapon.disadvantage == elementOpposant.id)
            {
                return elementeWeapon.disadvantageMultiplicator * selfBonus;
            }
            else
            {
                return 1 * selfBonus;
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

    let physic = (perso.personnage.Attack * (attackStat / 40) + perso.accessory.Attack);
    let magic = (perso.personnage.Magic * (magicStat / 40) + perso.accessory.Magic);
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
                window.location = "fight/lose";
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
                window.location = "fight/win";
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

    switch(who)
    {
        case 'ally' :
            firstUserData = allyData;
            accessoryUsed = accessoryActionAlly;
            firstUser = '<span class="persoUser">'+allyData.personnage.Name+'</span>';
            otherUser = '<span class="persoBot">'+ennemieData.personnage.Name+'</span>';
            break;
        case 'ennemie' :
            firstUserData = ennemieData;
            accessoryUsed = accessoryActionEnnemie;
            firstUser = '<span class="persoBot">'+ennemieData.personnage.Name+'</span>';
            otherUser = '<span class="persoUser">'+allyData.personnage.Name+'</span>';
            break;
    }
    
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
            newLogs.innerHTML = firstUser + ' a utiliser ' + firstUserData.accessory.actionName + ' il aura le bonus ' + accessoryUsed;
            break;
    }
    logDiv.appendChild(newLogs);
    
}

function lose()
{
    attackButton.disabled = true;
    skillButton.disabled = true;
    actionButton.disabled = true;
    loseButton.disabled = true;
    window.location = "fight/lose";
    window.location.replace();
}

function showLogMobile()
{
    let logs = document.getElementById('logPart');
    logs.classList.add("mobileLog");
}

function noLogMobile()
{
    let logs = document.getElementById('logPart');
    logs.classList.remove("mobileLog");
}


// when loading the page


setAllyHp();
setEnnemieHp();
setAllyEnergy();
setEnnemieEnergy();