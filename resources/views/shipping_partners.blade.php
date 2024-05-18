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
                    <div class="card-header">

                        <a class="text-left" href="{{ url('/shipping-cost-add') }}"> <button class="btn btn-primary">Add</button></a>

                    </div>

                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>
                                    SNo
                                </th>
                                <th>
                                    Shipping Cost
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>

                                    Action
                                </th>
                            </tr>
                            @php $i = 1;

                            @endphp


                            @foreach($data as $key=>$value)
                            @if ($value["status"] == "Active")
                            @php $status = "btn btn-success";
                            $status1 = 'Active';
                            @endphp
                            @else
                            @php
                            $status = "btn btn-danger";
                            $status1 = 'InActive';
                            @endphp
                            @endif
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $value['shipment_cost']}}</td>
                                <td>
                                    <button class="{{ $status }}" onclick="shippingChangeStatus('<?php echo $value['status'] ?>','<?php echo $value['id'] ?>')">{{ $status1 }}</button>
                                </td>

                                <td>
                                    <a class="" href="{{ url('/shipping-cost-edit') }}/{{ $value['id'] }}"> <button class="btn btn-primary">Edit</button></a>
                                    <button class="btn btn-danger delete_cost" data-id="{{ $value['id'] }}">Delete</button>

                                </td>
                            </tr>
                            @php $i++ @endphp
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <script>
        function userChangeStatus(status_code, id) {
            alert("");
            var table = "state";

            Swal.fire({
                title: "Are you sure?",
                text: "",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, change it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: siteUrl + "",
                        data: {
                            status_code: status_code,
                            id: id,
                            table: table,
                        },
                        cache: false,
                        type: "POST",
                        success: function(result) {
                            var obj = jQuery.parseJSON(result);
                            if (obj.status == "1") {
                                toastr.success(obj.message);

                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                toastr.error(obj.message);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            // alert('Error at add data');
                        },
                    });
                }
            });
        }
    </script> -->
    <script>
        var updateUrl = "{{ url('shipping-cost-changeStatus') }}";
        var deleteUrl = "{{ url('shipping-cost-delete') }}";
    </script>
    <script src="{{ asset('js/shipping_partners.js') }}"></script>
</x-app-layout>