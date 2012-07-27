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
	echo "<br /><br />"
}
```

Update an order:
```
$order = $api->update_order(ORDER ID, array('shipping_address_1' => 'NEW STREET ADDRESS'));
```

Create an order item:
```
$api->create_order_item(array('quantity' => 1, 'item_id' => ITEM ID, 'order_id' => ORDER ID));
```

Update an order item:
```
$api->update_order_item(ORDER ITEM ID, array('quantity' => NEW QUANTITY));
``

Delete an order item:
```
$api->delete_order_item(ORDER ITEM ID);
```

Create an item:
```
$item = $api->create_item(array('sku' => 'YOUR ITEM SKU', 'title' => 'YOUR ITEM TITLE'));
print_r($item);
```

