<!DOCTYPE html>
<html lang="hr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/style.css">
        <script src="https://kit.fontawesome.com/d5cd9824e3.js" crossorigin="anonymous"></script>
        <script src="js/script.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    </head>

    <body>
        <div class="grid-container">
            <header>
                <div class="content-container">
                    <nav class="navbar">
                        <a href="index.php"><img src="images/site_images/WA-logo-removebg-fotor.png" alt="" class="nav-logo"></a>
                         <ul class="nav-menu">
                            <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                            <li class="nav-item"><a href="kategorija.php?id=tech" class="nav-link">Tech</a></li>
                            <li class="nav-item"><a href="kategorija.php?id=sport" class="nav-link">Sport</a></li>
                            <li class="nav-item"><a href="kategorija.php?id=gaming" class="nav-link">Gaming</a></li>
                            <?php if (isset($_SESSION['username'])): ?>
                                <?php if ($_SESSION['razina'] == 1): ?>
                                    <li class="nav-item"><a href="administracija.php" class="nav-link">Admin</a></li>
                                <?php endif; ?>
                                <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
                            <?php else: ?>
                                <li class="nav-item"><a href="prijava.php" class="nav-link">Prijava</a></li>
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
                <div class="content-container">
                    <div class="form-container">
                        <div class="form-item form-title">
                            <h1>Prijava</h1>
                        </div>
                        <form action="skripte/skripta-prijava.php" method="POST" name="forma-prijava">
                        <div class="form-item form-item-icon-input">
                            <i class="fa-regular fa-user"></i>
                            <input type="text" name="korisnicko-ime" id="korisnicko-ime" placeholder="Korisničko ime" autofocus>
                        </div>
                        <div class="form-item form-item-icon-input">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" name="lozinka" id="lozinka" placeholder="Lozinka">
                        </div>
                        <div class="form-item">
                            <input type="submit" name="prijava" id="prijava" value="Prijava">
                        </div>

                        <div class="form-item form-link">
                            <p>Nemate račun?</p>
                            <a href="registracija.php">Registrirajte se</a>
                        </div>
                    </form>
                    </div>
                </div>
            </main>

            <footer>
                <div class="content-container">
                    <p>Patricia Martinčić</p>
                </div>
            </footer>
        </div>
    </body>
</html>