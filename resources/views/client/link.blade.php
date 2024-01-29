@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Link Client to Contact') }}</div>

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
                        <form method="POST" action="{{ route('links.store') }}">
                            @csrf
    
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Client Code') }}</label>
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('client') ? ' has-danger' : '' }}">
                                        <select
                                            class="form-control{{ $errors->has('client') ? ' is-invalid' : '' }}"
                                            data-style="btn btn-link" name="client" id="input-client"  required>
                                        <option value="{{ $client->client_code }}">{{ $client->client_code}}</option>
                                               
                                        </select>
                                        @if ($errors->has('client'))
                                            <span id="contact-error" class="error text-danger"
                                                for="input-client">{{ $errors->first('client') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Contact') }}</label>
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('contact') ? ' has-danger' : '' }}">
                                        <select
                                            class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}"
                                            data-style="btn btn-link" name="contact" id="input-contact" required>
                                        <option value=""></option>
                                                @foreach ($contact as $contact)
                                                    <option value="{{ $contact->id }}">{{ $contact->email}}</option>
                                                @endforeach
                                           
                                        </select>
                                        @if ($errors->has('contact'))
                                            <span id="contact-error" class="error text-danger"
                                                for="input-contact">{{ $errors->first('contact') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                   
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
