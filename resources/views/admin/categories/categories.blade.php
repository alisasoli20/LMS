@extends('layouts.admin')

@section('page-header-right')
    <a href="{{route('category_create')}}" class=" ml-1 btn btn-primary btn-xl" data-toggle="tooltip" title="@lang('admin.category_add')"> <i class="la la-plus"></i> </a>
    <a href="#" class=" ml-1 btn btn-danger btn_delete" data-toggle="tooltip" title="@lang('admin.delete')"><i class="la la-trash-o"></i> </a>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">

            <form action="" method="post" enctype="multipart/form-data"> @csrf
                @if($categories->count())
                    <table class="table table-bordered admin-categories-list">
                        <thead>
                        <tr>
                            <td><input id="category_check_all" type="checkbox" /></td>
                            <td>@lang('admin.category_name')</td>
                            <td>@lang('admin.thumb')</td>
                            <td>@lang('admin.action')</td>
                        </tr>

                        </thead>

                        <tbody>
                        @foreach($categories as $category)
                            @include('admin.categories.category_loop', ['category' => $category])

                            @foreach($category->sub_categories as $subCategory)
                                @include('admin.categories.category_loop', ['category' => $subCategory])
                                @foreach($subCategory->sub_categories as $lastCategory)
                                    @include('admin.categories.category_loop', ['category' => $lastCategory])
                                @endforeach
                            @endforeach
                        @endforeach
                        </tbody>


                    </table>

                @else

                    {!! no_data() !!}

                @endif

            </form>

            {!! $categories->links() !!}

        </div>

    </div>


@endsection


@section('page-js')
    <script type="text/javascript">
        $(document).on('click', '.btn_delete', function(e){
            e.preventDefault();

            var checked_values = [];
            $('.category_check:checked').each(function(index){
                checked_values.push(this.value);
            });

            if (checked_values.length){
                if ( ! confirm('@lang('admin.deleting_confirm')')){
                    return false;
                }

                $.ajax({
                    type: 'POST',
                    url: '{{route('delete_category')}}',
                    data: { categories: checked_values, _token: pageData.csrf_token},
                    success: function(data){
                        if (data.success){
                            window.location.reload(true);
                        }
                    }
                });
            }
        });

        $(document).on('change', '#category_check_all', function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection
