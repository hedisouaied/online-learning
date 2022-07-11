<?php
ob_start();

$pagetitle = 'incription';
include 'header.php';
if (isset($_SESSION['client'])) {
    header('location:index.php');
}
$msg_mail = "";



if (isset($_POST['signup'])) {



    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $country = filter_var($_POST['dawla'], FILTER_SANITIZE_STRING);
    $phone = (filter_var($_POST['code_p'], FILTER_SANITIZE_STRING)) . ',' . (filter_var($_POST['phone'], FILTER_SANITIZE_STRING));
    $genre = filter_var($_POST['genre'], FILTER_SANITIZE_STRING);
    $poste = filter_var($_POST['poste'], FILTER_SANITIZE_STRING);
    $entreprise = filter_var($_POST['entreprise'], FILTER_SANITIZE_STRING);

    $row = "SELECT * FROM `clients` where email='" . $email . "' ";

    $exect = mysqli_query($conn, $row);

    $array = mysqli_fetch_array($exect);

    $result = mysqli_num_rows($exect);
    if ($result !== 0) {
        $msg_mail = '
        <div class="alert alert-soft-danger d-flex" role="alert">
                <i class="material-icons mr-12pt">dangerous</i>
                <div class="text-body">Cet E-mail est déja existé !!!</div>
            </div>';
    } else {

        $req = "INSERT INTO `clients` (`fullname`, `email`, `password`, `country`, `phone`, `genre`, `poste`, `entreprise`) VALUES ('" . $name . "','" . $email . "','" . $password . "','" . $country . "','" . $phone . "','" . $genre . "','" . $poste . "','" . $entreprise . "')";
        $exec = mysqli_query($conn, $req);
  
  
  	$to = $email;
  	        $subject = "Inscription sur e-smarttec.com";

   $message="<html>
<head>
    <meta charset=\"utf-8\">
    <title>Inscription e-smarttec.com</title>
    
<style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 10px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 5px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 10px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    </style>
</head>

<body>
    <div class=\"invoice-box\">
        <table cellpadding=\"0\" cellspacing=\"0\">
            <tr class=\"top\">
                <td colspan=\"6\">
                    <table>
                        <tr>
                            <td class=\"title\">
                                <img alt='e-smarttec logo' src=\"http://e-smarttec.com/uploads/logo/black.svg\" style=\"width:100%; max-width:300px;\">                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class=\"information\">
                <td colspan=\"6\">
                    <table>
                    
                        <tr>
                            <td  style=\" font-weight: bold; padding-bottom: 0;font-size:13px;\"> http://e-smarttec.com/</td>
                            <td  style=\" border-bottom: 1px solid #ddd; font-weight: bold; padding-bottom: 0;\"> Détail de Client </td>
                            <td  style=\" border-bottom: 1px solid #ddd; font-weight: bold; padding-bottom: 0;\"> Adresse de client </td>
                        </tr>
                        <tr>
                            <td style=\" font-weight: bold;font-size:15px; \">
                                Avenue Louis Braille,  <br>Tunis 1002 <br> Tunisie <br>
                            </td>
                            <td >
                                 Nom et Prénom: $name, <br> Téléphone: ".(filter_var($_POST['code_p'], FILTER_SANITIZE_STRING)) . (filter_var($_POST['phone'], FILTER_SANITIZE_STRING)) ." <br> E-mail: $email <br> Mot de passe: $password 
                            </td>
                            <td >
                                Pays:  $country <br>
                            </td>
                        </tr>
                      
                    ";


        $message .= "
        </table>
                </td>
            </tr>
            
        </table>
    </div>
</body>
</html>";
         $headers = "From: e-smarttec <" . $array_about['Email'] . "> \r\n";
                            $headers .= "Reply-To:" . $array_about['Email'] . "\r\n";
                            $headers .= 'MIME-Version: 1.0' . "\r\n" .
                                'Content-type: text/html; ' . "\r\n" .

                                'X-Mailer: PHP/' . phpversion();

                            mail($to, $subject, $message, $headers);
       // header('location:login.php?success');
       
       
        $row = "SELECT * FROM `clients` where email='" . $email . "' and password='" . $password . "' ";
        $exect = mysqli_query($conn, $row);
        $array = mysqli_fetch_array($exect);
        
         $_SESSION['client'] = true;
        $_SESSION['id'] = $array['ID'];
        $_SESSION['name'] = $array['fullname'];
        $_SESSION['email'] = $array['email'];
        $_SESSION['phone'] = $array['phone'];
        $_SESSION['photo'] = $array['photo'];
        if(isset($_POST['reserve_id'])){
            $type = "Direct";
            $user_id = $_SESSION['id'];
            $ID_li = $_POST['reserve_id'];
            $req_check = "SELECT * FROM `checkout` WHERE ID_p = " . $ID_li . " AND ID_sess = " . $user_id . " AND type_p = '" . $type . "' ";
            $exec_check = mysqli_query($conn, $req_check);
            $check = mysqli_num_rows($exec_check);
            if ($check == 0) {
        
        
                $req = "INSERT INTO `checkout` (`ID_p`, `ID_sess`, `type_p`,`date`) VALUES ('" . $ID_li . "','" . $user_id . "','" . $type . "',now())";
        
                $exec = mysqli_query($conn, $req);
                
            }
            header("location: mescours.php");
        }else{
            header("location: index.php");
        }
        
        
       
    }
}
?>
<div class="layout-login-centered-boxed__form card" style="margin: auto;margin-top: 6rem;margin-bottom: 3rem;">
    <div class="d-flex flex-column justify-content-center align-items-center mt-2 mb-5 navbar-light">
        <a href="index.php" class="navbar-brand flex-column mb-2 align-items-center mr-0" style="min-width: 0">

            <span class="avatar avatar-sm navbar-brand-icon mr-0" style="width: 5.5rem;height: 5.5rem;">

                <span class="avatar-title rounded bg-primary" style="background-color: white !important;"><img src="uploads/logo/black.svg" alt="logo" class="img-fluid" /></span>

            </span>

            SmarTTec
        </a>
        <p class="m-0">Créer un nouveau compte SmarTTec</p>
    </div>



    <form action="" method="POST">
        <?php echo $msg_mail; 
        
        if(isset($_GET['reserve_id'])){
            ?>
            <input type="hidden" name="reserve_id" value="<?php echo $_GET['reserve_id']; ?>">
            <?php
        }
        ?>
        <div class="form-group">
            <label class="text-label" for="name_2">Nom et Prénom:</label>
            <div class='row' style="margin: 0;">
                <div class='col-md-3' style="padding: 0;">
                    <div class="input-group input-group-merge">
                        <select id="email_2" class="form-control form-control-prepended" name="genre">
                            <option value="mr">Mr</option>
                            <option value="ms">Mme</option>
                        </select>


                    </div>
                </div>
                <div class='col-md-9' style="padding: 0;">
                    <div class="input-group input-group-merge">
                        <input id="name_2" type="text" required="" class="form-control form-control-prepended" placeholder="John Jack" name="name">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="far fa-user"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="text-label" for="email_2">Adresse Email:</label>
            <div class="input-group input-group-merge">
                <input id="email_2" type="email" required="" class="form-control form-control-prepended" placeholder="johnjack@gmail.com" name="email">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="far fa-envelope"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="text-label" for="password_2">Mot de passe:</label>
            <div class="input-group input-group-merge">
                <input id="password_2" type="password" required="" class="form-control form-control-prepended" placeholder="Entrer votre mot de passe" name="password">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="fa fa-key"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="text-label" for="email_2">Poste: (optionnel)</label>
            <div class="input-group input-group-merge">
                <input id="email_2" type="text" class="form-control form-control-prepended" placeholder="Votre poste de travail" name="poste">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="fa fa-tools"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="text-label" for="email_2">Nom de l'entreprise: (optionnel)</label>
            <div class="input-group input-group-merge">
                <input id="email_2" type="text" class="form-control form-control-prepended" placeholder="Nom d'entreprise" name="entreprise">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="far fa-building"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="text-label" for="email_2">Pays:</label>
            <div class="input-group input-group-merge">
                <select id="email_2" class="form-control form-control-prepended" name="dawla" onchange='x =this.options[this.selectedIndex].getAttribute("data-code");var ssd = document.getElementById("sspp");ssd.innerHTML = x; var cpp = document.getElementById("ccp");cpp.value = x; '>
                 <option data-code="+27" value="Afrique du Sud">Afrique du Sud</option>
