@extends('layouts.admin.app')
@section('title', setting('website_name') . ' Categories')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex flex-column justify-content-center">
                            <h3 class="widget-title">@lang('site.add_new_category')</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="user-form">
                                <div class="contact-form-action">
                                    <form method="POST" action="{{ route('admin.categories.store') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.english_name')<span
                                                            class="primary-color-2 ml-1">*</span>
                                                    </label>
                                                    <div class="form-group">
                                                        <input class="form-control @error('name.en') error @enderror"
                                                               type="text" name="name[en]"
                                                               placeholder="@lang('site.english_name')" required>
                                                        <span class="la la-file-text-o input-icon"></span>
                                                        @error('name.en')
                                                        <span class="text-danger font-size-12">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.arabic_name')<span
                                                            class="primary-color-2 ml-1">*</span>
                                                    </label>
                                                    <div class="form-group">
                                                        <input class="form-control @error('name.ar') error @enderror"
                                                               type="text" name="name[ar]"
                                                               placeholder="@lang('site.arabic_name')" required>
                                                        <span class="la la-file-text-o input-icon"></span>
                                                        @error('name.ar')
                                                        <span class="text-danger font-size-12">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="label-text">@lang('site.category_parent')</label>
                                                <div class="form-group">
                                                    <div class="sort-ordering user-form-short">
                                                        <select class="sort-ordering-select" name="parent_id">
                                                            <option selected
                                                                    value="">@lang('site.select_category_parent')</option>
                                                            @foreach($categories as $category)
                                                                <option
                                                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('parent_id')
                                                        <span class="text-danger font-size-12">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="theme-btn">
                                                    <i class="la la-plus"></i>
                                                    @lang('site.create')
                                                </button>
                                            </div>
                                        </div>
                                    </form><!-- end row -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.admin._dashboard_footer')
        </div>
    </div>
@endsection
