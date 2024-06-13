<!DOCTYPE html>
<html lang="hr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/style.css">
        <script type="text/javascript" src="js/registracija.js"></script>
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
                            <h1>Registracija</h1>
                        </div>
                        <form action="skripte/skripta-registracija.php" method="POST" name="forma-registracija">
                        <div class="form-item">
                            <div class="form-item-icon-input">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" name="korisnicko-ime" id="korisnicko-ime" placeholder="Korisničko ime" autofocus>
                            </div>
                            <span class="error-message" id="poruka-korisnicko-ime"></span>
                        </div>
                        <div class="form-item">
                            <div class="form-item-icon-input">
                                <i class="fa-solid fa-lock"></i>
                                <input type="password" name="lozinka1" id="lozinka1" placeholder="Lozinka">
                            </div>
                            <span class="error-message" id="poruka-lozinka1"></span>
                        </div>
                        <div class="form-item">
                            <div class="form-item-icon-input">
                                <i class="fa-solid fa-lock"></i>
                                <input type="password" name="lozinka2" id="lozinka2" placeholder="Ponovi lozinku">
                            </div>
                            <span class="error-message" id="poruka-lozinka2"></span>
                        </div>
                        <div class="form-item form-item-ime-prezime">
                            <div class="form-item-ime">
                                <div class="form-item-icon-input">
                                    <i class="fa-regular fa-user"></i>
                                    <input type="text" name="ime" id="ime" placeholder="Ime">
                                </div>
                                <span class="error-message" id="poruka-ime"></span>
                            </div>
                            <div class="form-item-prezime">
                                <div class="form-item-icon-input">
                                    <i class="fa-regular fa-user"></i>
                                    <input type="text" name="prezime" id="prezime" placeholder="Prezime">
                                </div>
                                <span class="error-message" id="poruka-prezime"></span>
                            </div>
                        </div>
                        <div class="form-item">
                            <input type="submit" name="registracija" id="registracija" value="Registracija">
                        </div>
                        <div class="form-item form-link">
                            <p>Imate račun?</p>
                            <a href="prijava.php">Prijavite se</a>
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