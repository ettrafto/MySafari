<?php
//parses for specail chars for security
//$phpSelf = htmlspecialchars($_SERVER['PHP_SELF']);
//helps give each page id
//$pathParts = pathinfo($phpSelf);

?>

<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>MySafari: Exploring Tanzania</title>
        <meta name="author" content="Evan Trafton">
        <meta name="description" content="Documenting my trip to Tanzania">
        
        <meta name="viewport" content="width=device-width, intial-scale=1.0">
        
        <link rel="favicon icon" href="images/assets/favicon.ico" type="image/x-icon">
        
        <link rel="stylesheet" href="css/custom.css?version=<?php print time(); ?>" type="text/css">
        <link rel="stylesheet" media="(max-width: 800px)" href="css/custom-tablet.css?version=<?php print time(); ?>" type="text/css">
        <link rel="stylesheet" media="(max-width: 600px)"href="css/custom-phone.css?version=<?php print time(); ?>" type="text/css">

        <!-- Javascript link would go here  -->
    </head>


    <?php
    
    print'<body class="postioning" id="' .$pathParts['filename'] . '">';
    print'<!-- Start of Body-->';
    
    include 'connect-DB.php';
    print PHP_EOL;
    include 'header.php';
    print PHP_EOL;
    
    ?>