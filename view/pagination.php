  <?php if (ceil($total_pages / $num_results_on_page) > 0): ?>
    <ul class="pagination">
      <?php if ($page > 0): ?>
        <li class="prev"><a href="<?php $filepath ?>?page=<?php  if($page == 1) {echo $page;} else{echo $page - 1;}
          if (isset($_GET['search'])) {
            echo "&search=" . $_GET['search'] . "&submit=Suchen";
          } ?>">Prev</a></li>
      <?php endif; ?>

      <?php if ($page > 3): ?>
        <li class="start"><a href="<?php $filepath ?>?page=1" ?>>1</a></li>
        <li class="dots">...</li>
      <?php endif; ?>

      <?php if ($page - 2 > 0): ?>
        <li class="page"><a href="<?php $filepath ?>?page=<?php
          if (isset($_GET['search'])) {
            echo $page - 2 . "&search=" . $_GET['search'] . "&submit=Suchen";
          } else {
            echo $page - 2;
          } ?>"><?php echo $page - 2 ?></a></li>
      <?php endif; ?>
      <?php if ($page - 1 > 0): ?>
        <li class="page"><a href="<?php $filepath ?>?page=<?php if (isset($_GET['search'])) {
            echo $page - 1 . "&search=" . $_GET['search'] . "&submit=Suchen";
          } else {
            echo $page - 1;
          } ?>"><?php echo $page - 1 ?></a></li>
      <?php endif; ?>

      <li class="currentpage"><a href="<?php $filepath ?>?page=<?php if (isset($_GET['search'])) {
          echo $page . "&search=" . $_GET['search'] . "&submit=Suchen";
        } else {
          echo $page;
        } ?>"><?php echo $page; ?></a></li>

      <?php if ($page + 1 < ceil($total_pages / $num_results_on_page) + 1): ?>
        <li class="page"><a href="<?php $filepath ?>?page=<?php if (isset($_GET['search'])) {
            echo $page + 1 . "&search=" . $_GET['search'] . "&submit=Suchen";
          } else {
            echo $page + 1;
          } ?>"><?php echo $page + 1 ?></a></li>
      <?php endif; ?>
      <?php if ($page + 2 < ceil($total_pages / $num_results_on_page) + 1): ?>
        <li class="page"><a href="<?php $filepath ?>?page=<?php if (isset($_GET['search'])) {
            echo $page + 2 . "&search=" . $_GET['search'] . "&submit=Suchen";
          } else {
            echo $page + 2;
          } ?>"><?php echo $page + 2 ?></a></li>
      <?php endif; ?>

      <?php if ($page < ceil($total_pages / $num_results_on_page) - 2): ?>
        <li class="dots">...</li>
        <li class="end"><a
            href="<?php $filepath ?>?page=<?php echo ceil($total_pages / $num_results_on_page) ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a>
        </li>
      <?php endif; ?>

      <?php if (true): ?>
        <li class="next"><a href="<?php $filepath ?>?page=<?php if($page < ceil($total_pages / $num_results_on_page)) {echo $page + 1;} else{echo $page; }
          if (isset($_GET['search'])) {
            echo "&search=" . $_GET['search'] . "&submit=Suchen";
          } ?>">Next</a></li>
      <?php endif; ?>
    </ul>
  <?php endif; ?>