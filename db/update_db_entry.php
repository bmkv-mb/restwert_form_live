<?php
// If status is unchecked, change the entry's "incorporated" status in the DB to "checked"
if (isset($_POST['dbform'])) {
  foreach ($_POST['incorporated'] as $key => $value) {

    $status = "checked";
    $id = $key;

    if ($value == "unchecked") {
      $connection = Connect();
      $SQL = $connection->prepare("UPDATE customers SET incorporated=? WHERE id=?");

      $SQL->bind_param('si', $status, $id);
      $SQL->execute();

    } elseif ($status == "checked") { 
      //shouldn't be needed because checkboxes are disabled if checked to prevent user error
      echo 'ID ' . $id . ' is already ' . $status . "<br>";
    }
  }
  header("Location:{$filename}");
}
?>