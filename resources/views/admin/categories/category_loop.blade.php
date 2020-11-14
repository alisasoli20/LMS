<tr class="bg-category-step{{$category->step}}">
    <td>
        <label>
            <input class="category_check" name="checked_category[]" type="checkbox" value="{{$category->id}}" /> #{{$category->id}}
        </label>
    </td>
    <td>
        <p class="m-0 d-flex">

            @for($i = 0; $i<=$category->step; $i++)
                <span class="category-loop-icon">
                    @if( ! $category->step)
                        @if($category->icon_class)
                            <i class="la {{$category->icon_class}}" data-toggle="tooltip" title="Top Category"></i>
                        @else
                            <i class="la la-arrow-circle-up" data-toggle="tooltip" title="Top Category"></i>
                        @endif
                    @endif
                    @if( $category->step == 1 && $i == 1)
                        <i class="la la-chevron-circle-right"></i>
                    @endif
                    @if( $category->step == 2 && $i == 2)
                        <i class="la la-tag" data-toggle="tooltip" title="Topic"></i>
                    @endif
                </span>
            @endfor

            <span>{!! $category->category_name !!}</span>
        </p>
    </td>
    <td>
        @if($category->image_id)
            <img src="{{media_image_uri($category->image_id)->thumbnail}}" alt="" class="img-thumbnail img-50X50" />
        @endif
    </td>
    <td>
        <a href="{{route('category_edit', $category->id)}}" class="btn btn-primary btn-sm"><i class="la la-pencil"></i> </a>
        <a href="{{route('category_view', $category->slug)}}" class="btn btn-outline-info btn-sm" target="_blank"><i class="la la-eye"></i> </a>
    </td>
</tr>
