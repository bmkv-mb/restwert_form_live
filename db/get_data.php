<?php
include ('../db/parse_customer_data.php');

$connection = Connect();

if (isset($_GET["reset"])) {
    header("Location: ../view/view_customer.php");
}

if (isset($_GET["filter"])) {
    $filter = 'unchecked';
    $_GET['search'] = "";

    $sqlsearch = "SELECT * FROM customers WHERE incorporated LIKE '%$filter%'";
    // Get the data from our table "customers" containing the search value.

    // Get the total number of records from our table "customers" containing the search value.
    $total_pages = Connect()->query($sqlsearch)->num_rows;

    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 10;

    $stmt = $connection->prepare("SELECT * FROM customers WHERE incorporated LIKE '%$filter%' LIMIT ?,?");
    $calc_page = ($page - 1) * $num_results_on_page;
    $stmt->bind_param('ii', $calc_page, $num_results_on_page);
    $stmt->execute();
    $result = $stmt->get_result();
}

else if (isset($_GET["submit"])) {

    $search = $_GET['search'];
    // Get the data from our table "customers" containing the search value.
    $sqlsearch = "SELECT * FROM customers WHERE name LIKE '%$search%' OR surname LIKE '%$search%' OR address LIKE '%$search%' OR zip LIKE '%$search%' OR city LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%' OR bankname LIKE '%$search%'";

    // Get the total number of records from our table "customers" containing the search value.
    $total_pages = Connect()->query($sqlsearch)->num_rows;

    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 10;

    $stmt = $connection->prepare("SELECT * FROM customers WHERE name LIKE '%$search%' OR surname LIKE '%$search%' OR address LIKE '%$search%' OR zip LIKE '%$search%' OR city LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%' OR bankname LIKE '%$search%' LIMIT ?,?");
    $calc_page = ($page - 1) * $num_results_on_page;
    $stmt->bind_param('ii', $calc_page, $num_results_on_page);
    $stmt->execute();
    $result = $stmt->get_result();

} elseif ($stmt = $connection->prepare('SELECT * FROM customers LIMIT ?,?')) {
    // Get the total number of records from our table "customers".
    $total_pages = $connection->query('SELECT * FROM customers')->num_rows;

    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 10;

    $calc_page = ($page - 1) * $num_results_on_page;
    $stmt->bind_param('ii', $calc_page, $num_results_on_page);
    $stmt->execute();
    $result = $stmt->get_result();
}