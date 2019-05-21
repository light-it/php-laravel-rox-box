@extends('layouts.app')

@section('pagespecificscripts')
    <script src="{{ asset('/js/booking.js') }}" defer></script>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">{{ __('Please, fill out the form') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('booking.store') }}">
                            @csrf

                            <!-- Date -->
                            <div class="form-group row">
                                <label for="date" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Date') }}*
                                </label>
                                <div class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="text" class="form-control @error('date') is-invalid @enderror"
                                            id="datepicker" name="date" data-field-type="date" autocomplete="off" required
                                            value="{{ old('date') }}" placeholder="{{ __('Date') }}" />
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary pull-right">
                                        {{ __('Book Workshop') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
