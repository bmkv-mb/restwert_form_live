<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anmeldung</title>
    <link rel="stylesheet" href="../assets/style.css">

</head>

<body>
    <?php
    include ('../db/parse_customer_data.php');

    // If translation is needed, replace the variables here. Translation can be built in with this. No functionalty yet.
    $fieldNames = [
        "german" => [
            'title' => 'Anrede',
            'female' => 'Frau',
            'male' => 'Herr',
            'name' => 'Vorname',
            'surname' => 'Nachname',
            'address' => 'Adresse',
            'po_box' => 'Postfach',
            'zip' => 'PLZ',
            'city' => 'Ort',
            'email' => 'Email',
            'phone' => 'Telefon',
            'iban' => 'IBAN',
            'bankname' => 'Bankname',
            'alternative_checkbox' => 'Alternative Kontendaten',
            'suggestion_text' => 'Wie haben Sie von uns erfahren?',
            'oral_suggestion' => 'Mündliche Empfehlung',
            'socialmedia_suggestion' => 'Facebook, Instagram, Social Media',
            'ricardo_suggestion' => 'Ricardo',
            'flyer_suggestion' => 'Flyer',
            'tos_checkbox' => 'AGBs',
            'tos_information' => 'Hiermit bestätigen Sie die Richtigkeit Ihrer Angaben und akzeptieren unsere AGB, welche Sie nach der Anmeldung erneut per E-Mail erhalten werden. Ihre Angaben werden zu keinem Zeitpunkt an Dritte weitergegeben. Ihre Mailadresse kann, bei Veränderungen unserer AGB oder Dienstleistung, zu Informationszwecken verwendet werden.',
            'error_message' => 'Bitte alle Felder mit dem * ausfüllen'
        ],
        "english" => [
            'title' => 'Title',
            'female' => 'Mrs.',
            'male' => 'Mr.',
            'name' => 'Name',
            'surname' => 'Surname',
            'address' => 'Address',
            'po_box' => 'P.O. Box',
            'zip' => 'Zip Code',
            'city' => 'City',
            'email' => 'Email',
            'phone' => 'Phone',
            'iban' => 'IBAN',
            'bankname' => 'Name of the Bank',
            'alternative_checkbox' => 'Alternative Personal Information',
            'suggestion_text' => 'How did you learn about us?',
            'oral_suggestion' => 'Verbal recommendation',
            'socialmedia_suggestion' => 'Facebook, Instagram, Social Media',
            'ricardo_suggestion' => 'Ricardo',
            'flyer_suggestion' => 'Flyer',
            'tos_checkbox' => 'General Terms and Conditions',
            'tos_information' => 'You confirm the accuracy of your information and accept our General Terms and Conditions, which you will receive again via email after registration. Your information will not be disclosed to third parties at any time. Your email address may be used for informational purposes in case of changes to our General Terms and Conditions or services.',
            'error_message' => 'Please input all neccessary * data'
        ]
    ];

    $mainError = 0;

    // Check if the form has been submitted 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        validateForm();
    }

    if (!isset($_POST["submit"])) {
        displayForm();
    }

    // Call function with empty params by default. If errors happen or required fields are empty, inputs will be populated with the user's data
    function displayForm(
        $language = "german",
        $mainError = 0,
        $keepAltFormOpen = "none",
        $title = "",
        $title_error = "",
        $alt_title = "",
        $name = "",
        $name_error = "",
        $alt_name = "",
        $surname = "",
        $surname_error = "",
        $alt_surname = "",
        $address = "",
        $address_error = "",
        $alt_address = "",
        $po_box = "",
        $alt_po_box = "",
        $zip = "",
        $zip_error = "",
        $alt_zip = "",
        $city = "",
        $city_error = "",
        $alt_city = "",
        $email = "",
        $email_error = "",
        $alt_email = "",
        $alt_email_error = "",
        $phone = "",
        $phone_error = "",
        $alt_phone = "",
        $iban = "",
        $iban_error = "",
        $alt_iban = "",
        $bankname = "",
        $bankname_error = "",
        $alt_bankname = "",
        $oral_suggestion = "",
        $socialmedia_suggestion = "",
        $ricardo_suggestion = "",
        $flyer_suggestion = ""
    ) {
        global $fieldNames;

        ?>


        <form method="post" id="form" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <div class="banner">

            </div>

            <!-- Title Column -->
            <div class="column">
                <div class="row">
                    <div class="field-header">
                        <label for="title"> <?= htmlspecialchars($fieldNames['german']['title']) ?> </label> <span
                            id="error" value=""><?= htmlspecialchars($title_error); ?> </span>
                    </div>
                    <select id="title" name="title"><span id="error" value=""><?= htmlspecialchars($title_error); ?> </span>
                        <option value="" style="display:none" disabled selected> </option>
                        <option value="Frau" <?php if (isset($_POST['title']) && $_POST['title'] == $fieldNames['german']['female']) {
                            echo "selected";
                        } ?>>Frau</option>
                        <option value="Herr" <?php if (isset($_POST['title']) && $_POST['title'] == htmlspecialchars($fieldNames['german']['male'])) {
                            echo "selected";
                        } ?>>Herr</option>
                    </select>
                </div>
                <div class="row">
                    <div class="field-header" style="height:20px">
                    <!-- Empty field for visuals -->
                    </div>
                </div>
            </div>

            <!-- Name and Surname Column -->
            <div class="column">
                <div class="row">
                    <div class="field-header">
                        <label for="name"> <?= htmlspecialchars($fieldNames['german']['name']) ?> </label> <span id="error"
                            value=""><?= htmlspecialchars($name_error); ?> </span>
                    </div>
                    <input type="text" name="name" id="name" value="<?= htmlspecialchars($name); ?>">
                </div>
                <div class="row">
                    <div class="field-header">
                        <label for="surname"> <?= htmlspecialchars($fieldNames['german']['surname']) ?> </label> <span
                            id="error" value=""><?= htmlspecialchars($surname_error); ?></span>
                    </div>
                    <input type="text" name="surname" id="surname" value="<?= htmlspecialchars($surname); ?>">
                </div>
            </div>

            <!-- Address and PO Box Column -->
            <div class="column">
                <div class="row">
                    <div class="field-header">
                        <label for="address"> <?= htmlspecialchars($fieldNames['german']['address']) ?> </label> <span
                            id="error" value=""><?= htmlspecialchars($address_error); ?></span>
                    </div>
                    <input type="text" name="address" id="address" value="<?= htmlspecialchars($address); ?>">
                </div>
                <div class="row">
                    <div class="field-header">
                        <label for="po_box"> <?= htmlspecialchars($fieldNames['german']['po_box']) ?> </label>
                    </div>
                    <input type="text" name="po_box" id="po_box" value="<?= htmlspecialchars($po_box); ?>">
                </div>
            </div>
                        
            <!-- Zip and City Column -->
            <div class="column">
                <div class="row">
                    <div class="field-header">
                        <label for="zip"> <?= htmlspecialchars($fieldNames['german']['zip']) ?> </label> <span id="error"
                            value=""><?= htmlspecialchars($zip_error); ?></span>
                    </div>
                    <input type="text" name="zip" id="zip" value="<?= htmlspecialchars($zip); ?>">
                </div>
                <div class="row">
                    <div class="field-header">
                        <label for="city"> <?= htmlspecialchars($fieldNames['german']['city']) ?> </label> <span id="error"
                            value=""><?= htmlspecialchars($city_error); ?></span>
                    </div>
                    <input type="text" name="city" id="city" value="<?= htmlspecialchars($city); ?>">
                </div>
            </div>

            <!-- Email and Phone Column -->
            <div class="column">
                <div class="row">
                    <div class="field-header">
                        <label for="email"> <?= htmlspecialchars($fieldNames['german']['email']) ?> </label> <span
                            id="error" value=""><?= htmlspecialchars($email_error); ?></span>
                    </div>
                    <input type="text" name="email" id="email" value="<?= htmlspecialchars($email); ?>">
                </div>
                <div class="row">
                    <div class="field-header">
                        <label for="phone"> <?= htmlspecialchars($fieldNames['german']['phone']) ?> </label> <span
                            id="error" value=""><?= htmlspecialchars($phone_error); ?></span>
                    </div>
                    <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($phone); ?>">
                </div>
            </div>

            <!-- Iban and Bankname Column -->
            <div class="column">
                <div class="row">
                    <div class="field-header">
                        <label for="iban"> <?= htmlspecialchars($fieldNames['german']['iban']) ?> </label> <span id="error"
                            value=""><?= htmlspecialchars($iban_error); ?></span>
                    </div>
                    <input type="text" name="iban" id="iban" value="<?= htmlspecialchars($iban); ?>">
                </div>
                <div class="row">
                    <div class="field-header">
                        <label for="bankname"> <?= htmlspecialchars($fieldNames['german']['bankname']) ?> </label> <span
                            id="error" value=""><?= htmlspecialchars($bankname_error); ?></span>
                    </div>
                    <input type="text" name="bankname" id="bankname" value="<?= htmlspecialchars($bankname); ?>">
                </div>
            </div>

            <!-- Checkbox to toggle alternative data -->
            <div class="alt_form_checkbox">
                <input class="checkbox" type="checkbox" id="alt_form_check" name="alt_form_check" onclick="myFunction()"
                    <?php if (isset($_POST['alt_form_check'])) {
                        echo "checked";
                    } ?>>
                <label for="alt_form_check"> <?= htmlspecialchars($fieldNames['german']['alternative_checkbox']) ?> </label>
            </div>

            <!-- Alternative data -->
            <div class="alt_form" id="alt_form" style="display:<?= htmlspecialchars($keepAltFormOpen); ?>">

            <!-- Alt Title Column -->
                <div class="column">
                    <div class="row">
                        <div class="field-header">
                        </div>
                        <select id="alt_title" name="alt_title">
                            <option value="" style="display:none" disabled selected> </option>
                            <option value="Frau" <?php if (isset($_POST['alt_title']) && $_POST['alt_title'] == $fieldNames['german']['female']) {
                                echo "selected";
                            } ?>>Frau</option>
                            <option value="Herr" <?php if (isset($_POST['alt_title']) && $_POST['alt_title'] == $fieldNames['german']['male']) {
                                echo "selected";
                            } ?>>Herr</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="field-header" style="height:20px">
                         <!-- Empty field for visuals -->
                        </div>
                    </div>
                </div>

                <!-- Alt Name and Alt Surname Column -->
                <div class="column">
                    <div class="row">
                        <div class="field-header">
                            <label for="alt_name"> <?= htmlspecialchars($fieldNames['german']['name']) ?> </label>
                        </div>
                        <input type="text" name="alt_name" id="alt_name" value="<?= htmlspecialchars($alt_name); ?>">
                    </div>
                    <div class="row">
                        <div class="field-header">
                            <label for="alt_surname"> <?= htmlspecialchars($fieldNames['german']['surname']) ?> </label>
                        </div>
                        <input type="text" name="alt_surname" id="alt_surname"
                            value="<?= htmlspecialchars($alt_surname); ?>">
                    </div>
                </div>

                <!-- Alt Address and Alt PO Box Column -->
                <div class="column">
                    <div class="row">
                        <div class="field-header">
                            <label for="alt_address"> <?= htmlspecialchars($fieldNames['german']['address']) ?> </label>
                        </div>
                        <input type="text" name="alt_address" id="alt_address"
                            value="<?= htmlspecialchars($alt_address); ?>">
                    </div>
                    <div class="row">
                        <div class="field-header">
                            <label for="alt_po_box"> <?= htmlspecialchars($fieldNames['german']['po_box']) ?> </label>
                        </div>
                        <input type="text" name="alt_po_box" id="alt_po_box" value="<?= htmlspecialchars($alt_po_box); ?>">
                    </div>
                </div>

                <!-- Alt Zip and Alt City Column -->
                <div class="column">
                    <div class="row">
                        <div class="field-header">
                            <label for="alt_zip"> <?= htmlspecialchars($fieldNames['german']['zip']) ?> </label>
                        </div>
                        <input type="text" name="alt_zip" id="alt_zip" value="<?= htmlspecialchars($alt_zip); ?>">
                    </div>
                    <div class="row">
                        <div class="field-header">
                            <label for="alt_city"> <?= htmlspecialchars($fieldNames['german']['city']) ?> </label>
                        </div>
                        <input type="text" name="alt_city" id="alt_city" value="<?= htmlspecialchars($alt_city); ?>">
                    </div>
                </div>

                <!-- Alt Email and Alt Phone Column -->
                <div class="column">
                    <div class="row">
                        <div class="field-header">
                            <label for="alt_email"> <?= htmlspecialchars($fieldNames['german']['email']) ?> <span id="error"
                                    value=""><?= htmlspecialchars($alt_email_error); ?></span></label>
                        </div>
                        <input type="text" name="alt_email" id="alt_email" value="<?= htmlspecialchars($alt_email); ?>">
                    </div>
                    <div class="row">
                        <div class="field-header">
                            <label for="alt_phone"> <?= htmlspecialchars($fieldNames['german']['phone']) ?> </label>
                        </div>
                        <input type="text" name="alt_phone" id="alt_phone" value="<?= htmlspecialchars($alt_phone); ?>">
                    </div>
                </div>

                <!-- Alt Iban and Alt Bankname Column -->
                <div class="column">
                    <div class="row">
                        <div class="field-header">
                            <label for="alt_iban"> <?= htmlspecialchars($fieldNames['german']['iban']) ?> </label>
                        </div>
                        <input type="text" name="alt_iban" id="alt_iban" value="<?= htmlspecialchars($alt_iban); ?>">
                    </div>
                    <div class="row">
                        <div class="field-header">
                            <label for="alt_bankname"> <?= htmlspecialchars($fieldNames['german']['bankname']) ?> </label>
                        </div>
                        <input type="text" name="alt_bankname" id="alt_bankname"
                            value="<?= htmlspecialchars($alt_bankname); ?>">
                    </div>
                </div>
            </div>


            <!-- Checkboxes for suggestions -->
            <label for="multi_checkbox"> <?= htmlspecialchars($fieldNames['german']['suggestion_text']) ?> </label>
            <div class="multi_checkbox">

                <!-- Checkboxes for oral -->
                <div class="field-header" id="multi_checkbox">
                    <input type="checkbox" id="oral" name="oral" value="Mündliche Empfehlung" <?php if (isset($_POST['oral'])) {
                        echo "checked";
                    } ?>>
                    <label for="oral"> <?= htmlspecialchars($fieldNames['german']['oral_suggestion']) ?></label>
                </div>

                <!-- Checkboxes for social media -->
                <div class="field-header">
                    <input type="checkbox" id="socialmedia" name="socialmedia" value="Social Media" <?php if (isset($_POST['socialmedia'])) {
                        echo "checked";
                    } ?>>
                    <label for="socialmedia"> <?= htmlspecialchars($fieldNames['german']['socialmedia_suggestion']) ?>
                    </label>
                </div>

                <!-- Checkboxes for ricardo -->
                <div class="field-header">
                    <input type="checkbox" id="ricardo" name="ricardo" value="Ricardo" <?php if (isset($_POST['ricardo'])) {
                        echo "checked";
                    } ?>>
                    <label for="ricardo"> <?= htmlspecialchars($fieldNames['german']['ricardo_suggestion']) ?> </label>
                </div>

                <!-- Checkboxes for flyer -->
                <div class="field-header">
                    <input type="checkbox" id="flyer" name="flyer" value="Flyer" <?php if (isset($_POST['flyer'])) {
                        echo "checked";
                    } ?>>
                    <label for="flyer"> <?= htmlspecialchars($fieldNames['german']['flyer_suggestion']) ?> </label>
                </div>
            </div>

            <!-- Checkboxes for TOS -->
            <div class="tos_checkbox">
                <div class="field-header">
                    <input type="checkbox" id="agb" name="agb" value="AGBs" required>
                    <label for="agb"> <?= htmlspecialchars($fieldNames['german']['tos_checkbox']) ?> </label>
                </div>
                <div>
                    <?= htmlspecialchars($fieldNames['german']['tos_information']) ?>
                </div>
            </div>

            <input type="submit" name="submit">

        </form>
        
        <!-- Hide/Unhide if alternative data checkbox is unticked/ticked -->
        <script>
            function myFunction() {
                var checkBox = document.getElementById("alt_form_check");
                var text = document.getElementById("alt_form");
                if (checkBox.checked == true) {
                    text.style.display = "block";
                } else {
                    text.style.display = "none";
                }
            }
        </script>

        <?php

    }

    function validateForm()
    {
        global $mainError;

        $language = "german";
        $mainError = 0;
        $keepAltFormOpen = "none";
        $title = "";
        $title_error = "";
        $alt_title = "";
        $name = "";
        $name_error = "";
        $alt_name = "";
        $surname = "";
        $surname_error = "";
        $alt_surname = "";
        $address = "";
        $address_error = "";
        $alt_address = "";
        $po_box = "";
        $alt_pox_box = "";
        $zip = "";
        $zip_error = "";
        $alt_zip = "";
        $city = "";
        $city_error = "";
        $alt_city = "";
        $email = "";
        $email_error = "";
        $alt_email = "";
        $alt_email_error = "";
        $phone = "";
        $phone_error = "";
        $alt_phone = "";
        $iban = "";
        $iban_error = "";
        $alt_iban = "";
        $bankname = "";
        $bankname_error = "";
        $alt_bankname = "";
        $oral_suggestion = "";
        $socialmedia_suggestion = "";
        $ricardo_suggestion = "";
        $flyer_suggestion = "";

        $data = [
            "id" => "",
            "date" => date("d.m.Y"),
            "title" => "",
            "name" => "",
            "surname" => "",
            "address" => "",
            "po_box" => "",
            "zip" => "",
            "city" => "",
            "email" => "",
            "phone" => "",
            "iban" => "",
            "bankname" => "",
            "alt_title" => "",
            "alt_name" => "",
            "alt_surname" => "",
            "alt_address" => "",
            "alt_po_box" => "",
            "alt_zip" => "",
            "alt_city" => "",
            "alt_email" => "",
            "alt_phone" => "",
            "alt_iban" => "",
            "alt_bankname" => "",
            "suggestions" => "",
            "incorporated" => "unchecked"
        ];

        
        // Go through each data and check if empty. If not, trim the data and assing it. Else leave it empty
        isset($_POST["title"]) ? $title = trim($_POST["title"]) : $title = "";
        isset($_POST["alt_title"]) ? $alt_title = trim($_POST["alt_title"]) : $alt_title = "";

        // If data not empty, clear errors and repopulate $data[...] for displayForm(). Else create and display error
        if (!empty($title)) {
            $title_error = "";
            $data["title"] = $title;
        } else {
            $title_error = "*";
            $mainError++;
        }

        isset($_POST["name"]) && is_string($_POST["name"]) ? $name = trim($_POST["name"]) : $name = "";
        isset($_POST["alt_name"]) && is_string($_POST["alt_name"]) ? $alt_name = trim($_POST["alt_name"]) : $alt_name = "";
        if (!empty($name)) {
            $name_error = "";
            $data["name"] = $name;
        } else {
            $name_error = "*";
            $mainError++;
        }

        isset($_POST["surname"]) && is_string($_POST["surname"]) ? $surname = trim($_POST["surname"]) : $surname = "";
        isset($_POST["alt_surname"]) && is_string($_POST["alt_surname"]) ? $alt_surname = trim($_POST["alt_surname"]) : $alt_surname = "";
        if (!empty($surname)) {
            $surname_error = "";
            $data["surname"] = $surname;
        } else {
            $surname_error = "*";
            $mainError++;
        }

        isset($_POST["address"]) && is_string($_POST["address"]) ? $address = trim($_POST["address"]) : $address = "";
        isset($_POST["alt_address"]) && is_string($_POST["alt_address"]) ? $alt_address = trim($_POST["alt_address"]) : $alt_address = "";
        if (!empty($address)) {
            $address_error = "";
            $data["address"] = $address;
        } else {
            $address_error = "*";
            $mainError++;
        }

        isset($_POST["po_box"]) && is_string($_POST["po_box"]) ? $po_box = trim($_POST["po_box"]) : $po_box = "";
        isset($_POST["alt_po_box"]) && is_string($_POST["alt_po_box"]) ? $alt_po_box = trim($_POST["alt_po_box"]) : $alt_po_box = "";
        if (!empty($po_box)) {
            $data["po_box"] = $po_box;
        }

        isset($_POST["zip"]) && is_string($_POST["zip"]) ? $zip = trim($_POST["zip"]) : $zip = "";
        isset($_POST["alt_zip"]) && is_string($_POST["alt_zip"]) ? $alt_zip = trim($_POST["alt_zip"]) : $alt_zip = "";
        if (!empty($zip)) {
            $zip_error = "";
            $data["zip"] = $zip;
        } else {
            $zip_error = "*";
            $mainError++;
        }

        isset($_POST["city"]) && is_string($_POST["city"]) ? $city = trim($_POST["city"]) : $city = "";
        isset($_POST["alt_city"]) && is_string($_POST["alt_city"]) ? $alt_city = trim($_POST["alt_city"]) : $alt_city = "";
        if (!empty($city)) {
            $city_error = "";
            $data["city"] = $city;
        } else {
            $city_error = "*";
            $mainError++;
        }

        isset($_POST["email"]) && is_string($_POST["email"]) ? $email = trim($_POST["email"]) : $email = "";
        isset($_POST["alt_email"]) && is_string($_POST["alt_email"]) ? $alt_email = trim($_POST["alt_email"]) : $alt_email = "";
        if (!empty($email)) {
            $email_error = "";
            $data["email"] = $email;
        } else {
            $email_error = "*";
            $mainError++;
        }

        isset($_POST["phone"]) && is_string($_POST["phone"]) ? $phone = trim($_POST["phone"]) : $phone = "";
        isset($_POST["alt_phone"]) && is_string($_POST["alt_phone"]) ? $alt_phone = trim($_POST["alt_phone"]) : $alt_phone = "";
        if (!empty($phone)) {
            $phone_error = "";
            $data["phone"] = $phone;
        } else {
            $phone_error = "*";
            $mainError++;
        }

        isset($_POST["iban"]) && is_string($_POST["iban"]) ? $iban = trim($_POST["iban"]) : $iban = "";
        isset($_POST["alt_iban"]) && is_string($_POST["alt_iban"]) ? $alt_iban = trim($_POST["alt_iban"]) : $alt_iban = "";
        if (!empty($iban)) {
            $iban_error = "";
            $data["iban"] = $iban;
        } else {
            $iban_error = "*";
            $mainError++;
        }

        isset($_POST["bankname"]) && is_string($_POST["bankname"]) ? $bankname = trim($_POST["bankname"]) : $bankname = "";
        isset($_POST["alt_bankname"]) && is_string($_POST["alt_bankname"]) ? $alt_bankname = trim($_POST["alt_bankname"]) : $alt_bankname = "";
        if (!empty($bankname)) {
            $bankname_error = "";
            $data["bankname"] = $bankname;
        } else {
            $bankname_error = "*";
            $mainError++;
        }

        if (isset($_POST["alt_form_check"])) {

            $keepAltFormOpen = "display";

            $data["alt_title"] = $alt_title;
            $data["alt_name"] = $alt_name;
            $data["alt_surname"] = $alt_surname;
            $data["alt_address"] = $alt_address;
            $data["alt_po_box"] = $alt_po_box;
            $data["alt_zip"] = $alt_zip;
            $data["alt_city"] = $alt_city;
            $data["alt_email"] = $alt_email;
            $data["alt_phone"] = $alt_phone;
            $data["alt_iban"] = $alt_iban;
            $data["alt_bankname"] = $alt_bankname;
        }


        // Concatenate suggestions and display nicely, if there are more than 1
        if (isset($_POST['oral'])) {
            $oral_suggestion = $_POST['oral'];
            if ($data["suggestions"] == "") {
                $data["suggestions"] .= $oral_suggestion;
                ;
            } else {
                $data["suggestions"] .= ", " . $oral_suggestion;
                ;
            }
        }

        if (isset($_POST['socialmedia'])) {
            $socialmedia_suggestion = $_POST['socialmedia'];
            if ($data["suggestions"] == "") {
                $data["suggestions"] .= $socialmedia_suggestion;
            } else {
                $data["suggestions"] .= ", " . $socialmedia_suggestion;
            }

        }
        if (isset($_POST['ricardo'])) {
            $ricardo_suggestion = $_POST['ricardo'];
            if ($data["suggestions"] == "") {
                $data["suggestions"] .= $ricardo_suggestion;
            } else {
                $data["suggestions"] .= ", " . $ricardo_suggestion;
            }
        }
        if (isset($_POST['flyer'])) {
            $flyer_suggestion = $_POST['flyer'];
            if ($data["suggestions"] == "") {
                $data["suggestions"] .= $flyer_suggestion;
            } else {
                $data["suggestions"] .= ", " . $flyer_suggestion;
            }
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
            $mainError++;
            $email_error = "Keine gültige Email-Addresse";
        }

        if (!filter_var($alt_email, FILTER_VALIDATE_EMAIL) && !empty($alt_email)) {
            $mainError++;
            $alt_email_error = "Keine gültige Email-Addresse";

        }

        // If there were errors, display form with either empty or the repopulated entries 
        if ($mainError > 0) {
            displayForm(
                $language,
                $mainError,
                $keepAltFormOpen,
                $title,
                $title_error,
                $alt_title,
                $name,
                $name_error,
                $alt_name,
                $surname,
                $surname_error,
                $alt_surname,
                $address,
                $address_error,
                $alt_address,
                $po_box,
                $alt_pox_box,
                $zip,
                $zip_error,
                $alt_zip,
                $city,
                $city_error,
                $alt_city,
                $email,
                $email_error,
                $alt_email,
                $alt_email_error,
                $phone,
                $phone_error,
                $alt_phone,
                $iban,
                $iban_error,
                $alt_iban,
                $bankname,
                $bankname_error,
                $alt_bankname,
                $oral_suggestion,
                $socialmedia_suggestion,
                $ricardo_suggestion,
                $flyer_suggestion
            );
        } else {
            ParseToDatabase($data);
        }
    }

    ?>
</body>

</html>