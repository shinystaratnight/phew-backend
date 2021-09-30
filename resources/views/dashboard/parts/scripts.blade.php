<!-- Core JS files -->
    <script src="https://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/main/jquery.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/main/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/loaders/blockui.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/ui/ripple.min.js"></script>
    <script src="{{ asset('assets/global/js/plugins/notifications/jgrowl.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/plugins/notifications/noty.min.js') }}"></script>
    
@yield('file_scripts')
@if(app()->getLocale() == 'ar')
    <script src="{{ asset('assets/RTL') }}/js/app.js"></script>
@else
    <script src="{{ asset('assets/LTR') }}/js/app.js"></script>
@endif
<script src="{{ asset('assets/global') }}/js/clock.js"></script>
{{--  {{ dd(trans('dash.months')) }}  --}}
<script>
$(function(){
    clock({!! json_encode(trans('dash.months')) !!}, {!! json_encode(trans('dash.days')) !!});
});
$(window).on("load", function () {
    $(".loading").delay(600).fadeOut('slow',function(){
        $('.loading-page').css('opacity', '1');
    });
});

// Notifucation
Noty.overrideDefaults({
    theme: 'limitless',
    layout: 'topLeft'
});
</script>

    <script>
        window.Laravel = {!! json_encode([
            'user' => auth()->user(),
        ]) !!};
    </script>
    <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

@yield('custom_scripts')

<script>
    $(function(){
        $('form').on('submit', function(event) {
            event.preventDefault();
            // $('.submit_form_btn').attr("disabled", true);
            $(this).find(':input[type=submit]').attr("disabled", true);
            this.submit(); //now submit the form
        });
    });
</script>