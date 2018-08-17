<? snippet('header') ?>
<? snippet('banner') ?>
<div class="container">
  <div class="row">
    <div class="col-md-9 col-md-push-3">
      <div class="page-header">
        <h1><?= $page->title()->html() ?></h1>
      </div>
      <?= $page->text()->kirbytext() ?>

      <div class="row">
        <div class="col-md-4 col-lg-4">

          <a href="https://trello.com/login?returnUrl=/" target="_blank" style="margin-bottom: 2rem">
            <img src="/assets/vectors/trello-mark-blue.svg" style="height: 5rem">
            <h2 style="display: inline-block">Trello</h2>
          </a>

        </div><!--/.col-md-4.col-lg-4-->
        <div class="col-md-4 col-lg-4">
          <a href="https://drive.google.com/drive/u/0/folders/0B6gpKzRyz2daVFM2X1F2eXd3MGc" target="_blank" style="margin-bottom: 2rem">
            <img src="/assets/vectors/google-drive.svg" style="height: 5rem">
            <h2 style="display: inline-block">Google Drive</h2>
          </a>
        </div><!--/.col-md-4.col-lg-4-->

        <div class="col-md-4 col-lg-4">
          <a href="http://ecco.nc.pro-sps.com/login.php" target="_blank" style="margin-bottom: 2rem">
            <img src="/assets/images/ecco-new.png" style="height: 6rem">
            <h2 style="display: inline-block">Ecco</h2>
          </a>
        </div><!--/.col-md-4.col-lg-4-->
      </div>
    </div>

    <div class="col-md-3 col-md-pull-9">
      <? snippet('sidebar') ?>
    </div>
  </div>
</div>
<? snippet('footer') ?>
