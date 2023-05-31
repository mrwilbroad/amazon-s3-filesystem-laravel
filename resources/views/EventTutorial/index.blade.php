@extends('layouts.app')

@section('content')
        <div class="container">
            @if (Session::has('EmailSuccess'))
             <div class="alert alert-success alert-dismissible">
                <strong>{{ Session::get("EmailSuccess") }}</strong>
                <button class="btn-close btn-sm" data-bs-dismiss="alert" type="button"></button>
             </div>
             @endif
            <div class="card mx-auto">
                <div class="card-body col-lg-4 col-md-7 col-sm-6">
                    <form action="{{ url('EventTutorial/subscribe') }}" method="post">
                        @csrf
                        <input type="text" name="email" placeholder="email" 
                        class="form-control @error('email') is-invalid @enderror form-control-sm my-2">
                        <button class="btn btn-sm btn-sm btn-success">subscribe us</button>
                        @error('email')
                            <small class="invalid-feedback">
                                {{ $message }}
                            </small>
                        @enderror
                    </form>

                    <div class="container border border-3 mt-3 border-info p-3">
                        <h5 class="card-title">File System</h5>

                        <a href="{{ url("EventTutorial/save-files") }}">Save Files</a>
                        <form 
                        action="{{ url("EventTutorial/save-files") }}"
                        method="POST"
                        class="form" enctype="multipart/form-data">
                        @csrf

                            <input type="file" 
                            class="form-control @error('profile-picture') is-invalid @enderror form-control-sm" 
                            name="profile-picture">

                            @error('profile-picture')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror

                            <button 
                            type="submit" 
                            class="btn btn-success btn-sm my-2">Upload to Amazon</button>


                            <p class="form-text text-danger mt-2">
                                No Validation to this, failure to Upload Profile-picture my cause Fatal Error</p>
                       </form>
                    </div>

                    <section class="col-12">
                       @isset($profile_pic)
                       <small class="text-danger">Ipo--</small>
                       <img src={{ asset($profile_pic)}} class="img-fluid" alt="profile-picture">
                       @endisset
                    </section>
                </div>
            </div>
        </div>
@endsection