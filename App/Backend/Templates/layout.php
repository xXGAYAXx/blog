<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <meta description="">

    <link rel="stylesheet" href="/css/style.css" type="text/css" />

    <title><?= isset($title) ? $title : 'L\'élu de l\'adméria' ?></title>

  </head>

  <body>

    <header>

      <div id="nav-box"><!-- /////////////////////////// NAV-BOX /////////////////////////// -->

        <nav><!-- NAV -->
          <ul id="nav-list-box">
            <?php
              if (!$this->app->user()->isAuthenticated()){
                ?>
                <li class="nav-list"><a href="/" title="Lien vers la page Accueil">Accueil</a></li>
                <li class="nav-list"><a href="/chapter-list" title="Lien vers la page Liste des chapitres">Liste des chapitres</a></li>
                <li class="nav-list"><a href="/last-chapter" title="Lien vers la page Dernier chapitre">Dernier chapitre</a></li>
                <?php
              }
            ?>

            <?php
              if ($this->app->user()->isAuthenticated()){
                ?>
                <li class="nav-list menu-list"><a href="/admin/chapter-list" title="Lien vers la page Chapitres">Chapitres</a></li>
                <li class="nav-list menu-list"><a href="/admin/chapter-insert" title="Lien vers la page Nouveau Ecriture">Ecriture</a></li>
                <li class="nav-list menu-list"><a href="/admin/last-chapter" title="Lien vers la page Dernier chapitre">Dernier chapitre</a></li>
                <li class="nav-list menu-list"><a href="/admin/deconnexion" title="Lien vers la page deconnexion">déconnexion</a></li>
                <?php
              }
            ?>
                <li class="nav-list">
                  <div class="show-menu-btn">
                    <div class="btn-line"></div>
                    <div class="btn-line"></div>
                    <div class="btn-line"></div>
                  </div>
                  <div class="hide-menu-btn">
                    <div class="btn-line"></div>
                    <div class="btn-line"></div>
                    <div class="btn-line"></div>
                  </div>
                </li>


            </li>
          </ul>
        </nav><!-- end NAV -->



      </div><!-- ////////////////////////////// end NAV-BOX //////////////////// -->
      <div class="banner-box">
        <div class="<?= isset($bannerClass) ? $bannerClass : 'banner' ?> banner"></div>
      </div>
    </header>

    <section class="main">
      <h1><?= isset($title) ? $title : 'L\'élu de l\'adméria' ?></h1>
      <?php if ($user->hasFlash()) echo '<p class="flash">', $user->getFlash(), '</p>'; ?>
      <div class="page"><?= $content ?></div>
    </section>

    <footer class="row">
  		<div class="footerList col-md-3 col-lg-3 col-sm-3">Thais Glawdys</div>
  		<div class="footerList col-md-3 col-lg-3 col-sm-3"> <a href="#">mentions légales</a></div>
      <div class="footerList col-md-3 col-lg-3 col-sm-3">Réalisé par <a target="_blank" href="http://www.adn.thais-kevin.club">ADN</a> </div>
  	</footer>
    <script type="text/javascript" src="/js/nav.js"></script>
  </body>
</html>
