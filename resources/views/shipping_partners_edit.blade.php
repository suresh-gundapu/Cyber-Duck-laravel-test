<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Set new shipment cost 🚚') }}
        </h2>
    </x-slot>

    <div class="container ">
        <div class="row justify-content-center my-4 p-3 mb-5">
            <div class="col-md-8">
                <div class="card shadow  bg-body rounded">
                    <div class="card-header">{{ __('Edit') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/shipping-cost-edit-action') }}" id="form-login">
                            @csrf
                            <input type="hidden" value="{{ $data->id }}" name="id" />

                            <div class="row mb-3">
                                <label for="shipment" class="col-md-4 col-form-label text-md-end">{{ __('Shipment Cost') }}</label>

                                <div class="col-md-6">
                                    <input id="shipment" type="text" class="form-control" name="shipment_cost" value="{{ old('shipment_cost' , $data->shipment_cost) }}" autocomplete=" shipment_cost" autofocus>
                                    <span id="shipment_cost_err">
                                        @error('shipment_cost')
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
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="module" src="{{ asset('js/shipping_partners.js') }}"></script>
</x-app-layout>