@extends('layouts.app')

@section("content")

<div class="container">
    <a href="{{ route('blog.create') }}" class="btn">Create New</a>
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
                <th>Author</th>
                <th>Slug</th>
                <th>Published</th>
            </tr>    
        </thead>

            @foreach ($model as $post)
                <tr>
                    <td>
                        <a href=" {{ route('blog.edit', ['blog' => $post->id]) }}">{{ $post->title }}</a>
                    </td>
                    <td>{{ $post->user()->first()->name }}</td>
                    <td>{{ $post->slug }}</td>
                    <td></td>
                    <td class="text-right">
                        <form action="{{ route('blog.destroy', ['blog' => $post->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
    </table>
    {{ $model->links() }}
</div>

@endsection