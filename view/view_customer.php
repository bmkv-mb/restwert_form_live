<?php
$filename = basename(__FILE__);
$filepath = dirname(__FILE__) . basename(__FILE__);

include (dirname(__DIR__) . '/db/get_data.php');
include (dirname(__DIR__) . '/db/update_db_entry.php')
?>
<!DOCTYPE html>
<html>
<head>
  <title>PHP & MySQL Pagination by CodeShack</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../assets/viewer_style.css">
</head>

<body>
  <!-- Shows a tooltip when user clicks on field and copies it -->
  <div class="tooltip">
    <div class="tooltiptext">
      <span>Kopiert!</span>
    </div>
  </div>

  <div class="interface">
    <div class="banner"> </div>

    <form method="get" id="myform" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="search-bar" >
        <input type="text" name="search" placeholder="Suchen" style="width:170px" value="<?php if (isset($_GET['search'])) {
          echo $_GET['search'];
        } ?>">

      </div>
      <!-- Search function, Reset function and filter for unchecked entries -->
      <div class="search-btn">
        <input type="submit" class="btn" name="submit" value="Suchen">
        <input type="submit" class="btn" name="reset" value="Reset">
        <input type="submit"  class="btn"name="filter" value="'Nicht eingetragen' Filtern">
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
            <!-- If entry in DB is "checked", show as checked and disable checkbox -->
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
      </div>
  </form>

  <!-- Save button after changing a checkbox. Changes to DB won't occure unless pressed -->
  <input style="margin-top:10px" type="submit" class="btn" form="dbform" name="dbform" value="Speichern"> </input><br>

  <!-- Pagination -->
  <?php include (dirname(__DIR__) . '/view/pagination.php'); ?>
                   
  <script>

    // Function to copy text by clicking the field 
    const tds = document.querySelectorAll("td.tg-0lax");
    var tooltip = document.querySelector('.tooltip')

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

      // Popup and fade-out on successful copy
      td.addEventListener('click', function () {
        tooltip.classList.add('active');
        setTimeout(clearPopup, 500);
      });
    }
    );

    function clearPopup() {
      tooltip.classList.remove('active');
    }
  </script>
</body>
</html>
<?php
?>