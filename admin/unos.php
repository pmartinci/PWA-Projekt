<!DOCTYPE html>
<html lang="hr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles/style.css">
        <script type="text/javascript" src="../js/unos.js"></script>
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
                        <form enctype="multipart/form-data" action="../skripte/skripta-unos.php" method="POST"
                            class="forma-unos">
                            <div class="form-container-unos">
                                <div class="form-item-unos unos-title">
                                    <h1>Unos vijesti</h1>
                                </div>

                                <div class="form-item-unos">
                                    <label for="naslov">Naslov</label>
                                    <input type="text" name="naslov" id="naslov" autofocus>
                                    <span class="error-message" id="poruka-naslov"></span>
                                </div>

                                <div class="form-item-unos">
                                    <label for="naslov">Kratki sadržaj</label>
                                    <textarea name="kratki-sadrzaj" id="kratki-sadrzaj" cols="30" rows="5"></textarea>
                                    <span class="error-message" id="poruka-kratki-sadrzaj"></span>
                                </div>

                                <div class="form-item-unos">
                                    <label for="naslov">Sadržaj vijesti</label>
                                    <textarea name="sadrzaj" id="sadrzaj" cols="30" rows="10"></textarea>
                                    <span class="error-message" id="poruka-sadrzaj"></span>
                                </div>

                                <div class="form-item-unos">
                                    <label for="kategorija">Kategorija</label>
                                    <select name="kategorija" id="kategorija">
                                        <option value="" disabled selected>Odaberi kategoriju</option>
                                        <option value="tech">Tech</option>
                                        <option value="sport">Sport</option>
                                        <option value="gaming">Gaming</option>
                                    </select>
                                    <span class="error-message" id="poruka-kategorija"></span>
                                </div>

                                <div class="form-item-unos">
                                    <label for="slika">Slika</label>
                                    <input type="file" name="slika" id="slika">
                                    <span class="error-message" id="poruka-slika"></span>
                                </div>

                                <div class="form-item-unos unos-checkbox">
                                    <label for="arhiva">Arhivirati: </label>
                                    <input type="checkbox" name="arhiva" id="arhiva">
                                </div>

                                <div class="form-item-unos unos-btns">
                                    <input type="submit" name="submit" id="submit" value="Pošalji">
                                    <input type="reset" value="Resetiraj">
                                </div>
                            </div>
                        </form>
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