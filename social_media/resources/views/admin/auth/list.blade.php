@extends('admin.layouts.app')

@push('style')
    <link href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
@endpush


@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Datatable</h4>
                        <ol class="breadcrumb">
                            <li>
                                <a href="#">Ubold</a>
                            </li>
                            <li>
                                <a href="#">Tables</a>
                            </li>
                            <li class="active">
                                Datatable
                            </li>
                        </ol>
                    </div>
                </div>



                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id : </th>
                                        <th>First Name : </th>
                                        <th>last Name : </th>
                                        <th>Profile Image : </th>
                                        <th>Mobile : </th>
                                        <th>Gender : </th>
                                        <th>Status : </th>
                                        <th>Action : </th>
                                    </tr>
                                </thead>

                                <tbody></tbody>

                            </table>
                        </div>
                    </div>
                </div>


            </div> <!-- container -->

        </div> <!-- content -->

        <footer class="footer">
            2015 © Ubold.
        </footer>

    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // $('#datatable').dataTable();

            $table = $('#datatable').dataTable({
                'ordering': true,
                'searching': true,
                'processing': true,
                'serverSide': true,
                'pageLength': 10,
                'aaSorting': [
                    [0, 'desc']
                ],
                'ajax': {
                    url: "{{route('admin.get_user_list')}}"
                    // data: function(data) {
                    //     data.keyword = $('#keyword').val();
                    // }
                },
                "columns": [
                    {data: 'id'},
                    { data: 'first_name'},
                    { data: 'last_name'},
                    {
                        // Use the 'render' function to display the image in an 'img' tag
                        data: 'profile_image',
                        render: function(data, type, row) {
                            // 'data' contains the value of 'profile_image' for the current row
                            // 'type' specifies whether it's for display or sorting, we only need 'display'
                            if (type === 'display') {
                                // You can construct the 'img' tag with the 'data' value
                                var imageUrl = '{{ asset("uploads/profile_image/") }}' + '/' + data;
                                return '<img src="' + imageUrl + '" alt="Profile Image" width="50" height="50">';
                            }
                            // For other types (e.g., 'sort', 'filter'), return the data as is
                            return data;
                        }
                    },
                    { data: 'phone'},
                    { data: 'gender'},
                    { data: 'status'},
                    { data: 'action'},
                ]
            })
        });
    </script>
@endpush
