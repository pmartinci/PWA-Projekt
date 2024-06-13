<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


include '../connect.php';

if(isset($_POST['submit'])) {
    $slika = $_FILES['slika']['name'];
    $naslov = $_POST['naslov'];
    $kratkiSadrzaj = $_POST['kratki-sadrzaj'];
    $sadrzaj = $_POST['sadrzaj'];
    $kategorija = $_POST['kategorija'];

    $arhiva = isset($_POST['arhiva']) ? 1 : 0;

    $target_dir = '../images/user_images/' . $slika;

    if(move_uploaded_file($_FILES["slika"]["tmp_name"], $target_dir)) {
        
        $query = "INSERT INTO vijesti (naslov, kratki_sadrzaj, sadrzaj, slika, kategorija, arhiva) 
                VALUES ('$naslov', '$kratkiSadrzaj', '$sadrzaj', 'images/user_images/$slika', '$kategorija', '$arhiva')";

        $result = mysqli_query($dbc, $query);

        if($result) {
            echo '
                <script>
                    alert("Vijest uspješno spremljena.");
                    setTimeout(function() {
                    window.location.href = "../admin/unos.php";
                    }, 1); 
                    </script>
            ';
        } else {
            echo 'Greška pri upitu: ' . mysqli_error($dbc);
        }
    } else {
        echo 'Upload failed with error code: ' . $_FILES['slika']['error'];

        echo 'Greška pri uploadu datoteke.';
    }
}

mysqli_close($dbc);
?>
