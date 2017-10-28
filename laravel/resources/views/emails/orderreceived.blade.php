<h1>
  Lugnutz Computer Parts has received your order:
</h1>
<h2>
  Total: ${{ $order->getTotal() }}
</h2>
<p>
  Items Purchased
</p>

<table>
  <thead>
    <tr>
      <th>Item</th>
      <th>Price</th>
      <th>Quantity</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($order->orderDetails as $od)
      <tr>
        <td>{{ $od->product->productName }}</td>
        <td>{{ $od->priceEach }}</td>
        <td>{{ $od->quantityOrdered }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
