<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New ☕️ Product Sales') }}
        </h2>
    </x-slot>

    <div class="container ">
        <div class="row justify-content-center my-4 p-3 mb-5">
            <div class="col-md-8">
                <div class="card shadow  bg-body rounded">
                    <div class="card-header">{{ __('Add') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/coffe-product-sales-addAction') }}" id="form-login">
                            @csrf
                            <div class="row mb-3">
                                <label for="product_name" class="col-md-4 col-form-label text-md-end">{{ __('Product') }}</label>

                                <div class="col-md-6">
                                    <select class="form-select" name="product_name" id="product_name" aria-label="Default select example">
                                        <option value="" selected>Open this select menu</option>
                                        <option value="Gold Coffe">Gold Coffe</option>
                                        <option value="Arabic Coffe">Arabic Coffe</option>
                                    </select>
                                    <span id="product_name_err">
                                        @error('product_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="shipment" class="col-md-4 col-form-label text-md-end">{{ __('Quantity') }}</label>

                                <div class="col-md-6">
                                    <input id="quantity" type="text" class="form-control" name="quantity" value="{{ old('quantity') }}" autocomplete="quantity" autofocus>
                                    <span id="quantity_err">
                                        @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="shipment" class="col-md-4 col-form-label text-md-end">{{ __('Unit Cost') }}</label>

                                <div class="col-md-6">
                                    <input id="unit_cost" type="text" class="form-control" name="unit_cost" value="{{ old('unit_cost') }}" autocomplete="unit_cost" autofocus>
                                    <span id="unit_cost_err">
                                        @error('unit_cost')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-danger login">
                                        {{ __('Add') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="module" src="{{ asset('js/coffe_product_sales.js') }}"></script>

</x-app-layout>