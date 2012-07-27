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
$order = $api->update_order(1234, array('shipping_address1' => '123 awesome st.'));
```

Create an item:
```
$item = $api->create_item(array('sku' => 'YOUR ITEM SKU', 'title' => 'Awesome Item'));
print_r($item);
```

Delete an order item:
```
$item = $api->delete_order_item_(1234);
```