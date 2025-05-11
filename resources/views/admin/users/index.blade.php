@extends('layouts.app')

@section("content")

<div class="container">
    <a href="{{ route('pages.create') }}" class="btn">Create New</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
            </tr>
            @foreach ($model as $user)
                <tr>
                    <td>
                        <a href=" {{ route('users.edit', ['user' => $user->id]) }}">{{ $user->name }}</a>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ implode(', ',$user->roles()->get()->pluck('name')->toArray()) }}</td>
                </tr>
            @endforeach
        </thead>
    </table>
</div>

@endsection