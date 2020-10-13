@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">{{ __('Dashboard') }} <a href="{{ route('redirects.index') }}" class="btn btn-primary">Redirects</a></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('redirects.update', $redirect->id) }}">
                        @csrf
                        @method('patch')
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputCountry">Country</label>
                                <select id="inputCountry" class="form-control" name="country">
                                    <option value="">Choose...</option>
                                    @foreach($countries as $country)
                                        <option {{ $country->id == $redirect->country_id ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="inputUrl">Url to redirect</label>
                                <input type="text" class="form-control" id="inputUrl" name="url" value="{{ $redirect->url }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-danger" href="{{ route('redirects.destroy', $redirect->id) }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('redirectsDelete').submit();">
                            Delete
                        </a>
                    </form>


                    <form id="redirectsDelete" action="{{ route('redirects.destroy', $redirect->id) }}" method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
