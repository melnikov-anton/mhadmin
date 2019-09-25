<div class="col-md-9 border border-primary p-4 bg-light mh-100">
  <?php include PAGES_DIR . DS . 'cards/user_info_card.php'; ?>
  <br>
    <?php if(defined('SITES_INFO_CARD')) {
      include SITES_INFO_CARD;
      }
    ?>
  <br>
  <?php if(defined('DB_INFO_CARD')) {
    include DB_INFO_CARD;
    }
  ?>
  <br>
  <?php if(defined('FTP_INFO_CARD')) {
    include FTP_INFO_CARD;
    }
  ?>
</div>
