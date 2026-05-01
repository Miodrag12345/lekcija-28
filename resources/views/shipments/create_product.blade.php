<form method="POST" action="/products/create">
    @csrf
    <input type="text" name="name" placeholder="Naziv">
    <input type="text" name="price" placeholder="Cena">
    <input type="text" name="sku" placeholder="SKU">
    <button type="submit">Dodaj</button>
</form>
