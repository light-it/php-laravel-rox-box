<hr />

<!-- Guest Name -->
<div class="form-group row">
    <label for="guest_name" class="col-md-4 col-form-label text-md-left">
        {{ __('Guest Name') }}*
    </label>
    <div class="col-md-6">
        <div class="form-group input-group">
            <input type="text" class="form-control @error('guest_name') is-invalid @enderror"
                id="guest_name" name="guest[][name]" minlength="1" maxlength="64" required
                value="{{ old('guest_name') }}" placeholder="{{ __('Guest Name') }}" />
        </div>
        @error('guest_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<!-- Guest Email -->
<div class="form-group row">
    <label for="guest_email" class="col-md-4 col-form-label text-md-left">
        {{ __('Email') }}*
    </label>
    <div class="col-md-6">
        <div class="form-group input-group">
            <input type="email" class="form-control @error('guest_email') is-invalid @enderror"
                id="guest_email" name="guest[][email]" minlength="1" maxlength="320" required
                value="{{ old('guest_email') }}" placeholder="{{ __('Email') }}" />
        </div>
        @error('guest_email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row mb-0">
    <div class="col-md-8 offset-md-4">
        <a class="btn btn-danger mr-1 pull-right"
            href="#" data-section="remove_guest">
            {{ __('Remove') }}
        </a>
    </div>
</div>
