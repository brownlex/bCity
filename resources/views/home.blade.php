@extends('layouts.app')

@section('content')
<link href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <br>
                    @if (!empty($successMsg))
                        <div class="alert alert-info"> {{ $successMsg }}</div>
                    @endif
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table">
                            <thead class=" text-dark">
                                <th scope="col" width="20%">
                                    Client Code
                                </th>
                                <th scope="col" width="30%">
                                    Contact Name
                                </th>
                                <th scope="col" width="30%">
                                    Contact Email
                                </th>
                                <th scope="col" width="20%">
                                  
                                </th>
                            </thead>
                        </table>
                        <script type="text/javascript">
                            $(function() {
                                $('#table').DataTable({
                                    processing: true,
                                    serverSide: true,
                                    ajax: '{{ route('home.dashboard') }}',
                                    columns: [{
                                            data: 'client_code',
                                            name: 'links.client_code'
                                        },
                                        {
                                            data: 'name',
                                            name: 'contacts.name'
                                        },
                                        {
                                            data: 'email',
                                            name: 'contacts.email'
                                        },
                                        {
                                            data: 'action',
                                            name: 'action',
                                            orderable: false,
                                            searchable: false
                                        }
                                    ]
                                });
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
           
        setTimeout(function() {
            $("div.alert").remove();
        }, 3000); // 5 secs
    
    
    </script>
</div>
@endsection
