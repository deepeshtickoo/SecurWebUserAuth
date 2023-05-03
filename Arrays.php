<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css" /></head>
<body>
<?php
include 'databaseCon.php';
session_start();

if($_SESSION){
    if($_SESSION['admin'])
        header("location: admin.php");
    elseif(!$_SESSION['admin'])
        header("location: Loggedin.php");
}

    if(isset($_POST['forgotpassbutton'])){
        echo "<script>alert('YOU FORGOT UR PASSWORD EH?!');</script>";
    }
    if(isset($_POST['signupbutton'])){
            echo '<style>#Login{ display:none;} #Registration{display:flex;visibility:visible;}</style>';
    }


    if( isset($_POST['Login']) ){
        $usernamelogin=hash('sha3-512',htmlentities($_POST['username']));
        $passwordlogin=hash('sha3-512',htmlentities($_POST['password']));
      

        $sqllog1="SELECT username from users where username='$usernamelogin'";
        $sqllog="SELECT password from users where username='$usernamelogin'";
        $queryUsername= mysqli_query(getConn(),$sqllog1);

        if(is_null(mysqli_fetch_row($queryUsername))){
            echo"<script>alert('Username and/or Password are incorrect here bro!')</script>";
        }
        else{
            $query= mysqli_query(getConn(),$sqllog);
            $result=mysqli_fetch_assoc($query); // fetch password associated with username entered
            $email=mysqli_fetch_assoc(mysqli_query(getConn(),"Select email from users where username='$usernamelogin'"));
            if($passwordlogin == implode($result)){
                echo"<script>alert('Login Successful!')</script>";
                session_regenerate_id();
                $_SESSION['loggedin']=TRUE;
                $_SESSION['username']= $usernamelogin;
                $_SESSION['loginTime']=time();
                $admins=fopen("temp.txt","r");
                if($admins){
                    $adminemails = file('temp.txt', FILE_SKIP_EMPTY_LINES|FILE_IGNORE_NEW_LINES);
                    echo $email;
                    foreach($adminemails as $line){
                        if(implode($email)==$line){
                            $_SESSION['admin']=TRUE;
                        }
                    }
                }
                fclose($admins);
                if($_SESSION['admin']){
                    header('Location: /admin.php');
                }
                elseif(!$_SESSION['admin']){
                    header('Location: /Loggedin.php');
                }
                //      GET LOGING PAGE
            }
            else
                echo"<script>alert('Username and/or Password are incorrect baba!')</script>";

        }
    }

    if( isset($_POST['status']) )
    {
        //$status=""; $country=""; $firstname=""; $lastname=""; $email=""; $children=0;

        $username = hash('sha3-512',htmlentities($_POST['username']));
        $password = hash('sha3-512',htmlentities($_POST['password']));

        $status= htmlentities($_POST['status']);
        $country= htmlentities($_POST['country']);
        $firstname= htmlentities($_POST['firstname']);
        $lastname= htmlentities($_POST['lastname']);
        $email= htmlentities($_POST['email']);
        $children= htmlentities($_POST['children']);

        if(htmlentities($_POST['password'])!=htmlentities($_POST['repassword'])){
                    echo"<script>alert('Please make sure passwords match!');</script>";
                }
        else{
            $sql="INSERT INTO users(username, password, status, country, firstname, lastname, email, children)
            VALUES ('$username', '$password', '$status', '$country', '$firstname', '$lastname', '$email', '$children')";
            if(mysqli_query(getConn(),$sql))
                echo"<script>alert('Entry Successful!')</script>";
             else
                echo"<script>alert('Entry Error!')</script>";
        }
    }

    if(isset($_POST['forgotpassbutton'])){
        echo "<script>alert('That Sucks for you ! XD');</script>";
    }
?>

<div id="Login">
    <form method="post">
        <img src="Login.png" width="100" height="100"/>
        <h1>Login</h1>
        <p>Sign-in to continue</p>
        <div id="inputs">
            <label for="username">Username</label><br>
            <input type="text" placeholder="Enter username" name="username" label="username" id="username"required><br>

            <label for="password">Password</label><br>
            <input type="password" placeholder="Enter Password" name="password" label="password" id="password" required><br>
        </div>
        <button id="button"class="glow-on-hover"type="submit" name="Login">Login</button><br>
    </form>
    <form method="post">
        <button name="forgotpassbutton" id="forgotpassbutton" ><h3>Forgot Password?</h3></button>
        <button name="signupbutton" id="Signupbutton" action=""><h3>Sign Up</h3></button>
    </form>
