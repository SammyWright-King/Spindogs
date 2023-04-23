@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">{{ __(isset($note) ? 'Edit Note' : 'Create Note') }}</div>

                <div class="card-body">

                    <form action="{{ isset($note) ? route('note.store', $note->id) : route('note.store') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="title">{{ __('Title') }}*</label>
                            <input type="text" name="title" id="title" placeholder="Title" class="form-control @error('title') is-invalid @enderror" value="{{ isset($note) ? $note->title : '' }}">

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="disabledSelect" class="form-label">Categories (Note you can select multiple categories from the select group below)</label>
                            
                            <select class="form-control" multiple aria-label="Default select example" name="category[]"> 
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{ $category->name}}</option>
                                @endforeach
                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="content">{{ __('Content') }}</label>
                            <textarea name="content" id="content" rows="10" class="form-control @error('content') is-invalid @enderror" id="content">{{ isset($note) ? $note->content : '' }}</textarea>
                            @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </form>

                </div>

            </div>

        </div>


        @if(isset($note))
            <div class="col-md-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-header"> Categories </div>
                    <ul class="list-group list-group-flush">
                        @foreach($note->categories as $category)
                            <li class="list-group-item">{{ $category->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

    </div>

</div>

@endsection
