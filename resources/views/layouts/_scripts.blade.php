<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/isotope.js') }}"></script>
<script src="{{ asset('js/waypoint.min.js') }}"></script>
<script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('js/fancybox.js') }}"></script>
<script src="{{ asset('js/wow.js') }}"></script>
<script src="{{ asset('js/smooth-scrolling.js') }}"></script>
<script src="{{ asset('js/date-time-picker.js') }}"></script>
<script src="{{ asset('js/emojionearea.min.js') }}"></script>
<script src="{{ asset('js/jquery.filer.min.js') }}"></script>
<script src="{{ asset('js/tooltipster.bundle.min.js') }}"></script>
<script src="{{ asset('js/noty.min.js') }}"></script>
@if(app()->getLocale() == 'ar')
    <script src="{{ asset('js/main-rtl.js') }}"></script>
@else
    <script src="{{ asset('js/main.js') }}"></script>
@endif

<script>
    $(document).ready(function () {
        $('#search_input').on('keyup', debounce(function (e) {
            let lang = $("html").attr('lang');
            let searchValue = $(this).val().trim();
            var ul = $('.live_search_results'),
                loader = $('.search-loader').parent();
            if (searchValue.length > 0) {
                ul.show();
                loader.show();
            } else {
                ul.hide();
                loader.hide();
            }
            $.ajax({
                url: "{{ route('courses.live_search') }}",
                type: "get",
                data: {
                    search: searchValue,
                },
                beforeSend: function () {
                    ul.empty();
                    loader.show();
                },
                complete: function () {
                    loader.hide();
                },
                success: function (response) {
                    if (response.data && response.data.length > 0) {
                        ul.empty();
                        $.each(response.data, function (index, course) {
                            ul.append(`
                                <li>
                                    <a href="http://elearning.test/${lang}/courses/${course.slug}" class="cart-link">
                                        <img src="${course.image}" alt="${course.title}">
                                    </a>
                                    <p class="cart-info {{ app()->getLocale() == 'ar' ? 'text-left ml-3' : '' }}">
                                        <a href="http://elearning.test/${lang}/courses/${course.slug}">
                                            ${course.title}
                                        </a>
                                        <br>
                                        <span class="cart__price">${course.price} @lang('site.le')</span>
                                    </p>
                                </li>
                            `);
                        });
                    } else {
                        ul.empty();
                        ul.append(`<li class="mt-3">@lang('site.no_results')</li>`);
                    }
                },
                error: function (xhr) {
                    console.log(xhr);
                }
            });
        }, 500));

        function debounce(fn, time) {
            let timeout;
            return function (args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => fn.apply(this, args), time);
            }
        }
    });
</script>

<script>
    $('.breadcrumb-area').css("backgroundImage", "url('{{ setting('breadcrumb_picture') ? asset(setting('breadcrumb_picture')) : asset('images/breadcrumb-bg.jpg') }}')")

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
                    url: "{{ route('notifications.mark_as_read') }}",
                    success: function () {
                        $("#notificationDropdownMenu .quantity").remove()
                    }
                });
            }
        });
    });


</script>
