<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <script type="text/javascript" src="../js/unos.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/unos.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
    include '../connect.php';

    if (isset($_GET['id'])) {
        $vijestId = $_GET['id'];

        $query = "SELECT * FROM vijesti WHERE id='$vijestId'";
        $result = mysqli_query($dbc, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $vijest = mysqli_fetch_assoc($result);
        } else {
            echo 'Vijest nije pronađena.';
            exit;
        }
    } else {
        echo 'Greška u dohvaćanju id-a';
        exit;
    }
    ?>

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
                    <form enctype="multipart/form-data" action="izmijena-vijesti.php?id=<?php echo $vijestId; ?>"
                        method="POST" class="forma-unos">
                        <div class="form-container-unos">
                            <div class="form-item-unos unos-title">
                                <h1>Uredi vijest</h1>
                            </div>

                            <div class="form-item-unos">
                                <label for="naslov">Naslov</label>
                                <input type="text" name="naslov" id="naslov"
                                    value="<?php echo htmlspecialchars($vijest['naslov']); ?>">
                                <span class="error-message" id="poruka-naslov"></span>
                            </div>

                            <div class="form-item-unos">
                                <label for="kratki-sadrzaj">Kratki sadržaj</label>
                                <textarea name="kratki-sadrzaj" id="kratki-sadrzaj" cols="30"
                                    rows="5"><?php echo htmlspecialchars($vijest['kratki_sadrzaj']); ?></textarea>
                                <span class="error-message" id="poruka-kratki-sadrzaj"></span>
                            </div>

                            <div class="form-item-unos">
                                <label for="sadrzaj">Sadržaj vijesti</label>
                                <textarea name="sadrzaj" id="sadrzaj" cols="30"
                                    rows="10"><?php echo htmlspecialchars($vijest['sadrzaj']); ?></textarea>
                                <span class="error-message" id="poruka-sadrzaj"></span>
                            </div>

                            <div class="form-item-unos">
                                <label for="kategorija">Kategorija</label>
                                <select name="kategorija" id="kategorija">
                                    <option value="" disabled>Odaberi kategoriju</option>
                                    <option value="tech" <?php echo ($vijest['kategorija'] == 'tech') ? 'selected' : ''; ?>>Tech</option>
                                    <option value="sport" <?php echo ($vijest['kategorija'] == 'sport') ? 'selected' : ''; ?>>Sport</option>
                                    <option value="gaming" <?php echo ($vijest['kategorija'] == 'gaming') ? 'selected' : ''; ?>>Gaming</option>
                                </select>
                                <span class="error-message" id="poruka-kategorija"></span>
                            </div>

                            <div class="form-item-unos">
                                <label for="slika">Slika</label>
                                <input type="file" name="slika" id="slika">
                                <span class="error-message" id="poruka-slika"></span>
                                <?php if ($vijest['slika']): ?>
                                    <img src="../<?php echo $vijest['slika']; ?>" alt="Trenutna slika"
                                        style="max-width: 200px;">
                                <?php endif; ?>
                            </div>

                            <div class="form-item-unos unos-checkbox">
                                <label for="arhiva">Arhivirati: </label>
                                <input type="checkbox" name="arhiva" id="arhiva" <?php echo ($vijest['arhiva']) ? 'checked' : ''; ?>>
                            </div>

                            <div class="form-item-unos unos-btns">
                                <input type="submit" name="azuriraj" id="azuriraj" value="Ažuriraj">
                            </div>
                        </div>
                    </form>

                    <?php
                    if (isset($_POST['azuriraj'])) {
                        $naslov = $_POST['naslov'];
                        $kratkiSadrzaj = $_POST['kratki-sadrzaj'];
                        $sadrzaj = $_POST['sadrzaj'];
                        $kategorija = $_POST['kategorija'];
                        $arhiva = isset($_POST['arhiva']) ? 1 : 0;

                        if (!empty($_FILES['slika']['name'])) {
                            $slika = $_FILES['slika']['name'];
                            $target_dir = '../images/user_images/' . $slika;
                            if (!move_uploaded_file($_FILES["slika"]["tmp_name"], $target_dir)) {
                                echo 'Upload failed with error code: ' . $_FILES['slika']['error'];
                                exit;
                            }
                            $slika = 'images/user_images/' . $slika;
                        } else {
                            $slika = $vijest['slika'];
                        }

                        $query = "UPDATE vijesti SET naslov='$naslov', kratki_sadrzaj='$kratkiSadrzaj', sadrzaj='$sadrzaj', slika='$slika', kategorija='$kategorija', arhiva='$arhiva' WHERE id='$vijestId'";

                        if (mysqli_query($dbc, $query)) {
                            echo '
                                <script>
                                    alert("Vijest uspješno izmijenjena.");
                                    setTimeout(function() {
                                        window.location.href = "uredi-vijesti.php";
                                    }, 1); 
                                </script>
                            ';
                        } else {
                            echo 'Greška: ' . mysqli_error($dbc);
                        }
                    }

                    mysqli_close($dbc);
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
</body>

</html>