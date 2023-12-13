const themes = {
	base: {
		"--primary": "#ffffff",
        "--secondary": "#D9D9D9",
        "--tertiary": "#3A3A3A",
        "--button": "#4E4E4E",
        "--underhealthBar": "#F00000",
        "--healthBar": "#00D415",
        "--underEnergyBar": "#3A3A3A",
        "--energyBar": "#0066FF",
        "--money: ": "#FFB800",
        "--positive": "#0075FF",
        "--negative": "#FF0000",
        "--frist": "#FFB800",
        "--second": "#C0C0C0",
        "--third": "#CD7F32",
        "--unselected": "#ff000066",
        "--selected": "#001AFF99",
        "--text": "#000000",
        "--textReverse": "#FFFFFF",
	},
	dark: { // to change
		"--primary": "#ffffff",
        "--secondary": "#D9D9D9",
        "--tertiary": "#3A3A3A",
        "--button": "#4E4E4E",
        "--underhealthBar": "#F00000",
        "--healthBar": "#00D415",
        "--underEnergyBar": "#3A3A3A",
        "--energyBar": "#0066FF",
        "--money: ": "#FFB800",
        "--positive": "#0075FF",
        "--negative": "#FF0000",
        "--frist": "#FFB800",
        "--second": "#C0C0C0",
        "--third": "#CD7F32",
        "--unselected": "#ff000066",
        "--selected": "#001AFF99",
        "--text": "#000000",
        "--textReverse": "#FFFFFF",
	},
};

function deleteUser()
{
    let deleteAsk = prompt("Vous êtes sur de vouoir supprimer votre compte ? dans ce cas rentrer << Supprimer le compte >>");
    if (deleteAsk == "Supprimer le compte") {
        window.location = "deleteUser";
        window.location.replace();
    } else {
        alert("La suppression du compte n'aura pas lieu");
    }
}

$(document).ready(function() {
    var i = 5000
    $(this).delay(1000)
    $(".flash").each(function() {
        if ($(this).text().length > 0) {
            $(this).slideDown(500, function() {
                $(this).delay(i).slideUp(500)
                i += 625
            })
        }
    })
})

const img = document.getElementById('carousel');
const rightBtn = document.getElementById('right-btn');
const leftBtn = document.getElementById('left-btn');

// Images are from unsplash
let pictures = [
    "/img/character/axesman.webp",
    "/img/character/swordsman.webp",
    "/img/character/spearsman.webp",
    "/img/character/mage_tattou_midJourney_modified.webp",
    "/img/character/mage_book_midjourney_modified.webp",
    "/img/character/mageWand.webp",
    "/img/character/fighter.webp",
    "/img/character/thief.webp",
    "/img/character/ranger.webp",
]

img.src = pictures[0];
let position = 0;

const moveRight = () => {
    if (position >= pictures.length - 1) {
        position = 0
        img.src = pictures[position];
        return;
    }
    img.src = pictures[position + 1];
    position++;
}

const moveLeft = () => {
    if (position < 1) {
        position = pictures.length - 1;
        img.src = pictures[position];
        return;
    }
    img.src = pictures[position - 1];
    position--;
}

rightBtn.addEventListener("click", moveRight);
leftBtn.addEventListener("click", moveLeft);