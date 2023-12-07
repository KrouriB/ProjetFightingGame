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