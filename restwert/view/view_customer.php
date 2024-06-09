<?php
$myFile = pathinfo('C:/xampp/htdocs/restwert/view/view_customer.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/Restwert/db/get_data.php');
?>
<!DOCTYPE html>
<html>
<?php

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
      echo 'ID ' . $id . ' is already ' . $status . "<br>";
    }
  }
  header("Location:{$myFile['basename']}");
}
?>

<head>
  <title>PHP & MySQL Pagination by CodeShack</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../assets/viewer_style.css">
</head>

<body>
  <div class="tooltip">
    <div class="tooltiptext">
      <span>Kopiert!</span>
    </div>
  </div>

  <div class="interface">
    <form method="get" id="myform" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="search-header">
        Suchen
      </div>
      <div class="search-bar">
        <input type="text" name="search" value="<?php if (isset($_GET['search'])) {
          echo $_GET['search'];
        } ?>">
      </div>
      <div class="search-btn">
        <input type="submit" name="submit" value="Suchen">
        <input type="submit" name="reset" value="Reset">
      </div>
    </form>
  </div>

  <form id="dbform" method="post">
    <div class="tg-wrap">
      <table class="tg">
        <thead>
          <tr class="sticky-header">
            <th class="tg-0lax">Eingetragen</th>
            <th class="tg-0lax">Anrede</th>
            <th class="tg-0lax">Vorname</th>
            <th class="tg-0lax">Nachname</th>
            <th class="tg-0lax">Adresse<br></th>
            <th class="tg-0lax">Postfach<br></th>
            <th class="tg-0lax">PLZ<br></th>
            <th class="tg-0lax">Ort</th>
            <th class="tg-0lax">Email</th>
            <th class="tg-0lax">Telefon<br></th>
            <th class="tg-0lax">Iban<br></th>
            <th class="tg-0lax">Bankname<br></th>
            <th class="tg-0lax">Alt. Anrede</th>
            <th class="tg-0lax">Alt. Vorname</th>
            <th class="tg-0lax">Alt. Nachname</th>
            <th class="tg-0lax">Alt. Adresse<br></th>
            <th class="tg-0lax">Alt. Postfach<br></th>
            <th class="tg-0lax">Alt. PLZ<br></th>
            <th class="tg-0lax">Alt. Ort</th>
            <th class="tg-0lax">Alt. Email</th>
            <th class="tg-0lax">Alt. Telefon<br></th>
            <th class="tg-0lax">Alt. Iban<br></th>
            <th class="tg-0lax">Alt. Bankname<br></th>
          </tr>
        </thead>
        <?php while ($data = $result->fetch_assoc()): ?>
          <tr>
            <td class=""><input type="checkbox" name="incorporated[<?php echo $data['id'] ?>]"
                value="<?php echo $data['incorporated'] ?>" <?php if ($data['incorporated'] == 'checked') {
                     echo "checked disabled";
                   } ?>></input>
            </td>
            <td class="tg-0lax"><?php echo $data['title'] ?><br></td>
            <td class="tg-0lax"><?php echo $data['name'] ?></td>
            <td class="tg-0lax"><?php echo $data['surname'] ?><br></td>
            <td class="tg-0lax"><?php echo $data['address'] ?></td>
            <td class="tg-0lax"><?php echo $data['po_box'] ?></td>
            <td class="tg-0lax"><?php echo $data['zip'] ?></td>
            <td class="tg-0lax"><?php echo $data['city'] ?></td>
            <td class="tg-0lax"><?php echo $data['email'] ?></td>
            <td class="tg-0lax"><?php echo $data['phone'] ?></td>
            <td class="tg-0lax"><?php echo $data['iban'] ?></td>
            <td class="tg-0lax"><?php echo $data['bankname'] ?></td>
            <td class="tg-0lax"><?php echo $data['alt_title'] ?><br></td>
            <td class="tg-0lax"><?php echo $data['alt_name'] ?></td>
            <td class="tg-0lax"><?php echo $data['alt_surname'] ?><br></td>
            <td class="tg-0lax"><?php echo $data['alt_address'] ?></td>
            <td class="tg-0lax"><?php echo $data['alt_po_box'] ?></td>
            <td class="tg-0lax"><?php echo $data['alt_zip'] ?></td>
            <td class="tg-0lax"><?php echo $data['alt_city'] ?></td>
            <td class="tg-0lax"><?php echo $data['alt_email'] ?></td>
            <td class="tg-0lax"><?php echo $data['alt_phone'] ?></td>
            <td class="tg-0lax"><?php echo $data['alt_iban'] ?></td>
            <td class="tg-0lax"><?php echo $data['alt_bankname'] ?></td>
          </tr>
        <?php endwhile; ?>

        </tbody>
      </table>
      <input type="submit" form="dbform" name="dbform" value="Speichern"> </input><br>
  </form>


  <?php if (ceil($total_pages / $num_results_on_page) > 0): ?>
    <ul class="pagination">
      <?php if ($page > 1): ?>
        <li class="prev"><a href="<?php $myFile['basename'] ?>?page=<?php echo $page - 1;
          if (isset($_GET['search'])) {
            echo "&search=" . $_GET['search'] . "&submit=Suchen";
          } ?>">Prev</a></li>
      <?php endif; ?>

      <?php if ($page > 3): ?>
        <li class="start"><a href="<?php $myFile['basename'] ?>?page=1" ?>>1</a></li>
        <li class="dots">...</li>
      <?php endif; ?>

      <?php if ($page - 2 > 0): ?>
        <li class="page"><a href="<?php $myFile['basename'] ?>?page=<?php
          if (isset($_GET['search'])) {
            echo $page - 2 . "&search=" . $_GET['search'] . "&submit=Suchen";
          } else {
            echo $page - 2;
          } ?>"><?php echo $page - 2 ?></a></li>
      <?php endif; ?>
      <?php if ($page - 1 > 0): ?>
        <li class="page"><a href="<?php $myFile['basename'] ?>?page=<?php if (isset($_GET['search'])) {
            echo $page - 1 . "&search=" . $_GET['search'] . "&submit=Suchen";
          } else {
            echo $page - 1;
          } ?>"><?php echo $page - 1 ?></a></li>
      <?php endif; ?>

      <li class="currentpage"><a href="<?php $myFile['basename'] ?>?page=<?php if (isset($_GET['search'])) {
          echo $page . "&search=" . $_GET['search'] . "&submit=Suchen";
        } else {
          echo $page;
        } ?>"><?php echo $page; ?></a></li>

      <?php if ($page + 1 < ceil($total_pages / $num_results_on_page) + 1): ?>
        <li class="page"><a href="<?php $myFile['basename'] ?>?page=<?php if (isset($_GET['search'])) {
            echo $page + 1 . "&search=" . $_GET['search'] . "&submit=Suchen";
          } else {
            echo $page + 1;
          } ?>"><?php echo $page + 1 ?></a></li>
      <?php endif; ?>
      <?php if ($page + 2 < ceil($total_pages / $num_results_on_page) + 1): ?>
        <li class="page"><a href="<?php $myFile['basename'] ?>?page=<?php if (isset($_GET['search'])) {
            echo $page + 2 . "&search=" . $_GET['search'] . "&submit=Suchen";
          } else {
            echo $page + 2;
          } ?>"><?php echo $page + 2 ?></a></li>
      <?php endif; ?>

      <?php if ($page < ceil($total_pages / $num_results_on_page) - 2): ?>
        <li class="dots">...</li>
        <li class="end"><a
            href="<?php $myFile['basename'] ?>?page=<?php echo ceil($total_pages / $num_results_on_page) ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a>
        </li>
      <?php endif; ?>

      <?php if ($page < ceil($total_pages / $num_results_on_page)): ?>
        <li class="next"><a href="<?php $myFile['basename'] ?>?page=<?php echo $page + 1;
          if (isset($_GET['search'])) {
            echo "&search=" . $_GET['search'] . "&submit=Suchen";
          } ?>">Next</a></li>
      <?php endif; ?>
    </ul>
  <?php endif; ?>

  <script>
    const tds = document.querySelectorAll("td.tg-0lax");
    var tooltip = document.querySelector('.tooltip')

    function clearPopup() {
      tooltip.classList.remove('active');
    }
    tds.forEach((td) => {
      td.onclick = function () { document.execCommand("copy"); }

      td.addEventListener(
        "copy", function (event) {
          event.preventDefault();
          if (event.clipboardData) {
            event.clipboardData.setData("text/plain", td.textContent);
          }
        }
      );
      td.addEventListener('click', function () {
        tooltip.classList.add('active');
        setTimeout(clearPopup, 500);
      });
    }
    );
  </script>



</body>

</html>
<?php
?>