<div class="card-body p-0 table-wrap table-responsive">
    <table class="table table-bordered table-hover text-nowrap align-middle">
        <thead class="text-uppercase">
            <tr>
                <th>@lang('No.')</th>
                <th>@lang('Cover')</th>
                <th>@lang('Code')</th>
                <th>@lang('Name')</th>
                <th>@lang('isbn')</th>
                <th>@lang('Author Name')</th>
                <th>@lang('Publisher')</th>
                <th>@lang('Publish Year')</th>
                <th>@lang('Pubish Edition')</th>
                <th>@lang('Status')</th>
                <th>@lang('Action')</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($catelogs as $catelog)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <span>
                        <a class="example-image-link" href="{{ asset('uploads/all_photo/' . $catelog->photo) }}" data-lightbox="lightbox-' . $catelog->id . '">
                            <img class="example-image rounded-circle" src="{{ asset('uploads/all_photo/' . $catelog->photo) }}" alt="profile" width="70px" height="70px" style="cursor:pointer" />
                        </a>
                    </span>
                </td>
                <td>{{ $catelog->cate_code }}</td>
                <td>{{ $catelog->cate_name }}</td>
                <td>{{ $catelog->isbn }}</td>
                <td>{{ $catelog->author_name }}</td>
                <td>{{ $catelog->publisher }}</td>
                <td>{{ $catelog->publishyear }}</td>
                <td>{{ $catelog->publish_edition }}</td>
                <td>
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input toggle-status" id="customSwitches{{ $catelog->id }}" data-id="{{ $catelog->id }}" {{ $catelog->status ==
                        '1' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="customSwitches{{ $catelog->id }}"></label>
                    </div>
                </td>
                <td>
                    @if (auth()->user()->can('edit.catelog'))
                    <a href="" class="btn btn-outline-success text-uppercase btn-sm btn-md" data-toggle="modal" data-target="#edit-{{ $catelog->id }}" data-toggle="tooltip" title="@lang('Edit')"><i class="fa fa-edit ambitious-padding-btn">
                            @lang('Edit')</i></a>&nbsp;&nbsp;
                    @include('backends.catelog_and_book.catelog.edit')
                    @endif
                    @if (auth()->user()->can('delete.catelog'))
                    <form id="deleteForm" action="{{ route('catelog.destroy', ['catelog' => $catelog->id]) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-outline-danger text-uppercase btn-sm btn-md delete-btn" title="@lang('Delete')">
                            <i class="fa fa-trash-can ambitious-padding-btn"> @lang('Delete')</i>
                        </button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="11" class="text-center">
                    <div class="text-danger">
                        @lang('No Data Found')
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="11" class="text-center">
                    <a href="" class="btn btn-outline-success btn-sm btn-md text-uppercase" data-toggle="modal" data-target="#create" data-toggle="tooltip" title="@lang('Add')"><i class="fa fa-plus ambitious-padding-btn">
                            @lang('Add')</i></a>
                </td>
            </tr>
            <tr>
                <td colspan="11" class="text-center">
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="col-12 d-flex flex-row flex-wrap">
        <div class="col-12 col-sm-6 text-center text-sm-left" style="margin-block: 20px">
            {{ __('Showing') }} {{ $catelogs->firstItem() }} {{ __('to') }}
            {{ $catelogs->lastItem() }} {{ __('of') }} {{ $catelogs->total() }}
            {{ __('entries') }}
        </div>
        <div class="col-12 col-sm-6"> {{ $catelogs->appends(request()->input())->links() }}</div>
    </div>
</div>
