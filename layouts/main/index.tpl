<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Player's FTW!</title>
        <meta name="description" content="Player's FTW!">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="/css/main/normalize.css">
        <link rel="stylesheet" href="/css/main/main.css">
            
        <link rel="stylesheet" href="/css/main/style.css?v=2">
            
        <script src="/js/main/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        
        <!--[if lt IE 7]>
        <p class="chromeframe error">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        
        <div class="container">
            <header class="span-24">
                <h1>Company Name</h1>
                <h2 class="alt">lorem ipsum dolor</h2>
            </header>
            
            <section id="main" class="span-24">
                <?php $layout->getContent('nav'); ?>
                <?php $layout->getContent('view'); ?>
            </section>
            
            <footer class="span-24">
                <?php $layout->getContent('footer'); ?>
            </footer>
        </div>        

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="/js/main/vendor/jquery-1.9.0.min.js"><\/script>')</script>
        <script src="/js/main/plugins.js"></script>
        <script src="/js/main/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <!--<script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>-->

    </body>
</html>
