<?php
include($_SERVER['DOCUMENT_ROOT'] . '/Restwert/db/connect_db.php');

function ParseToDatabase($data)
{

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $connection = Connect();

        $stmt = $connection->prepare("INSERT INTO customers 
            (id,
            date,
            title,
            name,
            surname,
            address,
            po_box,
            zip,
            city,
            email,
            phone,
            iban,
            bankname,
            alt_title,
            alt_name,
            alt_surname,
            alt_address,
            alt_po_box,
            alt_zip,
            alt_city,
            alt_email,
            alt_phone,
            alt_iban,
            alt_bankname,
            suggestions,
            incorporated) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $id = null;
        $date = sanitizeInput($data['date']);
        $title = sanitizeInput($data['title']);
        $name = sanitizeInput($data['name']);
        $surname = sanitizeInput($data['surname']);
        $address = sanitizeInput($data['address']);
        $po_box = sanitizeInput($data['po_box']);
        $zip = sanitizeInput($data['zip']);
        $city = sanitizeInput($data['city']);
        $email = sanitizeInput($data['email']);
        $phone = sanitizeInput($data['phone']);
        $iban = sanitizeInput($data['iban']);
        $bankname = sanitizeInput($data['bankname']);
        $alt_title = sanitizeInput($data['alt_title']);
        $alt_name = sanitizeInput($data['alt_name']);
        $alt_surname = sanitizeInput($data['alt_surname']);
        $alt_address = sanitizeInput($data['alt_address']);
        $alt_po_box = sanitizeInput($data['alt_po_box']);
        $alt_zip = sanitizeInput($data['alt_zip']);
        $alt_city = sanitizeInput($data['alt_city']);
        $alt_email = sanitizeInput($data['alt_email']);
        $alt_phone = sanitizeInput($data['alt_phone']);
        $alt_iban = sanitizeInput($data['alt_iban']);
        $alt_bankname = sanitizeInput($data['alt_bankname']);
        $suggestions = sanitizeInput($data['suggestions']);
        $incorporated = sanitizeInput($data['incorporated']);

        $stmt->bind_param(
            "isssssssssssssssssssssssss",
            $id,
            $date,
            $title,
            $name,
            $surname,
            $address,
            $po_box,
            $zip,
            $city,
            $email,
            $phone,
            $iban,
            $bankname,
            $alt_title,
            $alt_name,
            $alt_surname,
            $alt_address,
            $alt_po_box,
            $alt_zip,
            $alt_city,
            $alt_email,
            $alt_phone,
            $alt_iban,
            $alt_bankname,
            $suggestions,
            $incorporated
        );

        // Execute the statement
        if ($stmt->execute()) {
            header("Location:redirect_customer.php");
            mysqli_close($connection);
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}


function sanitizeInput($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}
