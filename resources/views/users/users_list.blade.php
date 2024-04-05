@extends('layouts.app', [
'class' => '',
'elementActive' => 'typography'
])

@section('content')

<div class="content">
        <div class="row">
            <div class="col-md-12">
                <table id="myTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>User Id</th>
                            <th>Name</th>
                            <th>Mobile Number</th>
                            <th>Mail</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td name="userId" class="userId" data-userid="{{ $user->id }}">{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->mobile_number }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->location }}</td>
                            <td><select id="statusSelect">
                                    <option value="Active" {{ $user->status === 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Decline" {{ $user->status === 'Decline' ? 'selected' : '' }}>Decline</option>
                            </select>
                            </td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    jQuery(document).ready(function($) {
        $('#myTable').DataTable();
    });



    $(document).ready(function() {
        $(document).on('change', '#statusSelect', function() {

            var statusSelect = $(this).val(); 
            var userId = $(this).closest('tr').find('.userId').data('userid'); 

            $.ajax({
                type: "POST", 
                url: "{{route('storeStatus')}}", 
                data: {
                    status: statusSelect, 
                    userId: userId, 
                   _token: '{{ csrf_token() }}'

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
                    alert("err"); 
                }
            });
        });
    });
    </script>

@endsection