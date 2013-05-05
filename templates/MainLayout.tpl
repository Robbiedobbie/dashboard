<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dashboard - {{@DeviceName}}</title>
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
    <script src="internals/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="bootstrap/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Uptime -->
    <script type="text/javascript">
      {{@InformationUpdateScript}}
    </script>

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
              <li class='dropdown'>
	        <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Software<b class='caret'></b></a>
		<ul class='dropdown-menu' role='menu'>
		  <li><a href='#'>This is a stub</a></li>
		</ul>
	      </li>
              <li><a href='test.php'>Notifications</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container">

      <div class="row">
        <span class="span6">
	  {{@SystemInfoWidget}}
	</span>
        <span class="span6" id="dashboard-memory">
	  {{@MemoryWidget}}
	</span>
      </div>

      <div class="row">	
        <span class="span12" id="dashboard-storage">
	  {{@StorageWidget}}
	</span>
      </div>

      <div class="row">
        <span class="span12" id="dashboard-traffic">
          {{@NetworkTrafficWidget}}
        </span>
      </div>

      <div class="row">
        <span class="span12" id="dashboard-network">
          <?php include('internals/functions/network.php'); ?>
        </span>
      </div>


      </div>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap-transition.js"></script>
    <script src="bootstrap/js/bootstrap-alert.js"></script>
    <script src="bootstrap/js/bootstrap-modal.js"></script>
    <script src="bootstrap/js/bootstrap-dropdown.js"></script>
    <script src="bootstrap/js/bootstrap-scrollspy.js"></script>
    <script src="bootstrap/js/bootstrap-tab.js"></script>
    <script src="bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="bootstrap/js/bootstrap-popover.js"></script>
    <script src="bootstrap/js/bootstrap-button.js"></script>
    <script src="bootstrap/js/bootstrap-collapse.js"></script>
    <script src="bootstrap/js/bootstrap-carousel.js"></script>
    <script src="bootstrap/js/bootstrap-typeahead.js"></script>

  </body>
</html>
