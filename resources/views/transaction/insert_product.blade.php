<x-table-row>
    {{-- {{ dd($product) }} --}}
    <td class="table-light">
        {{ $product->product_name }}
        <input type="hidden" name="product_id[]" value="{{ $product->product }}">
    </td>
    <td class="table-light">
        {{ $product->qty }}
        <input type="hidden" name="qty_product[]" value="{{ $product->qty }}">
    </td>
    <td class="table-light">
        {{ number_format($product->price, 0, '.', '.') }}
        <input type="hidden" name="price_product[]" value="{{ $product->price }}">
        <input type="hidden" name="purchase_price_product[]" id="purchase_price_product"
            value="{{ $product->purchase_price * $product->qty }}">
    </td>
    <td class="table-light">
        {{ number_format($product->price * $product->qty, 0, '.', '.') }}
        <input type="hidden" name="total[]" id="total_price" value="{{ $product->price * $product->qty }}">
    </td>
    <td class="table-light">
        <x-button-delete-table onclick="removeProduct(this)" />
    </td>
</x-table-row>
