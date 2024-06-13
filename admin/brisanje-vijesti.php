<?php
    session_start();
    include '../connect.php';

    if (isset($_GET['izbrisi'])) {
        $vijestId = $_GET['izbrisi'];


        $query = "DELETE FROM vijesti WHERE id='$vijestId'";

        if (mysqli_query($dbc, $query)) {
            echo '
                <script>
                    alert("Vijest uspješno obrisana.");
                    setTimeout(function() {
                        window.location.href = "uredi-vijesti.php";
                    }, 1); 
                </script>
            ';
        } else {
            echo 'Greška: ' . mysqli_error($dbc);
        }
    } else {
        echo 'Greška u dohvaćanju id-a';
    }

    mysqli_close($dbc);
?>
