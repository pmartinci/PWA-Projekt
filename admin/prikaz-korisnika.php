<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <script type="text/javascript" src="js/unos.js"></script>
    <script src="../js/script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <?php session_start(); ?>
    <div class="grid-container">
        <header>
            <div class="content-container">
                <nav class="navbar">
                    <a href="../index.php"><img src="../images/site_images/WA-logo-removebg-fotor.png" alt=""
                            class="nav-logo"></a>
                    <ul class="nav-menu">
                        <li class="nav-item">
                            <a href="../index.php" class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'index.php')
                                echo 'active'; ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="../kategorija.php?id=tech" class="nav-link <?php if (isset($_GET['id']) && $_GET['id'] == 'tech')
                                echo 'active'; ?>">Tech</a>
                        </li>
                        <li class="nav-item">
                            <a href="../kategorija.php?id=sport" class="nav-link <?php if (isset($_GET['id']) && $_GET['id'] == 'sport')
                                echo 'active'; ?>">Sport</a>
                        </li>
                        <li class="nav-item">
                            <a href="../kategorija.php?id=gaming" class="nav-link <?php if (isset($_GET['id']) && $_GET['id'] == 'gaming')
                                echo 'active'; ?>">Gaming</a>
                        </li>
                        <?php if (isset($_SESSION['username'])): ?>
                            <?php if ($_SESSION['razina'] == 1): ?>
                                <li class="nav-item">
                                    <a href="../administracija.php" class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'administracija.php')
                                        echo 'active'; ?>">Admin</a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <span class="nav-username"><?php echo $_SESSION['username']; ?></span>
                            </li>
                            <li class="nav-item">
                                <a href="../logout.php" class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'logout.php')
                                    echo 'active'; ?>">Logout</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a href="../prijava.php" class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'prijava.php')
                                    echo 'active'; ?>">Prijava</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <div class="hamburger-menu" id="hamburger-menu">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </div>
                </nav>
            </div>
        </header>

        <main>
            <div class="main-content">
                <div class="side-menu">
                    <ul class="admin-menu">
                        <li><a href="unos.php" class="<?php if (basename($_SERVER['PHP_SELF']) == 'unos.php')
                            echo 'active'; ?>">Unesi novu vijest</a>
                        </li>
                        <li><a href="uredi-vijesti.php" class="<?php if (basename($_SERVER['PHP_SELF']) == 'uredi-vijesti.php')
                            echo 'active'; ?>">Uredi
                                vijesti</a></li>
                        <li><a href="prikaz-korisnika.php" class="<?php if (basename($_SERVER['PHP_SELF']) == 'prikaz-korisnika.php')
                            echo 'active'; ?>">Prikaz
                                korisnika</a></li>
                    </ul>
                </div>
                <div class="right-column">
                    <?php

                    include '../connect.php';

                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        if(isset($_POST['izbrisi'])) {
                            $id = $_POST['id'];

                            $query = "DELETE FROM korisnik WHERE id = ?";
                            $stmt = mysqli_prepare($dbc, $query);
                            mysqli_stmt_bind_param($stmt, 'i', $id);
                            mysqli_stmt_execute($stmt);

                           
                            if (mysqli_stmt_affected_rows($stmt) > 0) {
                                echo "<script>alert('Korisnik uspješno izbrisan..');</script>";
                            } else {
                                echo "<script>alert('Greška: " . mysqli_error($dbc) . "');</script>";
                            }
                        }

                        if (isset($_POST['razina'])) {
                            $id = $_POST['id'];
                            $nova_razina = $_POST['razina'];

                            // Update the 'razina' of the user with the provided ID
                            $query = "UPDATE korisnik SET razina = ? WHERE id = ?";
                            $stmt = mysqli_prepare($dbc, $query);
                            mysqli_stmt_bind_param($stmt, 'ii', $nova_razina, $id);
                            mysqli_stmt_execute($stmt);

                            // Check if the 'razina' was updated successfully
                            if (mysqli_stmt_affected_rows($stmt) > 0) {
                                echo "<script>alert('Razina uspješno promijenjena.');</script>";
                            } else {
                                echo "<script>alert('Greša updating razina: " . mysqli_error($dbc) . "');</script>";
                            }
                        }
                    }

                    $query = "SELECT korisnicko_ime, ime, prezime, razina, id FROM korisnik";
                    $result = mysqli_query($dbc, $query);
                    echo '<table class="table-korisnici">';

                    echo '<tr>
                                <th>Korisničko ime</th>
                                <th>Ime</th>
                                <th>Prezime</th>
                                <th>Razina</th>
                                <th>Izbriši korisnika</th>
                            </tr>';

                    while ($row = mysqli_fetch_array($result)) {

                        echo '<tr>';
                        echo '<td class="korisnickoIme">' . $row['korisnicko_ime'] . '</td>';
                        echo '<td>' . $row['ime'] . '</td>';
                        echo '<td>' . $row['prezime'] . '</td>';
                        echo '<td>
                            <form method="POST" action="">
                                <input type="hidden" name="id" value="' . $row['id'] . '">
                                <select name="razina" onchange="confirmChange(this)">
                                    <option value="0"' . ($row['razina'] == 0 ? ' selected' : '') . '>Korisnik</option>
                                    <option value="1"' . ($row['razina'] == 1 ? ' selected' : '') . '>Admin</option>
                                </select>
                            </form>
                        </td>';
                        echo '<td>
                                    <form method="POST" action="">
                                        <input type="hidden" name="id" value="' . $row['id'] . '">
                                        <input class="table-korisnici-btn" type="submit" name="izbrisi" value="Izbriši" onclick="return confirm(\'Jeste li sigurni da želite izbrisati korisnika: ' . $row['korisnicko_ime'] . '?\')">
                                    </form>
                                </td>';
                        echo '</tr>';
                    }

                    echo '</table>';

                    ?>
                </div>
            </div>
        </main>

        <footer class="remove-grid-gap">
            <div class="content-container">
                <p>Patricia Martinčić</p>
            </div>
        </footer>
    </div>
    <script>
        function confirmChange(selectElement) {
        // Get the username from the form row
        var username = selectElement.closest('tr').querySelector('.korisnickoIme').innerText;

        if (confirm('Jeste li sigurni da želite promijeniti razinu korisnika: ' + username + '?')) {
            selectElement.form.submit();
        }
        return false; // Prevent form submission in case of cancel
    }
    </script>
</body>

</html>