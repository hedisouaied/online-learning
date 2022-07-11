<?php

$pagetitle = "Modifier Utilisateur";
include "connexion.php";

if ((isset($_GET['user_id'])) && (is_numeric($_GET['user_id']))) {
    $id_u = $_GET['user_id'];


    $msg = "";
    if ($_POST) {


        //2- Récuperation des variables
        $password = mysqli_real_escape_string($conn, $_POST['Password']);
        $email = mysqli_real_escape_string($conn, $_POST['Email']);
        $fullname = mysqli_real_escape_string($conn, $_POST['FullName']);
        $phone = (filter_var($_POST['code_p'], FILTER_SANITIZE_STRING)) . ',' . (filter_var($_POST['phone'], FILTER_SANITIZE_STRING));
        $genre = mysqli_real_escape_string($conn, $_POST['genre']);
        $country = mysqli_real_escape_string($conn, $_POST['dawla']);





        //3- Préparation de la requete
        $req = "UPDATE `clients` SET `password`='" . $password . "',`email`='" . $email . "',`fullname`='" . $fullname . "',`phone`='" . $phone . "',`genre`='" . $genre . "',`country`='" . $country . "' WHERE ID=" . $id_u . " ";


        $exec = mysqli_query($conn, $req);

        if ($exec) {
            $msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Cet Utilisateur a été modifié.
</div>";
        } else {
            $msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Utilisateur non modifié!!! 
</div>";
        }
    }

?>


    <?php include "header.php"; ?>
    <!-- /.main-menu -->
    <?php include "sidebar.php"; ?>
    <link rel="stylesheet" href="assets/plugin/dropify/css/dropify.min.css">
    <div class="content">
        <div id="wrapper">
            <div class="main-content">
                <div class="row small-spacing">
                    <div class="col-xs-9">
                        <div class="box-content card white">
                            <h4 class="box-title">Modifier Utilisateur</h4>
                            <!-- /.box-title -->
                            <p><?php echo $msg; ?></p>
                            <div class="card-content">
                                <form method="POST" enctype="multipart/form-data">
                                    <?php

                                    $query1 = "SELECT * FROM clients where ID=$id_u ";


                                    $exec1 = mysqli_query($conn, $query1);

                                    $check_admin = mysqli_num_rows($exec1);
                                    if ($check_admin == 0) {
                                        header("location:liste-utilisateurs.php");
                                    }

                                    while ($array = mysqli_fetch_array($exec1)) {
                                        $fullname = $array['fullname'];
                                        $password = $array['password'];
                                        $phone = $array['phone'];
                                        $email = $array['email'];
                                        $genre = $array['genre'];
                                        $country1 = $array['country'];
                                    }
                                    $numtel = explode(',', $phone);
                                    ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            genre
                                        </label>
                                        <select required name="genre" class="form-control">
                                            <option value="0">Sectionner le genre</option>
                                            <option <?php if ($genre == 'mr') {
                                                        echo 'selected';
                                                    } ?> value="mr">Monsieur</option>
                                            <option <?php if ($genre == 'ms') {
                                                        echo 'selected';
                                                    } ?> value="ms">Madame</option>

                                        </select>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nom et Prénom</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer votre admin E-mail" name="FullName" value="<?php echo $fullname ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mot de passe</label>
                                        <input class="form-control" id="exampleInputEmail1" placeholder="Entrer votre admin password" name="Password" value="<?php echo $password ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">E-mail</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Entrer votre admin E-mail" name="Email" value="<?php echo $email ?>">
                                    </div>
<div class="form-group">
                                        <label class="text-label" for="email_2">Pays</label>
                                        <select id="email_2" class="country form-control form-control-prepended" name="dawla" onchange='x =this.options[this.selectedIndex].getAttribute("data-code"); var cpp = document.getElementById("ccp");cpp.value = x; '>
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
                                        <input type="hidden" name="code_p" id="ccp" value="<?php echo $numtel[0]; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tel</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer votre admin E-mail" name="phone" value="<?php echo $numtel[1] ?>" required>
                                    </div>
                                    
                                    <br>


                                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Modifier</button>
                                    <a type="submit" class="btn btn-info btn-sm waves-effect waves-light" href="users-list.php">Retour</a>
                                </form>
                            </div>
                            <!-- /.card-content -->
                        </div>
                        <!-- /.box-content -->
                    </div>

                </div>


            </div>
        </div>
        
    <?php
    include 'footer.php';
    ?>
    <script>
            jQuery(document).ready(function($) {
                $('.country').find('option[value="<?php echo $country1; ?>"]').attr('selected', 'selected');
            });
        </script>
    <?php
} else {
    header('location:users-list.php');
}
    ?>