<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(' ☕️ Product Sales ') }}
        </h2>
    </x-slot>

    <div class="container ">
        <div class="row justify-content-center my-4 p-3 mb-5">
            <div class="col-md-8">
                <div class="card shadow  bg-body rounded">
                    <div class="card-header">
                        <a class="text-left" href="{{ url('/coffe-product-sales-add') }}"> <button class="btn btn-primary">Add</button></a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>
                                    SNo
                                </th>
                                <th>
                                    Product
                                </th>
                                <th>
                                    Quantity
                                </th>
                                <th>
                                    Unit Cost
                                </th>
                                <th>

                                    Selling Price </th>
                                <th>

                                    Sold At </th>
                            </tr>
                            @php $i = 1;

                            @endphp


                            @foreach($data as $key=>$value)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $value['product_name']}}</td>

                                <td>{{ $value['quantity']}}</td>
                                <td>&#163;{{ $value['unit_cost']}}</td>
                                <td>&#163;{{ $value['selling_price']}}</td>
                                <td>{{ $value['created_at']}}</td>

                            </tr>
                            @php $i++ @endphp
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="module" src="{{ asset('js/coffe_product_sales.js') }}"></script>

</x-app-layout>