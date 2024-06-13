<!DOCTYPE html>
<html lang="hr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/style.css">
        <script src="js/script.js"></script>
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
                        <a href="index.php"><img src="images/site_images/WA-logo-removebg-fotor.png" alt="" class="nav-logo"></a>
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
                <div class="content-container">
                    <?php
                    include 'connect.php';

                    $kategorija_id = isset($_GET['id']) ? $_GET['id'] : '';

                    // Map categories to CSS classes
                    $category_class_map = [
                        'tech' => 'theme-tech',
                        'sport' => 'theme-sport',
                        'gaming' => 'theme-gaming'
                        // Add other categories as needed
                    ];

                    // Get the appropriate CSS class for the category
                    $section_class = isset($category_class_map[$kategorija_id]) ? $category_class_map[$kategorija_id] : '';

                    echo '<section class="theme-section ' . $section_class . '">';

                    echo '<div class="section-title">';
                    echo '<h1>' . ucfirst($kategorija_id) . '</h1>';
                    echo '<hr>';
                    echo '</div>';

                    $query = "SELECT * FROM vijesti WHERE arhiva = 0 AND kategorija = '$kategorija_id' ORDER BY datum DESC";
                    $result = mysqli_query($dbc, $query);
                    if (!$result) {
                        echo "Error: " . mysqli_error($dbc);
                    }

                    echo '<div class="section-articles">';
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<article class="article">';

                        echo '<a class="article-image-container" href="clanak.php?id=' . $row['id'] . '">';
                        echo '<img class="article-image" src="' . $row['slika'] . '" alt="' . $row['slika'] . '">';
                        echo '</a>';

                        echo '<div class="article-info">';
                        echo '<a class="article-title-link" href="clanak.php?id=' . $row['id'] . '">';
                        echo '<h2>' . $row['naslov'] . '</h2>';
                        echo '</a>';
                        echo '<p class="article-sazetak">' . $row['kratki_sadrzaj'] . '</p>';
                        echo '<p class="article-datum">' . date('d.m.Y.', strtotime($row['datum'])) . '</p>';
                        echo '</div>';

                        echo '</article>';
                    }
                    echo '</div>';

                    echo '</section>';
                    ?>
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