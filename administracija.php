<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <script src="/js/script.js"></script>
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
                    <a href="index.php"><img src="images/site_images/WA-logo-removebg-fotor.png" alt=""
                            class="nav-logo"></a>
                    <ul class="nav-menu">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'index.php')
                                echo 'active'; ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="kategorija.php?id=tech" class="nav-link <?php if (isset($_GET['id']) && $_GET['id'] == 'tech')
                                echo 'active'; ?>">Tech</a>
                        </li>
                        <li class="nav-item">
                            <a href="kategorija.php?id=sport" class="nav-link <?php if (isset($_GET['id']) && $_GET['id'] == 'sport')
                                echo 'active'; ?>">Sport</a>
                        </li>
                        <li class="nav-item">
                            <a href="kategorija.php?id=gaming" class="nav-link <?php if (isset($_GET['id']) && $_GET['id'] == 'gaming')
                                echo 'active'; ?>">Gaming</a>
                        </li>
                        <?php if (isset($_SESSION['username'])): ?>
                            <?php if ($_SESSION['razina'] == 1): ?>
                                <li class="nav-item">
                                    <a href="administracija.php" class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'administracija.php')
                                        echo 'active'; ?>">Admin</a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <span class="nav-username"><?php echo $_SESSION['username']; ?></span>
                            </li>
                            <li class="nav-item">
                                <a href="logout.php" class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'logout.php')
                                    echo 'active'; ?>">Logout</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a href="prijava.php" class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'prijava.php')
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
            <div class="main-content admin-start">
                <div class="side-menu">
                    <ul class="admin-menu">
                        <li><a href="admin/unos.php" class="<?php if (basename($_SERVER['PHP_SELF']) == 'unos.php')
                            echo 'active'; ?>">Unesi novu vijest</a>
                        </li>
                        <li><a href="admin/uredi-vijesti.php" class="<?php if (basename($_SERVER['PHP_SELF']) == 'uredi-vijesti.php')
                            echo 'active'; ?>">Uredi
                                vijesti</a></li>
                        <li><a href="admin/prikaz-korisnika.php" class="<?php if (basename($_SERVER['PHP_SELF']) == 'prikaz-korisnika.php')
                            echo 'active'; ?>">Prikaz
                                korisnika</a></li>
                    </ul>
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