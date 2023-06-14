@foreach($categories as $category)
    <tr>
        <td>--</td>
        <td class="pl-{{ $level }}">{{ $category->name }}</td>
        <td>
            <a href="{{ route('admin.categories.edit', $category->id) }}">
                <button class="btn btn-info">
                    <i class="la la-edit"></i>
                    @lang('site.edit')
                </button>
            </a>
            <form action="{{ route('admin.categories.destroy', $category->id) }}"
                  method="post" class="d-inline-block"
                  id="cat_delete_{{ $category->id }}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger delete"
                        data-toggle="modal"
                        data-target=".item-delete-modal"
                        data-cat_id="{{ $category->id }}"
                >
                    <i class="la la-trash-o"></i>
                    @lang('site.delete')
                </button>
            </form>
        </td>
    </tr>
    @if(count($category->childrens) > 0)
        @include('admin.categories._sub_category', ['categories' => $category->childrens, 'level' => $level + 1])
    @endif
@endforeach
