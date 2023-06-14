@foreach($categories as $category)
    <ul class="sub-menu">
        <li class="{{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
            <a href="{{ route('courses.index') }}?category_id[{{$category->id}}]={{$category->id}}"
               class="pb-0 d-flex justify-content-between sub_cat">
                {{ $category->name }}
            </a>
            @if(count($category->childrens) > 0)
                @include('layouts._sub_categories', ['categories' => $category->childrens])
            @endif
        </li>
    </ul>
@endforeach
