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
                    <div class="right-column uredi-vijesti">
                        <table class="table-vijesti table-vijesti-normal">
                            <thead>
                                <tr>
                                    <th>Slika</th>
                                    <th class="wider-cell">Naslov</th>
                                    <th class="wider-cell">Kratki sadržaj</th>
                                    <th>Kategorija</th>
                                    <th>Arhiva</th>
                                    <th>Akcije</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                include '../connect.php';
                                $query = "SELECT * FROM vijesti";
                                $result = mysqli_query($dbc, $query);
                                while ($row = mysqli_fetch_assoc($result)):
                                    $jeArhivirano = $row['arhiva'] ? '<span style="color: #d7194c">Arhivirano</span>' : '<span style="color: #199266">Prikazano</span>';
                                ?>
                                <tr>
                                    <td><?php echo '<a href="../clanak.php?id=' . $row['id'] . '"><img class="article-image" src="../' . $row['slika'] . '" alt="' . $row['slika'] . '"></a>'; ?></td>
                                    <td class="table-vijesti-naslov"><?php echo '<a class="table-title" href="../clanak.php?id=' . $row['id'] . '">' . $row['naslov'] . '</a>'; ?></td>
                                    <td><?php echo $row['kratki_sadrzaj']; ?></td>
                                    <td><?php echo $row['kategorija']; ?></td>
                                    <td><?php echo $jeArhivirano ?></td>
                                    <td>
                                        <div class="table-btns">
                                            <a class="table-btn" href="izmijena-vijesti.php?id=<?php echo $row['id']; ?>">Izmijeni</a>
                                            <a class="table-btn" href="brisanje-vijesti.php?izbrisi=<?php echo $row['id']; ?>" onclick="return confirm('Jeste li sigurni da želite izbrisati ovu vijest?')">Izbriši</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>

                            </tbody>
                        </table>

                        <table class="table-vijesti table-vijesti-spanned">
                            <tbody>
                            <?php 
                                include '../connect.php';
                                $query = "SELECT * FROM vijesti";
                                $result = mysqli_query($dbc, $query);
                                while ($row = mysqli_fetch_assoc($result)):
                                    $jeArhivirano = $row['arhiva'] ? '<span style="color: #d7194c">Arhivirano</span>' : '<span style="color: #199266">Prikazano</span>';
                                ?>
                                <tr>
                                    <td colspan="3"><?php echo '<img class="article-image" src="../' . $row['slika'] . '" alt="' . $row['slika'] . '">'; ?></td>
                                    <td class="table-vijesti-naslov" colspan="5"><?php echo '<a class="table-title"  href="../clanak.php?id=' . $row['id'] . '">' . $row['naslov'] . '</a>'; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="7"><?php echo $row['kratki_sadrzaj']; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="7"><?php echo $row['kategorija']; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="7"><?php echo $jeArhivirano; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        <div class="table-btns">
                                            <a class="table-btn" href="izmijena-vijesti.php?id=<?php echo $row['id']; ?>">Izmijeni</a>
                                            <a class="table-btn" href="brisanje-vijesti.php?izbrisi=<?php echo $row['id']; ?>" onclick="return confirm('Jeste li sigurni da želite izbrisati ovu vijest?')">Izbriši</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr style="border: none">
                                    <td style="border: none" colspan="8"></td> <!-- Adjust colspan if needed -->
                                </tr>   
                            <?php endwhile; ?>

                            </tbody>
                        </table>
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