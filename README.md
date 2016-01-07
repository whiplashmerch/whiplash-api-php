Whiplash relies on 3 tables for the majority of calls: Items, Orders, and Order Items. Items are specific inventory items, Orders are requests for a shipment to be sent, and Order Items are what that order should contain.

Use of the Whiplash PHP API is very simple. Just include the `whiplash_api.php` file:

```
include 'whiplash_api.php';
```

Initialize it with your Whiplash API key:

```
$api = new WhiplashApi('YOUR API KEY', API VERSION (optional), TEST (optional));
````

And make requests like so:

Get all items on your account:
```
$out = $api->get_items();
foreach($out as $item) {
	echo $item->id;
	echo "<br />";
	print_r($item);
	echo "<br /><br />";
}
```

Update an order:
```
$order = $api->update_order(ORDER_ID, array('shipping_address_1' => 'NEW STREET ADDRESS'));
```

Create an order item:
```
$api->create_order_item(array('quantity' => 1, 'item_id' => ITEM_ID, 'order_id' => ORDER_ID));
```

Update an order item:
```
$api->update_order_item(ORDER_ITEM_ID, array('quantity' => NEW QUANTITY));
```

Delete an order item:
```
$api->delete_order_item(ORDER_ITEM_ID);
```

Create an item:
```
$item = $api->create_item(array('sku' => 'YOUR ITEM SKU', 'title' => 'YOUR ITEM TITLE'));
```

Find items by SKU (NOTE: since multiple items may have the same SKU, this returns an array):
```
$api->get_items_by_sku(ITEM_SKU);
```

Find an order by its ID in your store:
```
$api->get_order_by_originator(YOUR_ORDER_ID);
```

Get the total number of orders in your store, since 123, going to the US:
```
$api->get_orders_count(array('shipping_country' => 'US', 'since_id' => 123));
```

More examples are available in the `examples` folder.