<!--
       #########  Pass the values to function and verify the hash of password and username entered  ##########
-->
</div>




<div id="Registration">
        <span id="alert" style="display:none">Minimum of 10 characters</span>
        <span id="alert1" style="display:none">Minimum of 1 special character</span>
        <span id="alert2" style="display:none">Minimum of 1 uppercase character</span>
        <span id="alert3" style="margin-bottom:10px;display:none" >Passwords must match</span>
    <form method="post" name="registeruser">
    <div id="login">
         <label>First name: </label><br>
         <input type="text" placeholder="Enter firstname" name="firstname"required><br>

         <label>Last name: </label><br>
         <input type="text" placeholder="Enter lastname" name="lastname" required><br>

         <label>Email address: </label><br>
         <input type="text" placeholder="Enter email" name="email" id="verifyemail"required><br>

         <label>Country: </label><br>
         <select id="country" name="country"required>
             <option style="display:none"></option>
             <option value="AF">Afghanistan</option>
             <option value="AX">Aland Islands</option>
             <option value="AL">Albania</option>
             <option value="DZ">Algeria</option>
             <option value="AS">American Samoa</option>
             <option value="AD">Andorra</option>
             <option value="AO">Angola</option>
             <option value="AI">Anguilla</option>
             <option value="AQ">Antarctica</option>
             <option value="AG">Antigua and Barbuda</option>
             <option value="AR">Argentina</option>
             <option value="AM">Armenia</option>
             <option value="AW">Aruba</option>
             <option value="AU">Australia</option>
             <option value="AT">Austria</option>
             <option value="AZ">Azerbaijan</option>
             <option value="BS">Bahamas</option>
             <option value="BH">Bahrain</option>
             <option value="BD">Bangladesh</option>
             <option value="BB">Barbados</option>
             <option value="BY">Belarus</option>
             <option value="BE">Belgium</option>
             <option value="BZ">Belize</option>
             <option value="BJ">Benin</option>
             <option value="BM">Bermuda</option>
             <option value="BT">Bhutan</option>
             <option value="BO">Bolivia</option>
             <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
             <option value="BA">Bosnia and Herzegovina</option>
             <option value="BW">Botswana</option>
             <option value="BV">Bouvet Island</option>
             <option value="BR">Brazil</option>
             <option value="IO">British Indian Ocean Territory</option>
             <option value="BN">Brunei Darussalam</option>
             <option value="BG">Bulgaria</option>
             <option value="BF">Burkina Faso</option>
             <option value="BI">Burundi</option>
             <option value="KH">Cambodia</option>
             <option value="CM">Cameroon</option>
             <option value="CA">Canada</option>
             <option value="CV">Cape Verde</option>
             <option value="KY">Cayman Islands</option>
             <option value="CF">Central African Republic</option>
             <option value="TD">Chad</option>
             <option value="CL">Chile</option>
             <option value="CN">China</option>
             <option value="CX">Christmas Island</option>
             <option value="CC">Cocos (Keeling) Islands</option>
             <option value="CO">Colombia</option>
             <option value="KM">Comoros</option>
             <option value="CG">Congo</option>
             <option value="CD">Congo, Democratic Republic of the Congo</option>
             <option value="CK">Cook Islands</option>
             <option value="CR">Costa Rica</option>
             <option value="CI">Cote D'Ivoire</option>
             <option value="HR">Croatia</option>
             <option value="CU">Cuba</option>
             <option value="CW">Curacao</option>
             <option value="CY">Cyprus</option>
             <option value="CZ">Czech Republic</option>
             <option value="DK">Denmark</option>
             <option value="DJ">Djibouti</option>
             <option value="DM">Dominica</option>
             <option value="DO">Dominican Republic</option>
             <option value="EC">Ecuador</option>
             <option value="EG">Egypt</option>
             <option value="SV">El Salvador</option>
             <option value="GQ">Equatorial Guinea</option>
             <option value="ER">Eritrea</option>
             <option value="EE">Estonia</option>
             <option value="ET">Ethiopia</option>
             <option value="FK">Falkland Islands (Malvinas)</option>
             <option value="FO">Faroe Islands</option>
             <option value="FJ">Fiji</option>
             <option value="FI">Finland</option>
             <option value="FR">France</option>
             <option value="GF">French Guiana</option>
             <option value="PF">French Polynesia</option>
             <option value="TF">French Southern Territories</option>
             <option value="GA">Gabon</option>
             <option value="GM">Gambia</option>
             <option value="GE">Georgia</option>
             <option value="DE">Germany</option>
             <option value="GH">Ghana</option>
             <option value="GI">Gibraltar</option>
             <option value="GR">Greece</option>
             <option value="GL">Greenland</option>
             <option value="GD">Grenada</option>
             <option value="GP">Guadeloupe</option>
             <option value="GU">Guam</option>
             <option value="GT">Guatemala</option>
             <option value="GG">Guernsey</option>
             <option value="GN">Guinea</option>
             <option value="GW">Guinea-Bissau</option>
             <option value="GY">Guyana</option>
             <option value="HT">Haiti</option>
             <option value="HM">Heard Island and Mcdonald Islands</option>
             <option value="VA">Holy See (Vatican City State)</option>
             <option value="HN">Honduras</option>
             <option value="HK">Hong Kong</option>
             <option value="HU">Hungary</option>
             <option value="IS">Iceland</option>
             <option value="IN">India</option>
             <option value="ID">Indonesia</option>
             <option value="IR">Iran, Islamic Republic of</option>
             <option value="IQ">Iraq</option>
             <option value="IE">Ireland</option>
             <option value="IM">Isle of Man</option>
             <option value="IL">Israel</option>
             <option value="IT">Italy</option>
             <option value="JM">Jamaica</option>
             <option value="JP">Japan</option>
             <option value="JE">Jersey</option>
             <option value="JO">Jordan</option>
             <option value="KZ">Kazakhstan</option>
             <option value="KE">Kenya</option>
             <option value="KI">Kiribati</option>
             <option value="KP">Korea, Democratic People's Republic of</option>
             <option value="KR">Korea, Republic of</option>
             <option value="XK">Kosovo</option>
             <option value="KW">Kuwait</option>
             <option value="KG">Kyrgyzstan</option>
             <option value="LA">Lao People's Democratic Republic</option>
             <option value="LV">Latvia</option>
             <option value="LB">Lebanon</option>
             <option value="LS">Lesotho</option>
             <option value="LR">Liberia</option>
             <option value="LY">Libyan Arab Jamahiriya</option>
             <option value="LI">Liechtenstein</option>
             <option value="LT">Lithuania</option>
             <option value="LU">Luxembourg</option>
             <option value="MO">Macao</option>
             <option value="MK">Macedonia, the Former Yugoslav Republic of</option>
             <option value="MG">Madagascar</option>
             <option value="MW">Malawi</option>
             <option value="MY">Malaysia</option>
             <option value="MV">Maldives</option>
             <option value="ML">Mali</option>
             <option value="MT">Malta</option>
             <option value="MH">Marshall Islands</option>
             <option value="MQ">Martinique</option>
             <option value="MR">Mauritania</option>
             <option value="MU">Mauritius</option>
             <option value="YT">Mayotte</option>
             <option value="MX">Mexico</option>
             <option value="FM">Micronesia, Federated States of</option>
             <option value="MD">Moldova, Republic of</option>
             <option value="MC">Monaco</option>
             <option value="MN">Mongolia</option>
             <option value="ME">Montenegro</option>
             <option value="MS">Montserrat</option>
             <option value="MA">Morocco</option>
             <option value="MZ">Mozambique</option>
             <option value="MM">Myanmar</option>
             <option value="NA">Namibia</option>
             <option value="NR">Nauru</option>
             <option value="NP">Nepal</option>
             <option value="NL">Netherlands</option>
             <option value="AN">Netherlands Antilles</option>
             <option value="NC">New Caledonia</option>
             <option value="NZ">New Zealand</option>
             <option value="NI">Nicaragua</option>
             <option value="NE">Niger</option>
             <option value="NG">Nigeria</option>
             <option value="NU">Niue</option>
             <option value="NF">Norfolk Island</option>
             <option value="MP">Northern Mariana Islands</option>
             <option value="NO">Norway</option>
             <option value="OM">Oman</option>
             <option value="PK">Pakistan</option>
             <option value="PW">Palau</option>
             <option value="PS">Palestinian Territory, Occupied</option>
             <option value="PA">Panama</option>
             <option value="PG">Papua New Guinea</option>
             <option value="PY">Paraguay</option>
             <option value="PE">Peru</option>
             <option value="PH">Philippines</option>
             <option value="PN">Pitcairn</option>
             <option value="PL">Poland</option>
             <option value="PT">Portugal</option>
             <option value="PR">Puerto Rico</option>
             <option value="QA">Qatar</option>
             <option value="RE">Reunion</option>
             <option value="RO">Romania</option>
             <option value="RU">Russian Federation</option>
             <option value="RW">Rwanda</option>
             <option value="BL">Saint Barthelemy</option>
             <option value="SH">Saint Helena</option>
             <option value="KN">Saint Kitts and Nevis</option>
             <option value="LC">Saint Lucia</option>
             <option value="MF">Saint Martin</option>
             <option value="PM">Saint Pierre and Miquelon</option>
             <option value="VC">Saint Vincent and the Grenadines</option>
             <option value="WS">Samoa</option>
             <option value="SM">San Marino</option>
             <option value="ST">Sao Tome and Principe</option>
             <option value="SA">Saudi Arabia</option>
             <option value="SN">Senegal</option>
             <option value="RS">Serbia</option>
             <option value="CS">Serbia and Montenegro</option>
             <option value="SC">Seychelles</option>
             <option value="SL">Sierra Leone</option>
             <option value="SG">Singapore</option>
             <option value="SX">Sint Maarten</option>
             <option value="SK">Slovakia</option>
             <option value="SI">Slovenia</option>
             <option value="SB">Solomon Islands</option>
             <option value="SO">Somalia</option>
             <option value="ZA">South Africa</option>
             <option value="GS">South Georgia and the South Sandwich Islands</option>
             <option value="SS">South Sudan</option>
             <option value="ES">Spain</option>
             <option value="LK">Sri Lanka</option>
             <option value="SD">Sudan</option>
             <option value="SR">Suriname</option>
             <option value="SJ">Svalbard and Jan Mayen</option>
             <option value="SZ">Swaziland</option>
             <option value="SE">Sweden</option>
             <option value="CH">Switzerland</option>
             <option value="SY">Syrian Arab Republic</option>
             <option value="TW">Taiwan, Province of China</option>
             <option value="TJ">Tajikistan</option>
             <option value="TZ">Tanzania, United Republic of</option>
             <option value="TH">Thailand</option>
             <option value="TL">Timor-Leste</option>
             <option value="TG">Togo</option>
             <option value="TK">Tokelau</option>
             <option value="TO">Tonga</option>
             <option value="TT">Trinidad and Tobago</option>
             <option value="TN">Tunisia</option>
             <option value="TR">Turkey</option>
             <option value="TM">Turkmenistan</option>
             <option value="TC">Turks and Caicos Islands</option>
             <option value="TV">Tuvalu</option>
             <option value="UG">Uganda</option>
             <option value="UA">Ukraine</option>
             <option value="AE">United Arab Emirates</option>
             <option value="GB">United Kingdom</option>
             <option value="US">United States</option>
             <option value="UM">United States Minor Outlying Islands</option>
             <option value="UY">Uruguay</option>
             <option value="UZ">Uzbekistan</option>
             <option value="VU">Vanuatu</option>
             <option value="VE">Venezuela</option>
             <option value="VN">Viet Nam</option>
             <option value="VG">Virgin Islands, British</option>
             <option value="VI">Virgin Islands, U.s.</option>
             <option value="WF">Wallis and Futuna</option>
             <option value="EH">Western Sahara</option>
             <option value="YE">Yemen</option>
             <option value="ZM">Zambia</option>
             <option value="ZW">Zimbabwe</option>
         </select><br>

         <label>Marital status: </label><br>
         <select id="status" name="status"required>
            <option style="display:none"></option>
            <option value="married">Married</option>
            <option value="single">Single</option>
         </select><br>

         <label for="kids">Number of children: </label><br>
         <input type="text" placeholder="Enter number" name="children"required><br>

        <label for="username">Username: </label><br>
        <input type="text" placeholder="Enter username" name="username"required><br>

        <label for="password">Password: </label><br>
        <input type="password" placeholder="Enter password" name="password" id="id1"required><br>

        <label for="password">Password: </label><br>
        <input type="password" placeholder="Re-enter password" name="repassword" id="id" required><br>
        
    </div>
        <button class="glow-on-hover"id="signupbutton" onclick="password()">Sign Up</button>
    </form>

</div>


<div id="Welcome">
    <div id="buttonsmain">
        <button class="glow-on-hover"type="submit" name="login" value="send" id="login">Login</button>
        <button class="glow-on-hover"type="submit" name="signup" value="send" id="signup">Sign Up</button>
    </div>
</div>



<div class="Accountsettings">
<!--
  ####################   Get account information allow user edits of account information  ####################
-->
</div>



<div class="Users">
<!--
             ######################### Access only to admins  #############################
                        Show list of users with delete option next to usernames
-->
</div>



</body>
<footer><script src="php.js"></script></footer>

</html>