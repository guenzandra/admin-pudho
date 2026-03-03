@extends('editor.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="mt-4">Editor Dashboard</h1>
            <p class="lead">Welcome to Editor Panel</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Posts</div>
                <div class="card-body">
                    <h5 class="card-title display-4">{{ $totalPosts ?? App\Models\Post::count() }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <h5 class="card-title display-4">{{ App\Models\Category::count() }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Recent Posts</div>
                <div class="card-body">
                    <h5 class="card-title display-4">{{ isset($recentPosts) ? $recentPosts->count() : 0 }}</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Posts Table -->
    @if(isset($recentPosts) && $recentPosts->count() > 0)
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Recent Posts</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentPosts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->category->name ?? 'Uncategorized' }}</td>
                                <td>{{ $post->created_at->format('M d, Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection