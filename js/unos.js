document.addEventListener("DOMContentLoaded", function () {
    function validateForm(event, isUpdating) {
        var slanjeForme = true;

        // naslov (5 - 80)
        var poljeNaslov = document.getElementById("naslov");
        var naslov = poljeNaslov.value;
        if (naslov.length < 5 || naslov.length > 80) {
            slanjeForme = false;
            poljeNaslov.style.border = "1px solid rgb(174, 19, 19)";
            document.getElementById("poruka-naslov").innerHTML = "Naslov mora imati između 5 i 80 znakova.";
        } else {
            poljeNaslov.style.border = "1px solid green";
            document.getElementById("poruka-naslov").innerHTML = "";
        }

        // kratki sadrzaj (10 - 200)
        var poljeKratkiSadrzaj = document.getElementById("kratki-sadrzaj");
        var kratkiSadrzaj = poljeKratkiSadrzaj.value;
        if (kratkiSadrzaj.length < 10 || kratkiSadrzaj.length > 200) {
            slanjeForme = false;
            poljeKratkiSadrzaj.style.border = "1px solid rgb(174, 19, 19)";
            document.getElementById("poruka-kratki-sadrzaj").innerHTML = "Kratki sadržaj mora imati između 10 i 200 znakova.";
        } else {
            poljeKratkiSadrzaj.style.border = "1px solid green";
            document.getElementById("poruka-kratki-sadrzaj").innerHTML = "";
        }

        // sadržaj
        var poljeSadrzaj = document.getElementById("sadrzaj");
        var sadrzaj = poljeSadrzaj.value;
        if (sadrzaj.length == 0) {
            slanjeForme = false;
            poljeSadrzaj.style.border = "1px solid rgb(174, 19, 19)";
            document.getElementById("poruka-sadrzaj").innerHTML = "Sadržaj mora biti unesen";
        } else {
            poljeSadrzaj.style.border = "1px solid green";
            document.getElementById("poruka-sadrzaj").innerHTML = "";
        }

        // Kategorija mora biti odabrana
        var poljeKategorija = document.getElementById("kategorija");
        if (poljeKategorija.selectedIndex == 0) {
            slanjeForme = false;
            poljeKategorija.style.border = "1px dashed rgb(174, 19, 19)";
            document.getElementById("poruka-kategorija").innerHTML = "Kategorija mora biti odabrana";
        } else {
            poljeKategorija.style.border = "1px solid green";
            document.getElementById("poruka-kategorija").innerHTML = "";
        }

        // Slika mora biti unesena 
        var poljeSlika = document.getElementById("slika");
        var slika = poljeSlika.value;
        if (slika.length == 0 && !isUpdating) {
            slanjeForme = false;
            poljeSlika.style.border = "1px dashed rgb(174, 19, 19)";
            document.getElementById("poruka-slika").innerHTML = "Slika mora biti unesena";
        } else {
            poljeSlika.style.border = "1px solid green";
            document.getElementById("poruka-slika").innerHTML = "";
        }

        if (!slanjeForme) {
            event.preventDefault();
        }
    }

    var submitBtn = document.getElementById("submit");
    if (submitBtn) {
        submitBtn.onclick = function (event) {
            validateForm(event, false);
        };
    }

    var azurirajBtn = document.getElementById("azuriraj");
    if (azurirajBtn) {
        azurirajBtn.onclick = function (event) {
            validateForm(event, true);
        };
    }
});
