@extends('layouts.teacher.app')
@section('title', setting('website_name') . ' Course Quizzes')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-lg-6 column-lmd-2-half column-md-2-full">
                    <div class="icon-box d-flex align-items-center">
                        <div class="icon-element icon-element-bg-1 flex-shrink-0">
                            <i class="la la-check-circle"></i>
                        </div><!-- end icon-element-->
                        <div class="info-content">
                            <h4 class="info__title mb-2">@lang('site.passed_students')</h4>
                            <span class="info__count">{{ $passed_students }}</span>
                        </div><!-- end info-content -->
                    </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6 column-lmd-2-half column-md-2-full">
                    <div class="icon-box d-flex align-items-center">
                        <div class="icon-element icon-element-bg-7 flex-shrink-0">
                            <i class="la la-times-circle"></i>
                        </div><!-- end icon-element-->
                        <div class="info-content">
                            <h4 class="info__title mb-2">@lang('site.failed_students')</h4>
                            <span class="info__count">{{ $failed_students }}</span>
                        </div><!-- end info-content -->
                    </div>
                </div><!-- end col-lg-6 -->
            </div>
            <div class="row">
                <div class="col-lg-4 column-lmd-2-half column-md-full">
                    <div class="chart-item">
                        <div class="chart-headline margin-bottom-40px">
                            <h3 class="widget-title font-size-18">@lang('site.attendance_ratios')</h3>
                        </div>
                        <canvas id="doughnut-chart"></canvas>
                        <div class="chart-legend text-center margin-top-40px">
                            <ul>
                                <li><span class="legend__bg legend__bg-1"></span>@lang('site.number_of_attendees')</li>
                                <li><span class="legend__bg legend__bg-2"></span>@lang('site.number_of_absence')</li>
                            </ul>
                        </div>
                    </div><!-- end chart-item -->
                </div><!-- end col-lg-4 -->
                <div
                    class="col-lg-8 column-lmd-2-half column-md-full {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                    <div class="dashboard-shared">
                        <div class="mess-dropdown">
                            <div class="dashboard-title margin-bottom-20px">
                                <h4 class="widget-title font-size-18 d-flex align-items-center">
                                    @lang('site.most_wrong_question')
                                </h4>
                            </div><!-- end dashboard-title -->
                            <div class="mess__body {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
                                <div class="mess__item">
                                    <div class="icon-element text-white" style="background-color: transparent">
                                    </div>
                                    <div
                                        class="row content{{ app()->getLocale() == 'ar' ? 'text-left' : '' }} w-100">
                                        <div class="col-4">
                                            <p class="text">@lang('site.question')</p>
                                        </div>
                                        <div class="col-4 text-center">
                                            <p>
                                                @lang('site.number_of_wrong_answers')
                                            </p>
                                        </div>
                                        <div class="col-4 text-center">
                                            <p>
                                                @lang('site.wrong_percentage')
                                            </p>
                                        </div>
                                    </div>
                                </div><!-- end mess__item -->
                                @foreach($most_wrong_questions as $question)
                                    <div class="mess__item">
                                        @if($question['type'] == 'mcq')
                                            <div class="icon-element bg-color-2 text-white">
                                                <i class="las la-list-ul"></i>
                                            </div>
                                        @elseif($question['type'] == 'essay')
                                            <div class="icon-element bg-color-1 text-white">
                                                <i class="las la-paste"></i>
                                            </div>
                                        @elseif($question['type'] == 'true_false')
                                            <div class="icon-element bg-color-3 text-white">
                                                <i class="la la-check-circle"></i>
                                            </div>
                                        @endif
                                        <div
                                            class="row content{{ app()->getLocale() == 'ar' ? 'text-left' : '' }} w-100">
                                            <div class="col-4">
                                                <p class="text">{!! $question['name'] !!}</p>
                                                <span class="time">@lang('site.' . $question['type'])</span>
                                            </div>
                                            <div class="col-4 text-center">
                                                <p class="{{ $question['number_of_wrong_answers'] > $number_of_attendees / 2 ? 'text-danger' : 'text-success' }}">{{ $question['number_of_wrong_answers'] }}
                                                    /{{ $number_of_attendees }}</p>
                                            </div>
                                            @if($number_of_attendees > 0)
                                                <div class="col-4 text-center">
                                                    <p class="{{ $question['number_of_wrong_answers'] > $number_of_attendees / 2 ? 'text-danger' : 'text-success' }}">{{ number_format($question['number_of_wrong_answers'] / $number_of_attendees * 100, 0) }}
                                                        %</p>
                                                </div>
                                            @else
                                                <div class="col-4 text-center">
                                                    <p class="text-success">0%</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div><!-- end mess__item -->
                                @endforeach
                            </div>
                        </div><!-- end mess-dropdown -->
                    </div><!-- end dashboard-shared -->
                </div><!-- end col-lg-7 -->
            </div>
            @include('layouts.teacher._dashboard_footer')
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
@endsection
@push('scripts')
    <script src="{{ asset('js/chart.js') }}"></script>
    <script>
        /*==== doughut chart =====*/
        var ctx = document.getElementById("doughnut-chart");
        Chart.defaults.global.defaultFontFamily = 'Mukta';
        Chart.defaults.global.defaultFontSize = 14;
        Chart.defaults.global.defaultFontStyle = '500';
        Chart.defaults.global.defaultFontColor = '#233d63';
        var chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: ["{{ $number_of_attendees }}", "{{ $number_of_absence }}"],
                    backgroundColor: ["#7E3CF9", "#F68A03"],
                    hoverBorderWidth: 5,
                    hoverBorderColor: "#eee",
                    borderWidth: 3

                }],
                labels: [
                    "@lang('site.number_of_attendees')",
                    "@lang('site.number_of_absence')",
                ]
            },
            options: {
                responsive: true,
                tooltips: {
                    xPadding: 15,
                    yPadding: 15,
                    backgroundColor: '#2e3d62'
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 70
            }
        });
    </script>
@endpush
