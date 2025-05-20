<?php
    include('config.php');
    // get content of $filename 
    // each line will be stored as element of 
    // array $text
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    include('config.php');

    if(isset($_GET['delete'])){
        // here, we will put the save-operations...
        // but we can just output the information that was sent to our page...
        unlink($filename);
        header('Location: index.php');
        exit();
    }
    if(isset($_GET['create'])){
        // here, we will put the save-operations...
        // but we can just output the information that was sent to our page...
        $text = "";
        file_put_contents($filename, $text);
        header('Location: index.php');
        exit();
    }
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
        <h1>Email Address Manager</h1>
        <h2>Saved Emails</h2>
        <?php
            foreach ($lines as $line){
            echo "<p>". $line . 
                " <a href='delete.php?email=" . $line . "'>Delete</a>" . 
                " <a href='edit.php?email=" . $line . "'>Edit</a>" . 
                "</p>\n\t";
            }
        ?>    
        
        
    <!-- Add link that leads us to a form to enter new email addresses --> 
   
    <a href="Emailmanager.php">Add New Email</a><br><br>
        <form method="get">
            <button type="submit", name="delete", value="1" size="30"> Delete Storage-File </button>
            <button type="submit", name="create", value="1" size="30"> Create Storage-File </button>
        </form> 
</main>
</body>

</html>
