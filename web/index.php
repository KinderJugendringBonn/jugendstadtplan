<!DOCTYPE html>
<?php
    if (file_exists('environment.php')) {
        include_once('environment.php');
    } else {
        $environment = 'production';
    }
?>
<html data-ng-app="jugendstadtplan" data-ng-controller="AppCtrl">
  <head>
    <title data-ng-bind="pageTitle"></title>
    <meta charset="utf-8">

    <!-- Crawlable by Spiders.. -->
    <meta name="fragment" content="!" />

    <!-- social media tags -->
    <meta property="og:title" content="Jugendstadtplan" />
    <meta property="og:type" content="website" />

    <!-- font awesome from BootstrapCDN -->
    <!--<link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">-->

    <link rel="stylesheet" type="text/css" href="/vendor/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" type="text/css" href="/css/screen.css" />
  </head>
  <body>
  <div class="logo-wrapper row">
      <div class="logo-container small-12 large-6 columns">
        <a href="/"><img src="/img/logo.png" alt="Logo des Jugendstadtplans" /></a>
      </div>
      <div class="sysnav-container small-12 large-3 columns">
          <a href="#/kontakt">Kontakt</a>
          <a href="#/impressum">Impressum</a>
          <a href="#/login">Login</a>
      </div>
      <div class="social-media-container-top large-3 columns">
          <a href="https://de-de.facebook.com/jugendstadtplanbonn">
              <img src="/img/facebook-icon_inaktiv.png" data-ng-mouseenter="active = true" data-ng-mouseleave="active = false" data-ng-hide="active" data-ng-init="active = false" />
              <img src="/img/facebook-icon_aktiv.png" data-ng-mouseenter="active = true" data-ng-mouseleave="active = false" data-ng-show="active" data-ng-init="active = false" />
              Facebook
          </a>
      </div>
  </div>
  <div class="top-bar-wrapper">
        <div class="top-bar" role="navigation" data-topbar>
            <ul class="title-area">
                <li class="name">
                    <h1>
                        <a href="/">Jugendstadtplan</a>
                    </h1>
                </li>
            </ul>
            <section class="top-bar-section">
              <ul class="left">
                <li data-ui-route="/startseite" data-ng-class="{active:$uiRoute}">
                  <a href="#/startseite">
                    <i class="icon-home"></i>
                    Startseite
                  </a>
                </li>
                <li data-ui-route="/pins" data-ng-class="{active:$uiRoute}">
                  <a href="#/pins">
                    <i class="icon-info-sign"></i>
                    Pins
                  </a>
                </li>
                <li data-ui-route="/traeger" data-ng-class="{active:$uiRoute}">
                  <a href="#/traeger">
                    <i class="icon-info-sign"></i>
                    Träger
                  </a>
                </li>
              </ul>
            </section>
        </div>
    </div>

    <div class="row">
        <aside class="large-2 columns">
            <div class="sidebar">
            <a href="#/traeger/create" class="button success">Registrieren</a>
            <a href="#/pin/create" class="button success">Pin anlegen</a>
            </div>
        </aside>

        <div class="small-12 medium-12 large-10 columns">
            <div class="large-10 columns" data-ui-view="main"></div>
        </div>
    </div>

    <div class="action-claim">
        <div class="row">
            <div class="large-2 columns"></div>
            <div class="large-10 columns text-center">
                <h3>Jeden Tag ein neues Abenteuer!</h3>
                <a href="#/pins">Jetzt stöbern</a>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="row">
            <div class="social-media-container small-12 large-4 columns">
                <h3>Social Media</h3>
                <a href="https://de-de.facebook.com/jugendstadtplanbonn">
                    <img src="/img/facebook-icon_inaktiv.png" data-ng-mouseenter="active = true" data-ng-mouseleave="active = false" data-ng-hide="active" data-ng-init="active = false" />
                    <img src="/img/facebook-icon_aktiv.png" data-ng-mouseenter="active = true" data-ng-mouseleave="active = false" data-ng-show="active" data-ng-init="active = false" />
                    Facebook
                </a>
            </div>
            <div class="about small-12 large-4 columns">
                <h3>Über den Jugendstadtplan Bonn</h3>
                <p>Der interaktive Jugendstadtplan Bonn ist ein Modellprojekt des Kinder- und Jugendrings Bonn.<br />Unser Ziel ist die Einrichtung eines internetbasierten, interaktiven Jugendstadtplans von Bonn für Kinder.</p>
                <a href="#/about">Erfahren Sie mehr..</a>
            </div>
            <div class="small-12 large-4 columns">
                <img src="/img/logo.png" alt="Logo des Jugendstadtplans" />
            </div>
        </div>
    </div>

  <?php
  if ($environment == 'development') {
  ?>
    <script type="text/javascript" src="/vendor/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="/vendor/jquery.cookie/jquery.cookie.js"></script>
    <script type="text/javascript" src="/vendor/jquery-placeholder/jquery.placeholder.js"></script>
    <script type="text/javascript" src="/vendor/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="/vendor/foundation/js/foundation.js"></script>
    <script type="text/javascript" src="/vendor/rangy/rangy-core.js"></script>
    <script type="text/javascript" src="/vendor/rangy/rangy-classapplier.js"></script>
    <script type="text/javascript" src="/vendor/rangy/rangy-highlighter.js"></script>
    <script type="text/javascript" src="/vendor/rangy/rangy-selectionsaverestore.js"></script>
    <script type="text/javascript" src="/vendor/rangy/rangy-serializer.js"></script>
    <script type="text/javascript" src="/vendor/rangy/rangy-textrange.js"></script>
    <script type="text/javascript" src="/vendor/leaflet/dist/leaflet-src.js"></script>
    <script type="text/javascript" src="/vendor/angular/angular.js"></script>
    <script type="text/javascript" src="/vendor/angular-foundation/mm-foundation.js"></script>
    <script type="text/javascript" src="/vendor/angular-foundation/mm-foundation-tpls.js"></script>
    <script type="text/javascript" src="/vendor/angular-leaflet-directive/dist/angular-leaflet-directive.js"></script>
    <script type="text/javascript" src="/vendor/angular-resource/angular-resource.js"></script>
    <script type="text/javascript" src="/vendor/angular-sanitize/angular-sanitize.js"></script>
    <script type="text/javascript" src="/vendor/angular-ui-router/release/angular-ui-router.js"></script>
    <script type="text/javascript" src="/vendor/angular-ui-utils/ui-utils.js"></script>
    <script type="text/javascript" src="/vendor/ng-file-upload/angular-file-upload-shim.js"></script>
    <script type="text/javascript" src="/vendor/ng-file-upload/angular-file-upload-html5-shim.js"></script>
    <script type="text/javascript" src="/vendor/ng-file-upload/angular-file-upload.js"></script>
    <script type="text/javascript" src="/vendor/textAngular/src/textAngular.js"></script>
    <script type="text/javascript" src="/vendor/textAngular/src/textAngularSetup.js"></script>
    <script type="text/javascript" src="/vendor/textAngular/src/textAngular-sanitize.js"></script>
  <?php } else { ?>
  <?php } ?>
    <script type="text/javascript" src="/js/jugendstadtplan.min.js"></script>

    <!-- it's stupid to have to load it here, but this is for the +1 button -->
    <script type="text/javascript" src="https://apis.google.com/js/plusone.js">
      { "parsetags": "explicit" }
    </script>
    </div>
  </body>
</html>
