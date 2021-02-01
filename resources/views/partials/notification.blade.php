{{-- Toastr Notifiche - da includere, quando serve nella section('js_scripts') --}}
<link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
<script>
    @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @endif


    @if(Session::has('info'))
        toastr.info("{{ Session::get('info') }}");
    @endif


    @if(Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}");
    @endif


    @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
    @endif
  </script>
