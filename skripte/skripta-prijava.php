<?php

    session_start();
    include '../connect.php';

    if(isset($_POST['prijava'])) {
        // Postoji li korisnik u bazi
        $prijavaKorisnickoIme = $_POST['korisnicko-ime'];
        $prijavaLozinka = $_POST['lozinka'];

        $query = "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
        $stmt = mysqli_stmt_init($dbc);
        if(mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 's', $prijavaKorisnickoIme);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        }
        mysqli_stmt_bind_result($stmt, $imeKorisnik, $lozinkaKorisnik, $razinaKorisnik);
        mysqli_stmt_fetch($stmt);

        // Provjera lozinke
        if(password_verify($_POST['lozinka'], $lozinkaKorisnik) && mysqli_stmt_num_rows($stmt) > 0) {
            $uspjesnaPrijava = true;

            // Je li admin
            if($razinaKorisnik == 1) {
                $admin = true;
            } else {
                $admin = false;
            }

            // session varijable
            $_SESSION['username'] = $imeKorisnik;
            $_SESSION['razina'] = $razinaKorisnik;

            $redirectUrl = $admin ? '../administracija.php' : '../index.php';

            echo '
                <script>
                alert("Uspješna prijava");
                setTimeout(function() {
                    window.location.href = " '.$redirectUrl.' ";
                }, 1); 
            </script>
            ';
        } else {
            $uspjesnaPrijava = false;
            echo '
                <script>
                alert("Neuspješna prijava");
                setTimeout(function() {
                    window.location.href = "../prijava.php";
                }, 1); 
            </script>
            ';
        }

        
    }

?>