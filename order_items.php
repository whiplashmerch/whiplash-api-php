<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Whiplash PHP Library</title>
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
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="bootstrap/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="bootstrap/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="bootstrap/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="bootstrap/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="bootstrap/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Whiplash PHP Library</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="index.php">Orders</a></li>
              <li><a href="items.php">Items</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

<h2>Your 5 most recent orders</h2>
<br />
<?php include 'whiplash_api.php';
// Substitute your own Whiplash API Key in the example below:

$api_key = 'mHzexQ996qtqqo2qx4Ls';
$api_version = ''; // OPTIONAL: Leave this blank to use the most recent API
$test = true; // OPTIONAL: If test is true, this will use your sandbox account

if ($api_key == ''){
	echo 'To get started, enter your Whiplash API Key into the source code of this page. <br /><br /> Once that\'s done, reload.';
}
else {
	$api = new WhiplashApi($api_key, $api_version, $test);
	
	// We just grab the last order, and use its order items as our example
	$orders = $api->get_orders(array('limit' => 1));
	foreach($orders as $order) {
	    foreach($order->order_items as $order_item){
				// initial quantity
				echo "<br />Item Quantity: $order_item->quantity";
				
				// Update it
				// Refresh the page you'll see the new quantity
				$api->update_order_item($order_item->id, array('quantity' => 2));
			}
			$items = $api->get_items(array('limit' => 1));
			foreach($items as $item) {
				$new_item = $api->create_order_item(array('quantity' => 1, 'item_id' => $item->id, 'order_id' => $order->id));
				print_r($new_item);
			}
	}

}
 ?>

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




