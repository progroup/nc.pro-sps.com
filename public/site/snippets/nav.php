<div class="above-nav">
  <div class="container">
    <div class="above-nav__outer-wrapper flex-stretch">
      <a href="/"><img class="above-nav__logo" alt="NC SPS Logo" src="/assets/images/logo-ncpttac.jpg" style="width: 300px"></a>
      <div class="above-nav__inner-wrapper hidden-xs">
<!--         <ul class="list-inline" style="display: flex; justify-content: space-between">
          <li><b>GA-SPS Data Centers:</b></li>
          <li><a href="https://www.georgiamds.uga.edu/PublicHome/Index" target="new">MDS</a></li>
          <li><a href="http://gaspsdata.net/" target="new">GA Data Warehouse</a></li>
        </ul> -->
        <div>
            <a href="http://ncpreventiontta.skyprepapp.com/" target="_new" class="ecco-login btn btn-primary" style="width: auto;margin-bottom:2px">Training Portal</a>
            <a href="http://ecco.nc.pro-sps.com/login.php" target="_new" class="ecco-login btn btn-primary" style="width: auto;margin-bottom:2px">Ecco v4.0 Sign In</a>
        </div>
		<div>
             <a href="https://ncpreventiontta.zendesk.com/" target="_new" class="ecco-login btn btn-primary" style="width: auto;">Help Desk</a>
        		<a href="/staff" class="ecco-login btn btn-primary" style="width: auto;">Staff Page</a>
		</div>
      </div>
    </div>
  </div>
</div>

<nav class="navbar navbar-default" role="navigation" style="background-color: #eee;border-top:1px solid #002868">
  <div class="container">
    <div class="navbar-header">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
    </div>
    <div class="collapse navbar-collapse" id="navbar">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">About<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li>
              <a href="<?php echo url('about') ?>"><i style="color: rgba(154, 0, 46, 1);">&bull;</i> About Us</a>
            </li>
            <li>
              <a href="/about/contact"><i style="color: rgba(154, 0, 46, 1);">&bull;</i> Contact Information</a>
            </li>
            <li>
              <a href="/about/consultants-corner"><i style="color: rgba(154, 0, 46, 1);">&bull;</i> Consultants Corner</a>
            </li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Resources<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li>
              <a href="/search?q=Intro"><i style="color: rgba(154, 0, 46, 1);">&bull;</i> Introduction to Prevention</a>
            </li>
            <li>
              <a href="/search?q=prescription+drugs"><i style="color: rgba(154, 0, 46, 1);">&bull;</i> Prescription Drug Prevention</a>
            </li>
            <li>
              <a href="/search?q=strategies"><i style="color: rgba(154, 0, 46, 1);">&bull;</i> Evidence Based Strategies</a>
            </li>
            <li>
              <a href="/search?q=webinar"><i style="color: rgba(154, 0, 46, 1);">&bull;</i> Webinars</a>
            </li>
            <li>
              <a href="/search?q=tools"><i style="color: rgba(154, 0, 46, 1);">&bull;</i> Tools</a>
            </li>
            <li>
              <a href="/search?q=strategic"><i style="color: rgba(154, 0, 46, 1);">&bull;</i> Strategic Prevention Framework</a>
            </li>

            <li>
              <a href="/search?q=suicide+prevention"><i style="color: rgba(154, 0, 46, 1);">&bull;</i> Suicide Prevention</a>
            </li>
            <li>
              <a href="/search?q=admin"><i style="color: rgba(154, 0, 46, 1);">&bull;</i> Admin</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="/spf">SPF Overview</a>
        </li>
      </ul>
      <ul class="list-unstyled visible-xs-block">
        <li><a href="http://ncpreventiontta.skyprepapp.com/" target="_new" class="ecco-login btn btn-primary">Training Portal</a></li>
        <li><a href="http://ecco.nc.pro-sps.com/login.php" target="_new" class="ecco-login btn btn-primary">Ecco v4.0 Sign In</a></li>
        <li><a href="https://ncpreventiontta.zendesk.com/" target="_new" class="ecco-login btn btn-primary">Help Desk</a></li>
        <li><a href="/staff" class="ecco-login btn btn-primary">Staff Page</a></li>  
      </ul>
      <form class="navbar-form navbar-right" style="padding-right:0" role="search" action="<?php echo url('search') ?>">
        <div class="form-group">
          <input name="q" type="search" placeholder="What resources can we help you find today?" class="form-control" style='width: 350px;border: 1px solid rgba(154, 0, 46, 1);'>
        </div>
        <button type="submit" class="btn" style="background-color: rgba(154, 0, 46, 1);color: white">Search</button>
      </form>
    </div>
  </div>
</nav>
<!-- TODO Move to proper place -->
<style>
  .above-nav {
    background-color: #9a002e;
    background-color: white;
  }
  .above-nav p {
    color: #111;
    line-height: 100px;
    font-size: 20px;
    padding: 0;
  }
  .above-nav__logo { min-width: 300px }
  .above-nav__outer-wrapper {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
        -ms-flex-pack: justify;
            justify-content: space-between;
    -webkit-box-align: center;
    -webkit-align-items: center;
        -ms-flex-align: center;
            align-items: center;
  }
  .above-nav__outer-wrapper li {
    /*margin-left: 1em;*/
    /*display: inline-block;*/
  }
  .above-nav__inner-wrapper {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column
  }
  .ecco-login {
    width: 50%;
    align-self: flex-end;
  }
  @media (min-width: 768px) {
    .navbar-nav > li > a {
      color: #9a002e;
    }

    .affix {
      top: 0px;
      width: 100%;
    }

    .navbar {
      border-radius: 0;
    }
    .navbar-collapse {
        margin-top: 0;
        background-color: transparent;
        padding-left: 0;
    }
    .royalSlider {
        margin-bottom: 1em;
        margin-top: 0;
    }
  }

/*
  @media (min-width: 768px) {
    .navbar-nav > li > a {
      color: #9a002e;
  }

  .affix {
    top: 0px;
    width: 100%;
  }

  .navbar {
    border-radius: 0;
  }
  .navbar-collapse {
      margin-top: 0;
      background-color: transparent;
      padding-left: 0;
  }

  .royalSlider {
      margin-bottom: 1em;
      margin-top: 0;
  }*/
</style>
