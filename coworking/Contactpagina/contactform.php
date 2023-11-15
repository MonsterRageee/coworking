<?php

// Show all errors (for educational purposes)
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

// Constanten (connectie-instellingen databank)
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'contact');

date_default_timezone_set('Europe/Brussels');

// Verbinding maken met de databank
try {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Verbindingsfout: ' . $e->getMessage();
    exit;
}

$name = isset($_POST['name']) ? (string)$_POST['name'] : '';
$message = isset($_POST['message']) ? (string)$_POST['message'] : '';
$msgName = '';
$msgMessage = '';
$email = isset($_POST['email']) ? (string)$_POST['email'] : '';
$msgEmail = '';

// form is sent: perform formchecking!
if (isset($_POST['btnSubmit'])) {

    $allOk = true;

    // name not empty
    if (trim($name) === '') {
        $msgName = 'Gelieve een naam in te voeren';
        $allOk = false;
    }

    if (trim($message) === '') {
        $msgMessage = 'Gelieve een boodschap in te voeren';
        $allOk = false;
    }
    if (trim($email) === '') {
        $msgEmail = 'Gelieve een boodschap in te voeren';
        $allOk = false;
    }

    // end of form check. If $allOk still is true, then the form was sent in correctly
    if ($allOk) {
        // build & execute prepared statement
        $stmt = $db->prepare('INSERT INTO messages (sender, email, message, added_on) VALUES (?, ?, ?, ?)');
        $stmt->execute(array($name, $email, $message, (new DateTime())->format('Y-m-d H:i:s')));

        // the query succeeded, redirect to this very same page
        if ($db->lastInsertId() !== 0) {
            header('Location: formchecking_thanks.php?name=' . urlencode($name));
            exit();
        } // the query failed
        else {
            echo 'Databankfout.';
            exit;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <title>Contact Form</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="./styles.css" />

</head>

<body>
    <header>
        <div>
            <nav>
                <ul class="container">

                    <li class="leftfloat">
                        <a href="../verhaal/index.html">Ons Verhaal</a>
                    </li>
                    <li class="leftfloat">
                        <a href="../index_engels.html">Engelse Versie</a>
                    </li>


                    <li class="midfloat">
                        <a href="../index.html"><img src="./img/los_pollos_hermanos_logo.png" alt="logo van 2 kippen"></a>
                    </li>


                    <li class="rightfloat">
                        <a href="../menu/index.html">Menu</a>
                    </li>
                    <li class="rightfloat">
                        <a href="./Contactpagina">Contacteer Ons</a>
                    </li>

                </ul>
            </nav>
        </div>
    </header>
    <main>
        <section class="row">
            <div class="contacteergegevens flex-container">
                <h1>Contacteer ons!</h1>
                <p>Dit zijn de contact gegevens van ons bedrijf!</p>
                <ul>
                    <li><span class="first-word">Adress:</span> 137 Rue de Mouvaux, Frankrijk</li>
                    <li><span class="first-word">Telefoonnummer:</span> +33 985050253 </li>
                    <li><span class="first-word">Email:</span> dekippebroeders@gmail.com</li>
                </ul>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d648557.5536918703!2d3.1119892046255018!3d50.5819987896205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c329a12f9492bd%3A0x683c6e726aa4264d!2sNens%20Pollos%20Hermanos!5e0!3m2!1snl!2sbe!4v1700060713053!5m2!1snl!2sbe" width="350" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="container">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <h1>Contacteer Formulier</h1>
                    <p class="message required">Alle velden zijn verplicht.</p>

                    <div>
                        <label for="name" class="required">Jouw naam</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlentities($name); ?>" class="input-text" />
                        <span class="message error"><?php echo $msgName; ?></span>
                    </div>

                    <div>
                        <label for="email" class="required">Email</label>
                        <input type="text" id="email" name="email" value="<?php echo htmlentities($email); ?>" class="input-text" />
                        <span class="message error"><?php echo $msgEmail; ?></span>
                    </div>

                    <div>
                        <label for="message" class="required">Boodschap</label>
                        <textarea name="message" id="message" rows="5" cols="40"><?php echo htmlentities($message); ?></textarea>
                        <span class="message error"><?php echo $msgMessage; ?></span>
                    </div>

                    <div class="mybutton">
                        <input type="submit" id="btnSubmit" name="btnSubmit" value="Verstuur" />

                    </div>

        </section>
    </main>
    <footer>
        <div class="ondernav">
            <Ul>
                <li><a href="#">SPECIAL THERMS OF USE</li></a>
                <Li><a href="/GENERAL TERMS OF USE/GENERAL TERMS OF USE.html">GENERAL TERMS OF USE</Li></a>
                <Li><a href="/Privacy en Cookie Policy/Privacy en Cookie Policy.html">Privacy en Cookie Policy</Li></a>
                <li><a href="/Contact/Contact.html">Contact</li></a>
                <li><a href="/FAQs/FAQs.htm">FAQs</li></a>
            </Ul>
        </div>
    </footer>
</body>

</html>