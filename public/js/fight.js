const ennemieData = JSON.parse(ennemie.replaceAll('&quot;', '"'));
const allyData = JSON.parse(ally.replaceAll('&quot;', '"'));
var ennemieInfo = JSON.parse(ennemieInfo.replaceAll('&quot;', '"'));
var allyInfo = JSON.parse(allyInfo.replaceAll('&quot;', '"'));

function allyAttack()
{

    // console.log(ennemieData);
    console.log(allyData);
    // console.log(ennemieInfo);
    // console.log(allyInfo);
    // console.log(ennemie.replaceAll('&quot;', '"'));
}

function checkActionElement(action)
{
    if(action == base)
    {

    }
    else if(action == skill)
    {

    }
    else
    console.log(allyData.personnage.Element == allyData.weapon.ElementBase)
}
