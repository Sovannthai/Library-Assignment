@extends('backends.master')
@section('title', 'Customer Report')
@section('contents')
{{-- <h1>Borrowed Books Report for Customer {{ request()->route('customer_id') }}</h1>
@if ($reports->isEmpty())
    <p>No books borrowed by this customer.</p>
@else --}}
    <table>
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>Book ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Borrowed At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
                <tr>
                    <td>{{ $report->customer_id }}</td>
                    <td>{{ $report->book_id }}</td>
                    <td>{{ $report->title }}</td>
                    <td>{{ $report->author }}</td>
                    <td>{{ $report->borrowed_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
{{-- @endif --}}
@endsection
