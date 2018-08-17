<? snippet('header') ?>
<? snippet('banner') ?>
<div class="container">
  <div class="row">
    <div class="col-md-9 col-md-push-3">
      <div class="page-header">
        <h1><?= $page->title()->html() ?></h1>
      </div>
      <?= $page->text()->kirbytext() ?>
      <iframe height='500px' width='100%' frameborder='0' allowTransparency='true' scrolling='auto' src='https://creator.zohopublic.com/marc247/ecco-intake/form-embed/Ecco_Intake/SHn2zGfMHg9kz3s0jkyBNAfwsZzDeCv5y7mEz0EEFgNykn5XAXYB4SekjUCCq3Oy6YTYUN5AFMT1Dk3OHjtQ2rzAajCP7q78bsGf'></iframe>
    </div>
    <div class="col-md-3 col-md-pull-9">
      <? snippet('sidebar') ?>
    </div>
  </div>
</div>
<? snippet('footer') ?>
