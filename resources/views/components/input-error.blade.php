@props(['messages'])

@if ($messages)
    <div class="alert alert-danger d-flex align-items-center" role="alert" style="color: #571111">
        <i class="sidenav-icon feather icon-x"></i>
        @foreach ((array) $messages as $message)
            <div>{{ $message }}</div>
        @endforeach
    </div>
@endif
