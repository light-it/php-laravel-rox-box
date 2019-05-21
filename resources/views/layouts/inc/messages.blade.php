<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @if (session()->has('success'))
                <div class="alert alert-success">
                    @php
                        $success = session()->get('success');
                        if (is_array($success)) {
                            $message = implode('<br />', $success);
                        } else {
                            $message = $success;
                        }
                    @endphp
                    {!! $message !!}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger">
                    @php
                        $error = session()->get('error');
                        if (is_array($error)) {
                            $message = implode('<br />', $error);
                        } else {
                            $message = $error;
                        }
                    @endphp
                    {!! $message !!}
                </div>
            @endif

            @include('layouts.inc.error')

        </div>
    </div>
</div>
