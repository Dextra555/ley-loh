@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'typography'
])

@section('content')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ route('updateStatus') }}">
                @csrf
                <table id="myTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>User Id</th>
                            <th>Name</th>
                            <th>Mobile Number</th>
                            <th>Mail</th>
                            <th>Location</th>
                            <th>Industry Type</th>
                            <th>Action</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendor as $vendors)
                        <tr>
                            <td>{{ $vendors->id }}</td>
                            <td>{{ $vendors->username }}</td>
                            <td>{{ $vendors->mobile_number }}</td>
                            <td>{{ $vendors->email }}</td>
                            <td>{{ $vendors->location }}</td>
                            <td>{{ $vendors->industry_type }}</td>
                            <td>
                                <select name="action[{{ $vendors->id }}]" class="statusSelect" data-vendorid="{{ $vendors->id }}">
                                    <option value="Active" {{ $vendors->status === 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Decline" {{ $vendors->status === 'Decline' ? 'selected' : '' }}>Decline</option>
                                </select>
                            </td>
                            <td>{{ $vendors->created_at }}</td>
                            <td>{{ $vendors->updated_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {
        $('#myTable').DataTable();
    });

    $(document).ready(function() {
        $(document).on('change', '.statusSelect', function() {
            var statusSelect = $(this).val();
            var vendorId = $(this).data('vendorid'); // Retrieve the vendor ID from the data-vendorid attribute

            $.ajax({
                type: "POST",
                url: "{{ route('updateStatus') }}",
                data: {
                    status: statusSelect,
                    vendorId: vendorId
                },
                success: function(response) {
                    var jsonResponse = JSON.parse(response);
                    if (jsonResponse.success) {
                        alert("Status updated successfully");
                    } else {
                        alert("Failed to update status");
                    }
                },
                error: function(err) {
                    alert("An error occurred");
                }
            });
        });
    });
</script>

@endsection
