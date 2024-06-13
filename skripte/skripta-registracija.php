<?php

include '../connect.php';

if (isset($_POST['registracija'])) {
    $ime = ucfirst(strtolower($_POST['ime']));
    $prezime = ucfirst(strtolower($_POST['prezime']));
    $username = $_POST['korisnicko-ime'];
    $lozinka = $_POST['lozinka1'];
    $hashed_password = password_hash($lozinka, CRYPT_BLOWFISH);
    $razina = 0;
    $registriraniKorisnik = '';
}

// Postoji li korisnik u bazi?
$query = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
$stmt = mysqli_stmt_init($dbc);
if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
}

if (mysqli_stmt_num_rows($stmt) > 0) {
    echo 'Korisničko ime postoji.';
} else {
    //registriraj korisnika
    $query = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina)
                    VALUES(?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssssi', $ime, $prezime, $username, $hashed_password, $razina);
        mysqli_stmt_execute($stmt);
        $registriraniKorisnik = true;
    }
}

mysqli_close($dbc);


if ($registriraniKorisnik == true) {
    echo '
            <script>
                alert("Uspješna registracija");
                setTimeout(function() {
                    window.location.href = "../prijava.php";
                }, 1); 
            </script>
        ';
} else {
    echo '<p>Neuspješna registracija.</p>';
}


?>