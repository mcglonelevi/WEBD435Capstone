<h1>
  Lugnutz Computer Parts has received your order:
</h1>
<h2>
  Total: ${{ number_format($order->getTotal(), 2) }}
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
        <td>{{ number_format($od->priceEach, 2) }}</td>
        <td>{{ $od->quantityOrdered }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
