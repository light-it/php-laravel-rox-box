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

                            <!-- Customer Name -->
                            <div class="form-group row">
                                <label for="customer_name" class="col-md-4 col-form-label text-md-left">
                                    {{ __('Customer Name') }}*
                                </label>
                                <div class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
                                            id="customer_name" name="customer_name" minlength="1" maxlength="64" required
                                            value="{{ old('customer_name') }}" placeholder="{{ __('Customer Name') }}" />
                                    </div>
                                    @error('customer_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Customer Phone -->
                            <div class="form-group row">
                                <label for="customer_phone" class="col-md-4 col-form-label text-md-left">
                                    {{ __('Phone') }}*
                                </label>
                                <div class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="text" class="form-control @error('customer_phone') is-invalid @enderror"
                                            id="customer_phone" name="customer_phone" minlength="1" maxlength="15" required
                                            value="{{ old('customer_phone') }}" placeholder="{{ __('Phone') }}" />
                                    </div>
                                    @error('customer_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Date -->
                            <div class="form-group row">
                                <label for="date" class="col-md-4 col-form-label text-md-left">
                                    {{ __('Workshop Date') }}*
                                </label>
                                <div class="col-md-6">
                                    <div class="form-group input-group">
                                        <select class="custom-select form-control @error('date') is-invalid @enderror"
                                            id="date" name="date" required>
                                            @foreach ($schedule as $date => $item)
                                                <option value="{{ $date }}"
                                                    {{ $date === old('date') ? 'selected' : '' }}>
                                                    {{ $item['title'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Time -->
                            <div class="form-group row">
                                <label for="time" class="col-md-4 col-form-label text-md-left">
                                    {{ __('Workshop Time') }}*
                                </label>
                                <div class="col-md-6">
                                    <div class="form-group input-group">
                                        <select class="custom-select form-control @error('time') is-invalid @enderror"
                                            id="time" name="time" required>
                                        </select>
                                    </div>
                                    @error('time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <hr data-section="buttons" />

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-success pull-right">
                                        {{ __('Book Workshop') }}
                                    </button>
                                    <a class="btn btn-primary mr-1 pull-right"
                                        href="#" data-section="add_guest">
                                        {{ __('Add a guest') }}
                                    </a>
                                    <input type="hidden" name="qty_guests" value="0" />
                                </div>
                            </div>

                            <script type="application/javascript">
                                var SCHEDULE = {!! json_encode($schedule) !!};
                                var CUSTOMERS = {!! json_encode($customers) !!};
                            </script>

                        </form>

                        <div data-section="add_guest" class="hide">
                            @include('booking.inc.guest')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
