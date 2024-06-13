document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("registracija").onclick = function(event) {
        var slanjeForme = true;
    
        var poljeKorisnickoIme = document.getElementById("korisnicko-ime");
        var korisnickoIme = poljeKorisnickoIme.value;
        if(korisnickoIme.length < 5 || korisnickoIme.length > 30) {
            slanjeForme = false;
            poljeKorisnickoIme.style.border = "1px solid red";
            document.getElementById("poruka-korisnicko-ime").innerHTML = "Korisničko ime mora imati između 5 i 30 znakova.";
        } else {
            poljeKorisnickoIme.style.border = "1px solid green";
            document.getElementById("poruka-korisnicko-ime").innerHTML = "";
        }

        var poljeLozinka1 = document.getElementById("lozinka1");
        var lozinka1 = poljeLozinka1.value.trim();
        if(lozinka1.length < 5 || lozinka1.length == 0) {
            slanjeForme = false;
            poljeLozinka1.style.border = "1px solid red";
            document.getElementById("poruka-lozinka1").innerHTML = "Odaberite lozinku s najmanje 5 znakova.";
        } else {
            poljeLozinka1.style.border = "1px solid green";
            document.getElementById("poruka-lozinka1").innerHTML = "";
        }

        var poljeLozinka2 = document.getElementById("lozinka2");
        var lozinka2 = poljeLozinka2.value.trim();
        if(lozinka1 != lozinka2 || lozinka2 == 0) {
            slanjeForme = false;
            poljeLozinka1.style.border = "1px solid red";
            poljeLozinka2.style.border = "1px solid red";
            document.getElementById("poruka-lozinka2").innerHTML = "Lozinke moraju biti jednake";
        } else {
            poljeLozinka1.style.border = "1px solid green";
            poljeLozinka2.style.border = "1px solid green";
            document.getElementById("poruka-lozinka2").innerHTML = "";
        }
    
        var poljeIme = document.getElementById("ime");
        var ime = poljeIme.value;
        if(ime.length == 0) {
            slanjeForme = false;
            poljeIme.style.border = "1px solid red";
            document.getElementById("poruka-ime").innerHTML = "Ime mora biti uneseno";
        } else {
            poljeIme.style.border = "1px solid green";
            document.getElementById("poruka-ime").innerHTML = "";
        }

        var poljePrezime = document.getElementById("prezime");
        var prezime = poljePrezime.value;
        if(prezime.length == 0) {
            slanjeForme = false;
            poljePrezime.style.border = "1px solid red";
            document.getElementById("poruka-prezime").innerHTML = "Prezime mora biti uneseno";
        } else {
            poljePrezime.style.border = "1px solid green";
            document.getElementById("poruka-prezime").innerHTML = "";
        }

        if(!slanjeForme) {
            event.preventDefault();
        }
    
    }   
});