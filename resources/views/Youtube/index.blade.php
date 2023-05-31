@extends('layouts.app')

@section('content')
  <div class="container">
       <div class="card">
            <div class="card-body">
                <h5 class="card-title">Welcome to Youtube API Management...</h5>

                <form action="{{ route("youtubeRequest") }}" 
                method="POST" 
                class="form col-lg-6">

                    @csrf
                    <label  class="form-label">Search content</label>

                    <textarea value="{{ old("youtube_Content") }}" 
                    class="form-control @error("youtube_Content") 
                    is-invalid @enderror" 
                    name="youtube_Content" 
                    placeholder="Search content here"></textarea>
                    
                    @error('youtube_Content')
                   <small class="invalid-feedback">
                    {{ $message }}
                    </small>
                   @enderror

                   <button type="submit" class="btn btn-success mt-3">search now</button>
                 
                </form>
            </div>
       </div>
  </div>
@endsection