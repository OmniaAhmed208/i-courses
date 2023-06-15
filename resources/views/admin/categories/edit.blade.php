@extends('layouts.admin.app')
@section('title', setting('website_name') . ' Categories')
@section('content')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title d-flex flex-column justify-content-center">
                            <h3 class="widget-title">@lang('site.edit') {{ $category->name }}</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="user-form">
                                <div class="contact-form-action">
                                    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
                                        @csrf
                                        @method('put')
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="input-box">
                                                    <label class="label-text">@lang('site.english_name')<span
                                                            class="primary-color-2 ml-1">*</span>
                                                    </label>
                                                    <div class="form-group">
                                                        <input class="form-control @error('name.en') error @enderror"
                                                               type="text" name="name[en]"
                                                               placeholder="@lang('site.english_name')"
                                                               value="{{ old('name', $category->getTranslation('name', 'en')) }}"
                                                               required>
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
                                                               placeholder="@lang('site.arabic_name')"
                                                               value="{{ old('name', $category->getTranslation('name', 'ar')) }}"
                                                               required>
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
                                                            <option
                                                                value="">@lang('site.select_category_parent')</option>
                                                            @foreach($categories as $sub_category)
                                                                @if($sub_category->id != $category->id)
                                                                    <option
                                                                        value="{{ $sub_category->id }}"
                                                                        {{ $category->parent && $sub_category->id == $category->parent->id ? 'selected' : '' }}
                                                                    >
                                                                        {{ $sub_category->name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="theme-btn">
                                                    <i class="la la-edit"></i>
                                                    @lang('site.edit')
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
