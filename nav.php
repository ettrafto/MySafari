<!--NAV-->
    <nav class="m-nav">

        <a class=
            "<?php if ($pathParts['filename'] == 'index') {print "activePage";}?>"
                href="index.php">Home</a>
        
        <a class=
        "<?php if ($pathParts['filename'] == 'featured') {print "activePage";}?>"
            href="featured.php">Featured</a>
                    
        <a class="<?php if ($pathParts['filename'] == 'animals') {print "activePage";}?>" 
            href="animals.php">Animals</a>

        <a class="<?php if ($pathParts['filename'] == 'landscapes') {print "activePage";}?>"
            href="landscapes.php">Landscapes</a>
        
        <a class="<?php if ($pathParts['filename'] == 'about-me') {print "activePage";}?>"
            href="about-me.php">Me</a>
        
        <section id="space2"></section>
        

    </nav>
            