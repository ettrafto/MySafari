<?php
include 'top.php';


//sanitization function
function getData($field){
        if (!isset($_POST[$field])){
            $data="";
        } else {
            $data = trim($_POST[$field]);
            $data = htmlspecialchars($data);
        }
        return $data;
    }
    
    function verifyAlphaNum($testString){
        return (preg_match ("/^([[:alnum]]|-|\'|&|;|#)+$/", $testString)) == 1;
    }
    
    $mySkills = array('Logistics & Planning','Risk Management','Leave No Trace','Navigating','Backcountry Skills');
    //can use !in_array to validate multi selects 

//declaring variables for stickyness
$fName;
$lName; 
$email; 
$history; 
$planning;
$riskM;
$LNT;
$navigation;
$backcountry;
$suprised;
$friends; 
$skills; 
$comments; 

$dataIsGood =false;
?>

        <main>
                <section class="header">
                        <h2>Me</h2>
                </section> 
                <section id="me-cont">
                        <figure id="me-img">
                                <img alt="other image 71" 
                                src="images/other/71.jpg" >
                        </figure>
                        <section id="me-text">
                                <h2>I am Evan...</h2>
                        </section>
                        <section id="me-form">

                                <?php
                                               
                                //print '<p>Post Array:</p><pre>';
                                //print_r($_POST);
                                print '</pre>';
                                if ($_SERVER["REQUEST_METHOD"] == "POST"){
                                        $dataIsGood = true;

                                        print PHP_EOL . '<!--Starting Sanitization-->' . PHP_EOL;
                                        $fName = getData("txtFirstName");
                                        $lName = getData("txtLastName");
                                        $email = getData("txtEmail");
                                        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                                        $history = getData("radHistory");

                                        $planning = (int) getData("chkPlanning");
                                        $riskM = (int) getData("chkRiskM");
                                        $LNT = (int) getData("chkLNT");
                                        $navigation = (int) getData("chkNavigation");
                                        $backcountry = (int) getData("chkBackcountry");

                                        $suprised = getData("txtSuprised");
                                        $friends = getData("radFriends");
                                        $skills = getData("MultiSkills");
                                        $comments = getData("txtComments");
                                

                                
                                print PHP_EOL . '<!--Starting Validation-->' . PHP_EOL;

                                if ($fName ==""){
                                        print '<p class="mistake">Please enter your first name.</p>';
                                        $dataIsGood = false;
                                } elseif (verifyAlphaNum($fName)) {
                                        print('<p class="mistake">Your first name contains extra character that ');
                                        print('that are not allowed. Use only letters, numbers, hyphens and spaces. </p>');
                                        $dataIsGood = false;
                                }
                                
                                if ($lName ==""){
                                        print '<p class="mistake">Please enter your last name.</p>';
                                        $dataIsGood = false;
                                } elseif (verifyAlphaNum($lName)) {
                                        print('<p class="mistake">Your first name contains extra character that ');
                                        print('that are not allowed. Use only letters, numbers, hyphens and spaces. </p>');
                                        $dataIsGood = false;
                                }
                                
                                if ($email ==""){
                                        print '<p class="mistake">Please enter your email address</p>';
                                        $dataIsGood = false;
                                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                                        print "Your email address contains illegal characters.";
                                        $dataIsGood = false;
                                } 
                                
                                if ($dataIsGood){
                                        
                                        // Prepare email components
                                        $to = 'ettrafto@uvm.edu'; // Replace with recipient's email address
                                        $subject = 'New Form Submission';
                                        
                                        // Email message
                                        $message = "You have received a new submission:\n\n";
                                        $message .= "First Name: " . $fName . "\n";
                                        $message .= "Last Name: " . $lName . "\n";
                                        $message .= "Email: " . $email . "\n";
                                        $message .= "Comments: " . $comments . "\n";
                                        // Add other fields as needed
                                
                                        // Email headers
                                        $headers = 'From: ettrafto@uvm.edu' . "\r\n"; // Replace with your email address
                                        $headers .= 'Reply-To: ' . $email . "\r\n";
                                        $headers .= 'X-Mailer: PHP/' . phpversion();
                                
                                        // Send the email
                                        if (mail($to, $subject, $message, $headers)) {
                                                echo '<section id=\'me-text\'><h2>Mail Sent!</h2></section>';
                                        } else {
                                                echo '<section id=\'me-text\'><h2>Mail Not Sent</h2></section>';
                                        }
                                        
                                        
                                        /*
                                        $sql = "INSERT INTO tblFormCollection (fldfName, fldlName, fldemail, fldcomments) VALUES (?, ?, ?, ?)";
                                        $params = array($fName, $lName, $email, $comments);
                                        
                                        //print_r($params);

                                        /*$sqlText = $sql;        
                                        foreach ($sql as $value){
                                                $pos =strpos($sqlText,'?');
                                                if ($pos !== false){
                                                        $sqlText = substr_replace($sqlText, "" . $value . "",$pos, strlen('?'));
                                                }
                                        }
                                        print "<p> .  $sqlText .</p>";
                                        */

                                        try {
                                                $statement = $pdo->prepare($sql);

                                                if ($statement->execute($params)) {
                                                        print('<h2>Thank you, your information has been received.</h2>');
                                                } else {
                                                        print('<p>Record was NOT successfully saved.</p>');
                                                }
                                        } catch (PDOException $e) {
                                            print('<p>Couldn\'t insert the record</p>');
                                        }
                                    }
                                }
                                
                                ?>

                         
                                <form action = "#" method = "POST">
                                        
                                        <fieldset class = "contact">
                                                <legend>Contact Me?</legend>
                                                <p>
                                                <label class = "label" for = "txtFirstName">First Name:</label>
                                                <input type = "text"     
                                                        name = "txtFirstName"
                                                        id = "txtFirstName"
                                                        tabindex="160"
                                                        value ="<?php print $fName; ?>"
                                                        required>
                                                </p>   

                                                <p>
                                                <label class = "label" for = "txtLastName">Last Name:</label>
                                                <input type = "text"     
                                                        name = "txtLastName"
                                                        id = "txtLastName"
                                                        tabindex="170"
                                                        value ="<?php print $lName; ?>"
                                                        required>
                                                </p>   
                                                <p>
                                                <label class = "label" for = "txtEmail">Email:</label>
                                                <input type = "email"     
                                                        name = "txtEmail"
                                                        id = "txtEmail"
                                                        tabindex="180"
                                                        value ="<?php print $email; ?>"
                                                        required>
                                                                                                </p>
                                        </fieldset>

                                        <!--<fieldset class="radio">
                                                <legend>Have you ever used any of these skills and strategies to plan and go on a hike? </legend>
                                                <p>
                                                <input type="radio" 
                                                        id="radHistoryYes" 
                                                        name="radHistory" 
                                                        value="Yes" 
                                                        tabindex="200"
                                                        <?php// if($history == 'Yes') print('checked') ?>
                                                        >
                                                <label class="radio-field" 
                                                        for = "radHistoryYes">Yes</label>
                                                </p>

                                                <p>
                                                <input type="radio" 
                                                        id="radHistoryNo" 
                                                        name="radHistory" 
                                                        value="No" 
                                                        tabindex="210" 
                                                        <?php// if($history == 'No') print('checked') ?>>
                                                        <label class="radio-field" 
                                                        for = "radHistoryNo">No</label>
                                                </p>

                                                <p>
                                                <input type="radio" 
                                                        id="radHistoryNoBut" 
                                                        name="radHistory" 
                                                        value="NoButInterested" 
                                                        tabindex="220" 
                                                        <?php// if($history == 'NoButInterested') print('checked') ?>>
                                                <label class="radio-field" 
                                                        for = "radHistoryNoBut">No, but i'm interested</label>
                                                </p>
                                        </fieldset>

                                        <fieldset class="checkbox">
                                                <legend>If you have used any of these skills, which ones?</legend>

                                                <p>
                                                <input
                                                        id="chkPlanning"
                                                        name="chkPlanning"
                                                        type="checkbox"
                                                        tabindex="300" 
                                                        value="1"
                                                        <?php// if($planning) print('checked') ?>>
                                                <label for="chkPlanning">Planning & Logistics</label>
                                                </p>

                                                <p>
                                                <input
                                                        id="chkRiskM"
                                                        name="chkRiskM"
                                                        type="checkbox"
                                                        tabindex="310" 
                                                        value="1"
                                                        <?php// if($riskM) print('checked') ?>>
                                                <label for="chkRiskM">Risk Management</label>
                                                </p>

                                                <p>
                                                <input
                                                        id="chkLNT"
                                                        name="chkLNT"
                                                        type="checkbox"
                                                        tabindex="320"
                                                        value="1"
                                                        <?php// if($LNT) print('checked') ?>>
                                                <label for="chkLNT">Leave No Trace</label>
                                                </p>

                                                <p>
                                                <input
                                                        id="chkNavigation"
                                                        name="chkNavigation"
                                                        type="checkbox"
                                                        tabindex="330"
                                                        value="1"
                                                        <?php// if($navigation) print('checked') ?>>
                                                <label for="chkNavigation">Navigation</label>
                                                </p>
                                                <p>
                                                <input
                                                        id="chkBackcountry"
                                                        name="chkBackcountry"
                                                        type="checkbox"
                                                        tabindex="340"
                                                        value="1"
                                                        <?php// if($backcountry) print('checked') ?>>
                                                <label for="chkBackcountry">Backcountry Skills</label>
                                                </p>
                                        </fieldset>
                                        <fieldset class="textarea">
                                                <p>
                                                <label for="txtSuprised">Were you suprised that any of the skills or strategies are important to safely hiking?</label>
                                                <textarea
                                                        id="txtSuprised" 
                                                        tabindex="400"
                                                        name="txtSuprised" ><?php// print $suprised; ?></textarea>
                                                </p>
                                        </fieldset>
                                        <fieldset class="radio">
                                                <legend>Would you want any of your friends or family going on a challenging hike without understanding most of this information?</legend>
                                                <p>
                                                <input type="radio" 
                                                        id="radFriendsYes" 
                                                        name="radFriends" 
                                                        value="Yes" 
                                                        tabindex="500"
                                                        <?php// if($friends == 'Yes') print('checked') ?>
                                                        >
                                                <label class="radio-field" 
                                                        for = "radFriendsYes">Yes</label>
                                                </p>

                                                <p>
                                                <input type="radio" 
                                                        id="radFriendsNo" 
                                                        name="radFriends" 
                                                        value="No" 
                                                        tabindex="510" 
                                                        <?php// if($friends == 'No') print('checked') ?>>
                                                        <label class="radio-field" 
                                                        for = "radFriendsNo">No</label>
                                                </p>

                                        </fieldset>
                                        <fieldset  class="listbox">

                                                <legend>Which skills do you feel like are the most important to a successful hike?</legend>
                                                <p>
                                                <select id="MultiSkills" 
                                                        name="MultiSkills"
                                                        tabindex="600">
                                                        <option value="Logistics & Planning"<?php// if($skills == "Logistics & Planning") print('selected') ?>>Logistics & Planning</option>
                                                        <option value="Risk Management"<?php// if($skills == "Risk Management") print('selected') ?>>Risk Management</option>
                                                        <option value="Leave No Trace"<?php// if($skills == "Leave No Trace") print('selected') ?>>Leave No Trace</option>
                                                        <option value="Navigating"<?php// if($skills == "Navigating") print('selected') ?>>Navigating</option>
                                                        <option value="Backcountry Skills"<?php// if($skills == "Backcountry Skills") print('selected') ?>>Backcountry Skills</option>
                                                </select>
                                                </p>
                                        </fieldset>-->
                                        
