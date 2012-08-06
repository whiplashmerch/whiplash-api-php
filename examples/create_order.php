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
              <li><a href="order_items.php">Order Items</a></li>
              <li><a href="items.php">Items</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

<h2>Creating Orders</h2>
Each time this page is loaded, a new order will be created with an example item.
<br /><br />
<?php include 'whiplash_api.php';

// Substitute your own Whiplash API Key in the example below:

$api_key = 'Hc2BHTn3bcrwyPooyYTP'; // Whiplash sandbox Key
$api_version = ''; // OPTIONAL: Leave this blank to use the most recent API
$test = true; // OPTIONAL: If test is true, this will use your sandbox account

if ($api_key == ''){
	echo 'To get started, enter your Whiplash API Key into the source code of this page. <br /><br /> Once that\'s done, reload.';
}
else {
	// There are two ways to create an order
	// 1) Create the order first, then create order items individually (multiple API calls)
	// 2) Create the order with all of its items (one API call)

	$api = new WhiplashApi($api_key, $api_version, $test);

	// // Method #1
	// $order = $api->create_order(array(
	// 	'shipping_name' => 'John Doe',
	// 	'shipping_address_1' => '1 Infinite Loop',
	// 	'shipping_address_2' => 'APT 6',
	// 	'shipping_city' => 'Ann Arbor',
	// 	'shipping_state' => 'MI',
	// 	'shipping_zip' => '48108',
	// 	'email' => 'john@doe.com'
	// ));
	// 
	// $items = $api->get_items(array('limit' => 1));
	// foreach($items as $item) {
	// 	$new_item = $api->create_order_item(array('quantity' => 1, 'item_id' => $item->id, 'order_id' => $order->id));
	// }

	// Method #2
	$order_attributes = array(
		'shipping_name' => 'John Doe',
		'shipping_address_1' => '1 Infinite Loop',
		'shipping_address_2' => 'APT 6',
		'shipping_city' => 'Ann Arbor',
		'shipping_state' => 'MI',
		'shipping_zip' => '48108',
		'email' => 'john@doe.com',
		'order_items_attributes' => array()
	);

	$items = $api->get_items(array('limit' => 1));
	$i = 0;
	foreach($items as $item) {
		$order_attributes['order_items_attributes'][$i] = array('quantity' => 1, 'item_id' => $item->id);
		$i += 1;
	}	

	$order = $api->create_order($order_attributes);	
		
	echo "<p>";
	echo "#";
	echo $order->id;
	echo "<span class='help-block'>This is the ID of your newly created order.</span>";
	echo "<br /><strong>";
	echo $order->shipping_name;
	echo "</strong><br />";
	echo $order->shipping_address_1;
	echo "<br />";
	if ($order->shipping_address_2 != "") {
	echo $order->shipping_address_2;
	echo "<br />";}
	echo $order->shipping_city;
	echo ", ";
	echo $order->shipping_state;
	echo " ";
	echo $order->shipping_zip;
    echo "<br />";
	echo $order->email;
    echo "<br />";
    echo "</p>";
    	// Shipped orders contain packaging materials as order_items, for the purposes of the exercise, don't display them.
	foreach($order->order_items as $order_item) {
    if ($order_item->packaging != 1) {
    	echo $order_item->quantity;
    	echo " x ";
    	echo $order_item->description;
    	echo "<br />";
		}
    	// You can print the raw contents of an object to see its attributes
    	// print_r($order_item);
    
    echo "<hr />";
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




