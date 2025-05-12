@extends('layouts.app')

@section("content")

<div class="container">
    <a href="{{ route('pages.create') }}" class="btn">Create New</a>
    @if (session('status'))
        <div class="alert alert-info">
            {{ session('status') }}
        </div>
    @endif
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>URL</th>
                <th>Delete</th>
            </tr>    
        </thead>

            @foreach ($pages as $page)
                <tr>
                    <td>
                        <a href="{{ route('pages.edit', ['page' => $page->id]) }}">{{ $page->title }}</a>
                    </td>
                    <td>{{ $page->url }}</td>
                    <td class="text-right">
                        <form action="{{ route('pages.destroy', ['page' => $page->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this page?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
    </table>
    {{ $pages->links() }}
</div>

@endsection