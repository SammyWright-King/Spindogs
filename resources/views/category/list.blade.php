@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Categories') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($categories->count() < 1)
                        <p>You do not have any categories yet.</p>

                    @else
                        <ul class="list-group list-group-flush">
                            @foreach ($categories as $category_)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $category_->name }}

                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <a class="btn btn-sm btn-primary me-md-2" href="{{ route('category.list', $category_->id) }}">View</a>
                                    </div>

                                </li>
                            @endforeach
                        </ul>
                    @endif

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header"> {{ __(isset($category) ? 'Edit Category' : 'Create Category') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ isset($category) ? route('category.store', $category->id) : route('category.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">{{ __('Name') }}*</label>
                            <input type="text" name="name" id="title" placeholder="Category" class="form-control @error('name') is-invalid @enderror" value="{{ isset($category) ? $category->name : '' }}">

                            @error('name')
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
    </div>
</div>
@endsection

