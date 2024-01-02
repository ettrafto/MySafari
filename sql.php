<?php
include 'top.php';
?>
<main>
    <p>Create Table SQL</p>

    <pre>
    CREATE TABLE tblAnimals (
        pmkExercisesId INT AUTO_INCREMENT PRIMARY KEY,
        fldAnimal VARCHAR(50),
        fldGenus VARCHAR(40),
        fldFunFact VARCHAR(500)
    )
    </pre>

    

    <h2>Insert Data</h2>
        <pre>
        INSERT INTO tblAnimals (fldAnimal, fldGenus,fldFunFact) VALUES
        ('Lion','Mammel','Many of the funny faces lions make are due to them sniffing hormones left by other lions to mark territory'),
        ('Giraffe','Mammel','Giraffe are the most common animal to exhibit homosexual behavior in the wild'),
        ('Antelope','Mammel', 'some species of antelopes have specially adapted hooves that make a distinctive clicking sound when they walk or run, which helps them communicate with each other and keep their herds together'),
        ('Hippopotamus','Mammel','Despite their large size and bulky appearance, hippos are surprisingly agile in water and can move at speeds of up to 20 miles per hour');
        </pre>


</main>

<?php 
include 'footer.php'; 
?>
</body>
</html>