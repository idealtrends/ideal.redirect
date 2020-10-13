@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">{{ __('Dashboard') }} <a href="{{ route('redirects.create') }}" class="btn btn-primary">New redirect</a></div>

                <div class="card-body">
                    @if(count($redirects))
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Country</th>
                                <th scope="col">Country code</th>
                                <th scope="col">Url</th>
                                <th scope="col">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($redirects as $redirect)
                                <tr>
                                    <th scope="row">{{ $redirect->id }}</th>
                                    <td>{{ $redirect->country()->first()->name }}</td>
                                    <td>{{ $redirect->country()->first()->alpha_code2 }}</td>
                                    <td>{{ $redirect->url }}</td>
                                    <td>
                                        <a href="{{ route('redirects.edit', $redirect->id) }}">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <span>You don't have any redirect. Create one <a href="{{ route('redirects.create') }}">here</a>.</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
