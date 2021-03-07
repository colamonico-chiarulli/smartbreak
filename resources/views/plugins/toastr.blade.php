@push('css')
    <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
@endpush

@push('js')
    <script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
    <script>
        toastr.options.showMethod = 'slideDown';
        toastr.options.hideMethod = 'slideUp';
        toastr.options.closeMethod = 'slideUp';

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
@endpush
