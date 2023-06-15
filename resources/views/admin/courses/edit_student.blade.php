@extends('layouts.admin.app')
@section('title', setting('website_name') . ' Courses')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex align-items-center">
                            <h3 class="widget-title">"{{ $student->email }}"</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <h3 class="widget-title font-size-18 mb-3">@lang('site.update_student')</h3>
                            <form
                                action="{{ route('admin.courses.students.update', ['course' => $course->slug, 'student' => $student->id]) }}"
                                method="post">
                                @csrf
                                @method('put')
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <label class="label-text">@lang('site.auth.first_name')</label>
                                        <div class="form-group">
                                            <input type="text" name="first_name" id="first_name"
                                                   class="form-control @error('first_name') is-invalid @enderror"
                                                   autocomplete="off" autofocus
                                                   placeholder="@lang('site.auth.first_name')"
                                                   value="{{ $student->first_name }}"
                                                   required>
                                            @error('first_name')
                                            <span class="text-danger font-size-12">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="label-text">@lang('site.auth.last_name')</label>
                                        <div class="form-group">
                                            <input type="text" name="last_name" id="last_name"
                                                   class="form-control @error('last_name') is-invalid @enderror"
                                                   autocomplete="off" placeholder="@lang('site.auth.last_name')"
                                                   value="{{ $student->last_name }}"
                                                   required>
                                            @error('last_name')
                                            <span class="text-danger font-size-12">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="input-box">
                                            <label class="label-text">@lang('site.login_type')</label>
                                            <div class="form-group">
                                                <div class="sort-ordering user-form-short">
                                                    <select class="sort-ordering-select" name="login_type">
                                                        <option
                                                            value="website" {{ old('login_type', $student->login_type) == 'website' ? 'selected' : '' }}>
                                                            @lang('site.website')
                                                        </option>
                                                        <option
                                                            value="mobile" {{ old('login_type', $student->login_type) == 'mobile' ? 'selected' : '' }}>
                                                            @lang('site.mobile')
                                                        </option>
                                                    </select>
                                                    @error('login_type')
                                                    <span class="text-danger font-size-12">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="input-box">
                                            <label class="label-text">@lang('site.group')</label>
                                            <div class="form-group">
                                                <div class="sort-ordering user-form-short">
                                                    <select class="sort-ordering-select" name="group_id">
                                                        <option
                                                            value="" {{ is_null($student->group_id) ? 'selected' : '' }}>
                                                            @lang('site.without_group')
                                                        </option>
                                                        @foreach($groups as $group)
                                                            <option
                                                                value="{{ $group->id }}" {{ $student->group_id == $group->id ? 'selected' : '' }}>
                                                                {{ $group->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('group_id')
                                                    <span class="text-danger font-size-12">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-12">
                                        <button class="theme-btn">
                                            <i class="la la-edit"></i>
                                            @lang('site.update')
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
            @include('layouts.admin._dashboard_footer')
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
@endsection
