<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/isotope.js') }}"></script>
<script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('js/fancybox.js') }}"></script>
<script src="{{ asset('js/wow.js') }}"></script>
<script src="{{ asset('js/smooth-scrolling.js') }}"></script>
<script src="{{ asset('js/tooltipster.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery.filer.min.js') }}"></script>
<script src="{{ asset('js/progress-bar.js') }}"></script>
<script src="{{ asset('js/date-time-picker.js') }}"></script>
<script src="{{ asset('js/emojionearea.min.js') }}"></script>
<script src="{{ asset('js/animated-skills.js') }}"></script>

<script src="{{ asset('js/noty.min.js') }}"></script>
@if(app()->getLocale() == 'ar')
    <script src="{{ asset('js/main-rtl.js') }}"></script>
@else
    <script src="{{ asset('js/main.js') }}"></script>
@endif

<script>
    $(document).ready(function () {
        $("#notificationDropdownMenu, #notification-home").on('click', function () {
            if ($(".mess__body .notification-link").length > 0) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    cache: false,
                    type: 'GET',
                    url: "{{ route('teacher.notifications.mark_as_read') }}",
                    success: function () {
                        $("#notificationDropdownMenu .quantity").remove()
                    }
                });
            }
        });
    });

</script>

