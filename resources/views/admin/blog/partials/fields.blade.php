{!! csrf_field() !!}

@if (!$errors->isEmpty())

<div class="alert alert-danger">
    @foreach ($errors->all() as $message)

    <li>{{ $message }}</li>

    @endforeach
</div>

@endif

<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title"
        name="title" value="{{ $model->title }}"/>
</div>

<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" class="form-control" id="slug"
        name="slug" value="{{ $model->slug }}"/>
</div>

<div class="form-group position-relative">

    <label for="published_at">Published Date/Time</label>
    <input 
        type="text" 
        class="form-control datetimepicker-input" 
        id="published_at"
        name="published_at" 
        data-target="#published_at"
        data-toggle="datetimepicker"
        value="{{ $model->published_at }}"
        />
</div>

<div class="form-group">
    <label for="excerpt">Excerpt</label>
    <textarea class="form-control" name="excerpt" id="excerpt">
        {{ $model->excerpt }}
    </textarea>
</div>

<div class="form-group">
    <label for="body">Body</label>
    <textarea class="form-control" name="body" id="body">
        {{ $model->body }}
    </textarea>
</div>

<div class="form-group">
    <input type="submit" class="btn-default" value="Submit"/>
</div>