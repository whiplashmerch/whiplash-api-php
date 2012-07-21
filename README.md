Use of the Whiplash PHP API is very simple. Just include the `whiplash_api.php` file:

```
include 'whiplash_api.php';
```

Initialize it with your Whiplash API key:

```
$api = new WhiplashApi('YOUR API KEY');
````

And make requests like so:

(get all items on your account)
```
$out = $api->get_items();
foreach($out as $item) {
	echo $item->id;
	echo "<br />";
}
```

(update an order)
```
$item = $api->update_order(1234, array('shipping_address1' => '123 awesome st.'));
```

(create an item)
```
$item = $api->create_item(array('sku' => 'ITEM XXX', 'title' => 'Awesome Item'));
print_r($item);
```

(delete an order item)
```
$item = $api->delete_order_item_(1234);
```