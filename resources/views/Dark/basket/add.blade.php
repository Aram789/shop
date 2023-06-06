<div class="col-md-6">
    <p>Цена: {{ number_format($product->price, 2, '.', '') }}</p>
    <!-- Форма для добавления товара в корзину -->
    <form action="{{ route('basket.add', ['id' => $product->id]) }}"
          method="post" class="form-inline">
        @csrf
        <label for="input-quantity">Количество</label>
        <input type="text" name="quantity" id="input-quantity" value="1"
               class="form-control mx-2 w-25">
        <button type="submit" class="btn btn-success">Добавить в корзину</button>
    </form>
</div>
