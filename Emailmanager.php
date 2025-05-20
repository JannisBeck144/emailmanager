<?php
    include('config.php');
    function function_alert() { 
              
        // Display the alert box; note the Js tags within echo, it performs the magic
        echo "<script>alert('Nichts hinzugefügt!');</script>"; 
    } 

    if(isset($_GET['btn-save'])){
        // here, we will put the save-operations...
        // but we can just output the information that was sent to our page...
        $text = $_GET['email'] . "\n";
        if(file_exists($filename) == false){
            echo("Keine Storage-Datei! Bitte Admin kontaktieren: +49 ... 1.2.3., alternativ die Storagedatei über den Manager erstellen :) <a href='index.php'> zurück </a>");
            exit();
        }
        else{
            $inhalt = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        }
        // Prüfen, ob die Zeile bereits vorhanden ist
        if (!in_array($_GET['email'], $inhalt)) {
            // Zeile hinzufügen
            file_put_contents($filename, $text, FILE_APPEND);
            echo "Zeile hinzugefügt.";
        } 
        else {
            function_alert();
            echo("<a href='index.php'> zurück </a>");
            exit();
        }
        
        header('Location: index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>E-Mail Registration</title>
    <link href="style.css" rel="stylesheet">
    <script type="text/javascript">
        var clicks = 0;
    
        function onClick() {
            clicks += 1;
            document.getElementById("clicks").innerHTML = clicks;
        }
    </script>
</head>
<body>
    <!-- Navigation -->
    <nav class="retro-nav">
        <ul>
            <li><a href="index.html">Startseite</a></li>
            <li><a href="Informationsseite.html">Lebenslauf</a></li>
            <li><a href="Bilder.html">Bilder</a></li>
            <li><a href="Videos.html">Videos</a></li>
            <li><a href="Zusatzseite.html">Zusatzseite</a></li>
            <li><a href="Emailmanager.php"> E-Mail Registration</a></li>
            <li><a href="index.php"> E-Mail Manager</a></li>
        </ul>
    </nav>

    <!-- Hauptinhalt -->
    <main>
        <h1> EMail ADDRESS Manager <h1>
        <form method="get">
            <input type="email" size="30" name="email" placeholder="E-Mail..." required>
            <button type="submit" name="btn-save" value="1">Save Email</button>
    </form> 
    </main>
</body>
</html>