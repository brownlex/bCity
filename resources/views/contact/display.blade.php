@extends('layouts.app')

@section('content')
<link href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Contacts') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table">
                            <thead class=" text-dark">
                                <th scope="col" width="10%">
                                    Id#
                                </th>
                                <th scope="col" width="20%">
                                    Name
                                </th>
                                <th scope="col" width="20%">
                                    Surname
                                </th>
                                <th scope="col" width="30%">
                                    Email
                                </th>
                                <th scope="col" width="20%">
                                    Created Date
                                </th>
                            </thead>
                        </table>
                        <script type="text/javascript">
                            $(function() {
                                $('#table').DataTable({
                                    processing: true,
                                    serverSide: true,
                                    ajax: '{{ route('contacts.queue') }}',
                                    columns: [{
                                            data: 'id',
                                            name: 'id'
                                        },
                                        {
                                            data: 'name',
                                            name: 'name'
                                        },
                                        {
                                            data: 'surname',
                                            name: 'surname'
                                        },
                                        {
                                            data: 'email',
                                            name: 'email'
                                        },

                                        {
                                            data: 'created_at',
                                            name: 'created_at'
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
</div>
@endsection
