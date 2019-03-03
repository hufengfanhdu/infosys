@foreach(['info','danger','success','warning'] as $msg)
    @if(session()->has($msg))
        <div class="alert alert-{{ $msg }} @yield('msg_wide','w-auto') mx-auto" role="alert">
            {{ session()->get($msg) }}
        </div>
    @endif
@endforeach