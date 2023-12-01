@foreach($sections as $section)
    <tr>
        <td>--</td>
        <td class="pl-{{ $level }}">{{ $section->name }}</td>
        <td>
            <a href="{{ route('teacher.courses.sections.edit', ['course' => $course->slug, "section" => $section->id]) }}">
                <button class="btn btn-info">
                    <i class="la la-edit"></i>
                    @lang('site.edit')
                </button>
            </a>
            <form
                action="{{ route('teacher.courses.sections.destroy', ['course' => $course->slug, "section" => $section->id]) }}"
                method="post" class="d-inline-block"
                id="cat_delete_{{ $section->id }}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger delete"
                        data-toggle="modal"
                        data-target=".item-delete-modal"
                        data-cat_id="{{ $section->id }}"
                >
                    <i class="la la-trash-o"></i>
                    @lang('site.delete')
                </button>
            </form>
        </td>
    </tr>
    @if(!$section->isLastLevelChild() > 0)
        @include('teacher.courses.create.sections._sub_sections', ['sections' => $section->children, 'level' => $level + 1])
    @endif
@endforeach
