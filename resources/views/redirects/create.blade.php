@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">{{ __('Dashboard') }} <a href="{{ route('redirects.index') }}" class="btn btn-primary">Redirects</a></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('redirects.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputCountry">Country</label>
                                <select id="inputCountry" class="form-control" name="country" required>
                                    <option selected value="">Choose...</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="inputUrl">Url to redirect</label>
                                <input type="text" class="form-control" id="inputUrl" name="url" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