<option data-code="+213" value="Algérie">Algérie</option>
<option data-code="+49" value="Allemagne">Allemagne</option>
<option data-code="+376" value="Andorre">Andorre</option>
<option data-code="+244" value="Angola">Angola</option>
<option data-code="+1264" value="Anguilla">Anguilla</option>
<option data-code="+1268" value="Antigua-et-Barbuda">Antigua-et-Barbuda</option>
<option data-code="+966" value="Arabie Saoudite">Arabie Saoudite</option>
<option data-code="+54" value="Argentine">Argentine</option>
<option data-code="+374" value="Arménie">Arménie</option>
<option data-code="+297" value="Aruba">Aruba</option>
<option data-code="+61" value="Australie">Australie</option>
<option data-code="+43" value="Autriche">Autriche</option>
<option data-code="+994" value="Azerbaïdjan">Azerbaïdjan</option>
<option data-code="+1242" value="Bahamas">Bahamas</option>
<option data-code="+973" value="Bahreïn">Bahreïn</option>
<option data-code="+880" value="Bangladesh">Bangladesh</option>
<option data-code="+1246" value="Barbade">Barbade</option>
<option data-code="+32" value="Belgique">Belgique</option>
<option data-code="+501" value="Belize">Belize</option>
<option data-code="+1441" value="Bermudes">Bermudes</option>
<option data-code="+229" value="Bénin">Bénin</option>
<option data-code="+975" value="Bhoutan">Bhoutan</option>
<option data-code="+375" value="Biélorussie">Biélorussie</option>
<option data-code="+95" value="Birmanie">Birmanie</option>
<option data-code="+591" value="Bolivie">Bolivie</option>
<option data-code="+387" value="Bosnie-Herzégovine">Bosnie-Herzégovine</option>
<option data-code="+267" value="Botswana">Botswana</option>
<option data-code="+55" value="Brésil">Brésil</option>
<option data-code="+673" value="Brunéi">Brunéi</option>
<option data-code="+359" value="Bulgarie">Bulgarie</option>
<option data-code="+226" value="Burkina Faso">Burkina Faso</option>
<option data-code="+257" value="Burundi">Burundi</option>
<option data-code="+855" value="Cambodge">Cambodge</option>
<option data-code="+237" value="Cameroun">Cameroun</option>
<option data-code="+1" value=" Canada"> Canada</option>
<option data-code="+1345" value="Caïmans">Caïmans</option>
<option data-code="+238" value="Cap-Vert">Cap-Vert</option>
<option data-code="+56" value="Chili">Chili</option>
<option data-code="+86" value="Chine">Chine</option>
<option data-code="+90392" value="Chypre du Nord">Chypre du Nord</option>
<option data-code="+357" value="Chypre Sud">Chypre Sud</option>
<option data-code="+379" value="Cité du Vatican">Cité du Vatican</option>
<option data-code="+57" value="Colombie">Colombie</option>
<option data-code="+269" value="Comores">Comores</option>
<option data-code="+682" value="Cook">Cook</option>
<option data-code="+243" value="Congo République Démocratique">Congo République Démocratique</option>
<option data-code="+850" value="Corée du Nord">Corée du Nord</option>
<option data-code="+82" value="Corée du Sud">Corée du Sud</option>
<option data-code="+506" value="Costa Rica">Costa Rica</option>
<option data-code="+225" value="Côte d'Ivoire">Côte d'Ivoire</option>
<option data-code="+385" value="Croatie">Croatie</option>
<option data-code="+53" value="Cuba">Cuba</option>
<option data-code="+45" value="Danemark">Danemark</option>
<option data-code="+253" value="Djibouti">Djibouti</option>
<option data-code="+1" value="Dominique">Dominique</option>
<option data-code="+20" value="Egypte">Egypte</option>
<option data-code="+971" value="Emirats Arabes Unis">Emirats Arabes Unis</option>
<option data-code="+593" value="Équateur">Équateur</option>
<option data-code="+291" value="Érythrée">Érythrée</option>
<option data-code="+34" value="Espagne">Espagne</option>
<option data-code="+372" value="Estonie">Estonie</option>
<option data-code="+1" value="États-Unis">États-Unis</option>
<option data-code="+251" value="Éthiopie">Éthiopie</option>
<option data-code="+298" value="Féroé">Féroé</option>
<option data-code="+679" value="Fidji">Fidji</option>
<option data-code="+358" value="Finlande">Finlande</option>
<option data-code="+33" value="France">France</option>
<option data-code="+241" value="Gabon">Gabon</option>
<option data-code="+220" value="Gambie">Gambie</option>
<option data-code="+7880" value="Géorgie">Géorgie</option>
<option data-code="+233" value="Ghana">Ghana</option>
<option data-code="+350" value="Gibraltar">Gibraltar</option>
<option data-code="+30" value="Grèce">Grèce</option>
<option data-code="+1473" value="Grenade">Grenade</option>
<option data-code="+299" value="Groenland">Groenland</option>
<option data-code="+590" value="Guadeloupe">Guadeloupe</option>
<option data-code="+671" value="Guam">Guam</option>
<option data-code="+502" value="Guatemala">Guatemala</option>
<option data-code="+224" value="Guinée">Guinée</option>
<option data-code="+240" value="Guinée équatoriale">Guinée équatoriale</option>
<option data-code="+245" value="Guinée Bissau">Guinée Bissau</option>
<option data-code="+592" value="Guyane">Guyane</option>
<option data-code="+594" value="Guyane française">Guyane française</option>
<option data-code="+509" value="Haïti">Haïti</option>
<option data-code="+504" value="Honduras">Honduras</option>
<option data-code="+852" value="Hong Kong">Hong Kong</option>
<option data-code="+36" value="Hongrie">Hongrie</option>
<option data-code="+91" value="Inde">Inde</option>
<option data-code="+62" value="Indonésie">Indonésie</option>
<option data-code="+964" value="Irak">Irak</option>
<option data-code="+98" value="Iran">Iran</option>
<option data-code="+353" value="Irlande">Irlande</option>
<option data-code="+354" value="Islande">Islande</option>
<option data-code="+39" value="Italie">Italie</option>
<option data-code="+1876" value="Jamaïque">Jamaïque</option>
<option data-code="+81" value="Japon">Japon</option>
<option data-code="+962" value="Jordanie">Jordanie</option>
<option data-code="+7" value="Kazakhstan">Kazakhstan</option>
<option data-code="+254" value="Kenya">Kenya</option>
<option data-code="+996" value="Kirghizistan">Kirghizistan</option>
<option data-code="+686" value="Kiribati">Kiribati</option>
<option data-code="+383" value="Kosovo">Kosovo</option>
<option data-code="+965" value="Koweït">Koweït</option>
<option data-code="+856" value="Laos">Laos</option>
<option data-code="+266" value="Lesotho">Lesotho</option>
<option data-code="+371" value="Lettonie">Lettonie</option>
<option data-code="+961" value="Liban">Liban</option>
<option data-code="+231" value="Libéria">Libéria</option>
<option data-code="+218" value="Libye">Libye</option>
<option data-code="+417" value="Liechtenstein">Liechtenstein</option>
<option data-code="+370" value="Lituanie">Lituanie</option>
<option data-code="+352" value="Luxembourg">Luxembourg</option>
<option data-code="+853" value="Macao">Macao</option>
<option data-code="+389" value="Macédoine">Macédoine</option>
<option data-code="+261" value="Madagascar">Madagascar</option>
<option data-code="+60" value="Malaisie">Malaisie</option>
<option data-code="+265" value="Malawi">Malawi</option>
<option data-code="+960" value="Maldives">Maldives</option>
<option data-code="+223" value="Mali">Mali</option>
<option data-code="+500" value="Malouines">Malouines</option>
<option data-code="+356" value="Malte">Malte</option>
<option data-code="+670" value="Mariannes du Nord">Mariannes du Nord</option>
<option data-code="+212" value="Maroc">Maroc</option>
<option data-code="+692" value="Marshall">Marshall</option>
<option data-code="+596" value="Martinique">Martinique</option>
<option data-code="+222" value="Mauritanie">Mauritanie</option>
<option data-code="+269" value="Mayotte">Mayotte</option>
<option data-code="+52" value="Mexique">Mexique</option>
<option data-code="+691" value="Micronésie">Micronésie</option>
<option data-code="+373" value="Moldavie">Moldavie</option>
<option data-code="+377" value="Monaco">Monaco</option>
<option data-code="+976" value="Mongolie">Mongolie</option>
<option data-code="+382" value="Monténégro">Monténégro</option>
<option data-code="+1664" value="Montserrat">Montserrat</option>
<option data-code="+258" value="Mozambique">Mozambique</option>
<option data-code="+264" value="Namibie">Namibie</option>
<option data-code="+674" value="Nauru">Nauru</option>
<option data-code="+977" value="Népal">Népal</option>
<option data-code="+505" value="Nicaragua">Nicaragua</option>
<option data-code="+227" value="Niger">Niger</option>
<option data-code="+234" value="Nigéria">Nigéria</option>
<option data-code="+683" value="Niue">Niue</option>
<option data-code="+672" value="Norfolk">Norfolk</option>
<option data-code="+47" value="Norvège">Norvège</option>
<option data-code="+687" value="Nouvelle-Calédonie">Nouvelle-Calédonie</option>
<option data-code="+64" value="Nouvelle-Zélande">Nouvelle-Zélande</option>
<option data-code="+968" value="Oman">Oman</option>
<option data-code="+256" value="Ouganda">Ouganda</option>
<option data-code="+7" value="Ouzbékistan ">Ouzbékistan</option>
<option data-code="+680" value="Palaos">Palaos</option>
<option data-code="+507" value="Panama">Panama</option>
<option data-code="+675" value="Papouasie-Nouvelle-Guinée">Papouasie Nouvelle Guinée</option>
<option data-code="+595" value="Paraguay">Paraguay</option>
<option data-code="+31" value="Pays-Bas">Pays-Bas</option>
<option data-code="+51" value="Pérou">Pérou</option>
<option data-code="+63" value="Philippines">Philippines</option>
<option data-code="+48" value="Pologne">Pologne</option>
<option data-code="+689" value="Polynésie française">Polynésie française</option>
<option data-code="+1787" value="Porto Rico">Porto Rico</option>
<option data-code="+351" value="Portugal">Portugal</option>
<option data-code="+974" value="Qatar">Qatar</option>
<option data-code="+236" value="République centrafricaine">République centrafricaine</option>
<option data-code="+1809" value="République dominicaine">République dominicaine</option>
<option data-code="+242" value="république du congo">République du Congo</option>
<option data-code="+42" value="République tchèque">République tchèque</option>
<option data-code="+262" value="Réunion">Réunion</option>
<option data-code="+40" value="Roumanie">Roumanie</option>
<option data-code="+44" value="Royaume-Uni">Royaume-Uni</option>
<option data-code="+7" value="Russie">Russie</option>
<option data-code="+250" value="Rwanda">Rwanda</option>
<option data-code="+378" value="Saint-Marin">Saint-Marin</option>
<option data-code="+503" value="Salvador">Salvador</option>
<option data-code="+239" value="Sao Tomé-et-Principe">Sao Tomé-et-Principe</option>
<option data-code="+221" value="Sénégal">Sénégal</option>
<option data-code="+381" value="Serbie">Serbie</option>
<option data-code="+248" value="Seychelles">Seychelles</option>
<option data-code="+232" value="Sierra Leone">Sierra Leone</option>
<option data-code="+65" value="Singapour">Singapour</option>
<option data-code="+421" value="République slovaque">République slovaque</option>
<option data-code="+677" value="Salomon">Salomon</option>
<option data-code="+685" value="Samoa">Samoa</option>
<option data-code="+386" value="Slovénie">Slovénie</option>
<option data-code="+252" value="Somalie">Somalie</option>
<option data-code="+249" value="Soudan">Soudan</option>
<option data-code="+211" value="Soudan du sud">Soudan du sud</option>
<option data-code="+94" value="Sri Lanka">Sri Lanka</option>
<option data-code="+290" value="St. Helena">St. Helena</option>
<option data-code="+1869" value="St. Kitts">St. Kitts</option>
<option data-code="+1758" value="St. Lucia">St. Lucia</option>
<option data-code="+46" value="Suède">Suède</option>
<option data-code="+41" value="Suisse">Suisse</option>
<option data-code="+597" value="Suriname">Suriname</option>
<option data-code="+268" value="Swaziland">Swaziland</option>
<option data-code="+963" value="Syrie">Syrie</option>
<option data-code="+7" value="Tadjikstan ">Tadjikstan</option>
<option data-code="+886" value="Taïwan">Taïwan</option>
<option data-code="+255" value="Tanzanie">Tanzanie</option>
<option data-code="+235" value="Tchad">Tchad</option>
<option data-code="+66" value="Thaïlande">Thaïlande</option>
<option data-code="+670" value="Timor oriental">Timor oriental</option>
<option data-code="+228" value="Togo">Togo</option>
<option data-code="+676" value="Tonga">Tonga</option>
<option data-code="+1868" value="Trinité-et-Tobago">Trinité-et-Tobago</option>
<option data-code="+216" value="Tunisie">Tunisie</option>
<option data-code="+7" value="Turkménistan ">Turkménistan </option>
<option data-code="+1649" value="Turques et Caïques">Turques et Caïques</option>
<option data-code="+90" value="Turquie">Turquie</option>
<option data-code="+688" value="Tuvalu">Tuvalu</option>
<option data-code="+380" value="Ukraine">Ukraine</option>
<option data-code="+598" value="Uruguay">Uruguay</option>
<option data-code="+678" value="Vanuatu">Vanuatu</option>
<option data-code="+58" value="Venezuela">Venezuela</option>
<option data-code="+84" value="Vierges américaines - États-Unis ">Vierges américaines - États-Unis </option>
<option data-code="+84" value="Vierges britanniques">Vierges britanniques</option>
<option data-code="+84" value="Vietnam">Vietnam</option>
<option data-code="+681" value="Wallis et Futuna">Wallis et Futuna</option>
<option data-code="+969" value="Yémen Nord">Yémen Nord</option>
<option data-code="+967" value="Yémen Sud">Yémen Sud</option>
<option data-code="+260" value="Zambie">Zambie</option>
<option data-code="+263" value="Zimbabwe">Zimbabwe</option>
                </select>
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="fa fa-globe"></span>
                    </div>
                </div>

            </div>
        </div>

        <br>
        <input type="hidden" name="code_p" id="ccp" value="+27">

        <div class="form-group">
            <label class="text-label" for="email_2">Numéro de téléphone:</label>
            <div class="input-group input-group-merge">
                <input id="email_2" type="text" required="" class="form-control form-control-prepended" placeholder="numèro de téléphone" name="phone">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span id="sspp">+27</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group mb-5">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" required class="custom-control-input" id="terms" />
                <label class="custom-control-label" for="terms">J'accepte tous les <a href="post.php?id=15" target="_blank">Terms et les Conditions</a></label>
            </div>
        </div>
        <div class="form-group text-center">
            <button class="btn btn-primary mb-2" type="submit" name="signup">Créer un compte</button><br>
            <a class="text-body text-underline" href="login.php<?php if(isset($_GET['reserve_id'])){ echo "?reserve_id=".$_GET['reserve_id']; } ?>">Vous avez un compte? se connecter</a>
        </div>
    </form>
</div>

<?php

include 'footer.php';
ob_end_flush();
?>