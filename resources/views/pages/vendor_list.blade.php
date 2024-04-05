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
                            <th>Industry Type</th>
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
                            <td>{{ $vendors->created_at }}</td>
                            <td>{{ $vendors->updated_at }}</td>
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
    </script>

@endsection