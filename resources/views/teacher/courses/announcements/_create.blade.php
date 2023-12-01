<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card-box-shared">
            <div class="card-box-shared-title d-flex justify-content-between">
                <h3 class="widget-title">@lang('site.add_new_announcement')</h3>
            </div>
            <form
                action="{{ route('teacher.courses.announcements.store', ['course' => $course->slug]) }}"
                method="POST">
                @csrf
                <div class="card-box-shared-body">
                    <div class="user-form">
                        <div class="contact-form-action">
                            <div class="row form-content">
                                <div class="col-lg-12 col-sm-12">
                                    <div class="input-box">
                                        <label class="label-text" for="body">@lang('site.announcement')
                                            <span class="primary-color-2 ml-1">*</span>
                                        </label>
                                        <div class="form-group">
                                            <input class="form-control @error('body') error @enderror"
                                                   type="text" name="body"
                                                   value="{{ old('body') }}"
                                                   placeholder="@lang('site.announcement')" id="body">
                                            <span class="la la-bullhorn input-icon"></span>
                                            @error('body')
                                            <span class="text-danger error_message">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-6 col-sm-6">
                                    <div class="input-box">
                                        <label class="label-text" for="group_id">@lang('site.group')
                                            <span class="primary-color-2 ml-1">*</span>
                                        </label>
                                        <div class="form-group">
                                            <div class="sort-ordering user-form-short">
                                                <select
                                                    class="sort-ordering-select type @error('group_id') error @enderror"
                                                    name="group_id" id="group_id">
                                                    <option value="null">@lang('site.all_students')</option>
                                                    @foreach($groups as $group)
                                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('group_id')
                                                <span
                                                    class="text-danger error_message">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="theme-btn">@lang('site.add_announcement')</button>
                </div><!-- end card-box-shared-body -->
            </form>
        </div><!-- end card-box-shared -->
    </div><!-- end col-lg-12 -->
</div>

