@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3 text-right">
            <a href="{{ url('users') }}">ユーザ一覧 <i class="fas fa-users" class="fa-fw"></i> </a>
        </div>
        @if (isset($timelines))
            @foreach ($timelines as $timeline)
                <div class="col-md-8 mb-3">
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            @if ($timeline->user->profile_image)
                                <img src="{{ asset('storage/profile_image/' .$timeline->user->profile_image) }}" class="rounded-circle" width="50" height="50">
                            @else
                                <i class="me-2 fas fa-user-circle fa-3x text-secondary"></i>
                            @endif
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $timeline->user->name }}</p>
                                <a href="{{ url('users/' .$timeline->user->id) }}" class="text-secondary">{{ $timeline->user->screen_name }}</a>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary">{{ $timeline->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! nl2br(e($timeline->text)) !!}
                        </div>
                        <div class="card-footer py-1 d-flex justify-content-end bg-white">
                            @if ($timeline->user->id === Auth::user()->id)
                                <div class="dropdown mr-3 d-flex align-items-center">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-fw"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <a class="dropdown-item" href="{{ url('tweets/' . $timeline->id . '/edit') }}">編集</a>
                                        </li>
                                        <li>
                                            <form method="POST" action="{{ url('tweets/' . $timeline->id) }}" class="mb-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item del-btn">削除</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>                            
                            @endif

                            <div class="d-flex align-items-center">
                                @if (!in_array($user->id, array_column($timeline->favorites->toArray(), 'user_id'), TRUE))
                                    <form method="POST" action="{{ url('favorites/') }}" class="mb-0">
                                        @csrf

                                        <input type="hidden" name="tweet_id" value="{{ $timeline->id }}">
                                        <button type="submit" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw"></i></button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ url('favorites/' .array_column($timeline->favorites->toArray(), 'id', 'user_id')[$user->id]) }}" class="mb-0">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn p-0 border-0 text-danger"><i class="fas fa-heart fa-fw"></i></button>
                                    </form>
                                @endif
                                <p class="mb-0 text-secondary">{{ count($timeline->favorites) }}</p>
                            </div>
                            <div class="ms-3 d-flex align-items-center">
                                <a href="{{ url('tweets/' .$timeline->id) }}"><i class="far fa-comment fa-fw"></i></a>
                                <p class="mb-0 text-secondary">{{ count($timeline->comments) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="my-4 d-flex justify-content-center">
        {{ $timelines->links() }}
    </div>
</div>
@endsection