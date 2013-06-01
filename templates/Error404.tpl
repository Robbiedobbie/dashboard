<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Error - Page not found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>

    <link href="internals/stylesheet.css" rel="stylesheet">
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="bootstrap/js/html5shiv.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class='navbar navbar-fixed-top'>
      <div class='navbar-inner'>
        <div class='container'>
          <button type='button' class='btn btn-navbar' data-toggle='collapse' data-target='.nav-collapse'>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
          </button>
          <a class='brand' href='index.php'>{{@DeviceName}}</a>
          <div class='nav-collapse collapse pull-right'>
            <ul class='nav'>
              <li><a href='index.php'>General</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class='container'>
      <br /><br /><h1>Sorry, that page doesn’t exist!</h1><br /><br />
      <p>You can go home by following this link: <a href='/'>Home</a>.</p>
    </div>
  </body>
</html>