<fieldset class="textarea">
                                                <p>
                                                        <label for="txtComments">Message:</label>
                                                        <textarea
                                                                id="txtComments" 
                                                                tabindex="700"
                                                                name="txtComments" ><?php print $comments; ?></textarea>
                                                </p>
                                        </fieldset>

                                        <fieldset class="buttons">
                                                <input id = "btnSubmit" 
                                                name = "btnSubmit" 
                                                type = "submit" 
                                                tabindex="800"
                                                value = "Submit" >
                                        </fieldset>
                                </form>
                        </section>
                </section>

                
                <section class="x2">
                        <figure class="x2item">
                                <img alt="other image 72" 
                                src="images/other/72.jpg" >
                        </figure>
                        <figure class="x2item">
                                <img alt="other image 73" 
                                src="images/other/73.jpg" >
                        </figure>
                </section>

 <!--               <section>
                <iframe style="text-align:center;" width="560" height="315" src="https://www.youtube.com/embed/zpppEE2jc6Y" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </section>

                <section>

                <?php
                        $Animals = array(
                        array('Lion','Mammel','Many of the funny faces lions make are due to them sniffing hormones left by other lions to mark territory'),
                        array('Giraffe','Mammel','Giraffe are the most common animal to exhibit homosexual behavior in the wild'),
                        array('Antelope','Mammel', 'some species of antelopes have specially adapted hooves that make a distinctive clicking sound when they walk or run, which helps them communicate with each other and keep their herds together'),
                        array('Hippopotamus','Mammel','Despite their large size and bulky appearance, hippos are surprisingly agile in water and can move at speeds of up to 20 miles per hour'));
        
                ?>        

                        <table>
                                <tr>
                                <th>Animal</th>
                                <th>Genus</th>
                                <th>Fun Fact</th>
                                </tr>
                                <?php
/*
                                foreach($Animals as $Animal){
                                print '<tr>';
                                print '<td>'. $Animal[0].'</td>';
                                print '<td>'. $Animal[1].'</td>';
                                print '<td>'. $Animal[2].'</td>';
                                print '</tr>'.PHP_EOL;
                                }
*/                                ?>
                        </table>
                </section>
                        -->
        </main>
        
        <?php include 'footer.php';?>

    </body>
</html>