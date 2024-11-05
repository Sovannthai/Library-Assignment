@extends('backends.master')
@section('title', 'Borrow')
@section('contents')
    <style>
        input {
            cursor: pointer !important;
        }
    </style>
    <div class="card">
        <h6 class="card-header bg-success-header">
            <a data-toggle="collapse" href="#collapse-example" aria-expanded="true" aria-controls="collapse-example"
                id="heading-example" class="d-block bg-success-header">
                <i class="fa fa-filter bg-success-header"></i>
                @lang('Filter')
            </a>
        </h6>
        <div id="collapse-example" class="collapse show" aria-labelledby="heading-example">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="customer_id">@lang('Customer')</label>
                        <select name="customer_id" id="customer_id" class="form-control select2">
                            <option value="">{{ __('All') }}</option>
                            @foreach ($customers as $row)
                                <option value="{{ $row->id }}"
                                    {{ $row->id == request('customer_id') ? 'selected' : '' }}>
                                    {{ $row->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="cate_id">@lang('Catelog')</label>
                        <select name="cate_id" id="cate_id" class="form-control select2">
                            <option value="">{{ __('All') }}</option>
                            @foreach ($catalogs as $row)
                                <option value="{{ $row->id }}" {{ $row->id == request('cate_id') ? 'selected' : '' }}>
                                    {{ $row->cate_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header text-uppercase">@lang('Borrow List')
            @if (auth()->user()->can('create.borrow'))
                <a href="{{ route('borrow.create') }}" class="btn btn-success float-lg-right mt-2">+ @lang('Add Borrow')</a>
            @endif
            <div class="search-row mt-2 mb-2 col-sm-4 float-lg-right">
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                    class=" form-control search-box" autocomplete="off" placeholder="@lang('Search...')">
            </div>
        </div>
        @include('backends.borrow._table_borrow')
    </div>
    @push('js')
        <script>
            $(document).ready(function() {
                $(document).on('keyup', '.search-box', function(e) {
                    var search = $(this).val();
                    var customer_id = $('#customer_id').val();
                    var book_ids = $('#book_id').val();
                    $.ajax({
                        type: "get",
                        url: window.location.href,
                        data: {
                            'search': search,
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            if (response.view) {
                                $('.table-wrap').replaceWith(response.view);
                            }
                        }
                    });

                })
                $(document).on('change', '#customer_id, #cate_id', function(e) {
                    e.preventDefault();
                    var customer_id = $('#customer_id').val();
                    var cate_id = $('#cate_id').val();
                    $.ajax({
                        type: "GET",
                        url: '{{ route('borrow.index') }}',
                        data: {
                            'customer_id': customer_id,
                            'cate_id': cate_id
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            if (response.view) {
                                $('.table-wrap').replaceWith(response.view);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });
                $('#customer_id').select2();
                $('#cate_id').select2();
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.send-telegram-notification').click(function(event) {
                    event.preventDefault();

                    $(this).prop('disabled', true);
                    $(this).html('<i class="fa fa-spinner fa-spin"></i> Sending...');

                    var borrowId = $(this).data('borrow-id');
                    var telegramBotToken = '{{ env('TELEGRAM_BOT_TOKEN') }}';

                    $.ajax({
                        url: '/send-telegram-notification/' + borrowId,
                        method: 'POST',
                        data: {
                            _token: $(this).find('input[name="_token"]').val(),
                            telegram_bot_token: telegramBotToken
                        },
                        success: function(response) {
                            if (response.status === 'Notification sent!') {
                                $(this).html('<i class="fa fa-check"></i> Sent!');
                                setTimeout(function() {
                                    $(this).html(
                                        '<i class="fa fa-message ambitious-padding-btn"> @lang('Send')</i>'
                                    );
                                    $(this).prop('disabled', false);
                                }, 2000);
                            } else {
                                $(this).html('<i class="fa fa-times"></i> Error!');
                                setTimeout(function() {
                                    $(this).html(
                                        '<i class="fa fa-message ambitious-padding-btn"> @lang('Send')</i>'
                                    );
                                    $(this).prop('disabled', false);
                                }, 2000);
                            }
                        },
                        error: function(error) {
                            console.error('Error sending notification:', error);
                        }
                    });
                });
            });
        </script>
        <script>
            $(document).on('click', '.send-notification', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');
                Swal.fire({
                    title: "Send Notification?"
                        // , text: "You won't be able to revert this!"
                        ,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "@lang('Yes, Send it!')"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        </script>
    @endpush
@endsection
