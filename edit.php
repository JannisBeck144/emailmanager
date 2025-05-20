<?php
include("config.php");
function function_alert() { 
              
    // Display the alert box; note the Js tags within echo, it performs the magic
    echo "<script>alert('Nichts hinzugefügt!');</script>"; 
} 

if (isset($_POST['btn-save'])) {
    $oldEmail = trim($_POST['oldEmail']);
    $newEmail = trim($_POST['newEmail']);

    // Read all lines, ignore new and empty lines
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $updatedList = [];
    // Replace old email with new one
    foreach ($lines as $line) {
        if (trim($line) == $oldEmail) {
            $updatedList[] = $newEmail; 
        }
        else {
            $updatedList[] = $line;
        }
    }

    // Write updated lines back to file
    $textToStore = "";
    foreach ($updatedList as $line) {
        $textToStore .= $line . "\n";
    }
    
    if(file_exists($filename) == false){
        echo("Keine Storage-Datei! Bitte Admin kontaktieren: +49 ... 1.2.3., alternativ die Storagedatei über den Manager erstellen :) <a href='index.php'> zurück </a>");
        exit();
    }
    else{
        $inhalt = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }
    // Prüfen, ob die Zeile bereits vorhanden ist
    if (!in_array($_POST['newEmail'], $inhalt)) {
        // Zeile hinzufügen
        file_put_contents($filename, $textToStore);
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


$oldEmail = $_GET['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Address Manager</title>
    <link href="style.css" rel="stylesheet">
</head>
<body >
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
   
    <main>
        <h1> EMail Address Manager - Edit EMail <h1>
        <form method="post">
            <input type="hidden" name="oldEmail" value="<?php echo $oldEmail ?>">
            <input type="email" size="30" name="newEmail" value="<?php echo trim($oldEmail) ?>" required>
            <button type="submit" name="btn-save">Save Email</button>
    </form> 
    </main>
</main>
</body>
</html>
