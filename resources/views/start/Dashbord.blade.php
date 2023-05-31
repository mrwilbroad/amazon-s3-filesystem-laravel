@extends('layouts.app')

@section('content')
      @auth
      <div class="container">
        
        @if (Session::has('API_Created'))
        <p class="alert py-1 alert-success alert-dismissible fade show">
         <strong>{{ Session::get('API_Created') }}</strong>
         <button class="btn-close py-2" data-bs-dismiss="alert"></button>
       </p>
        @endif

@isset($ProjectApiInfo)
    @foreach ($ProjectApiInfo as $item)
    <div class="modal fade " id="{{ 'DeleteAPIModal-'.$item['id'] }}" tabindex="-1" role="dialog" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Do you want to delete this?</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center">
                    <p class="text-danger">Previous API Token will automatically be removed from your application request</p>
                </div>

                <div class="modal-footer">
                    <form action="{{ Route('app.apikeyDelete',[
                        'tokenid' => $item['id']
                    ]) }}" class="form" method="POST">

                        @method("DELETE")
                        @csrf
                        <button type="submit" 
                        class="btn btn-sm btn-danger">Delete</button>
                        <button class="btn btn-sm btn-success" type="button" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endisset

        <div class="row justify-content-center border border-4 shadow border-dark">
            <div class="col-lg-5 col-md-12 col-sm-12">
               <div class="table-responsive">
                <table class="table table-bordered striped table-hover">
                    <caption class="table-caption caption-top">Request API Token:</caption>
                    <thead class="table-primary">
                        <tr>
                            <th>Project name</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <form method="POST" 
                            action="{{ Route('project-api') }}" class="form">
                                @csrf
                                <th>
                                    <input type="text"
                                    name="projectname"
                                    value="{{ old('projectname') }}"
                                    placeholder="Type project name" 
                                    class="form-control @error('projectname') is-invalid @enderror form-control-sm">
                                    @error('projectname')
                                        <small class="invalid-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </th>
                                <th>
                                    <button class="btn btn-sm btn-success">Request API KEY</button>
                                </th>
                            </form>
                        </tr>
                        @if (Session::has("api_key_fail"))
                        <tr>
                            <td colspan="100" class="text-danger text-center">{{ Session::get("api_key_fail") }}</td>
                        </tr>
                        @endif
                        
                    </thead>
                </table>
               </div>
            </div>


            <div class="col-lg-9 col-md-12 col-sm-12">

                @if (Session::has("apiInfo"))

              <div class="table-responsive">
                <table class="table table-bordered striped table-hover">
                    <caption class="table-caption caption-top">Project information:</caption>
                    <thead class="table-primary">
                        <tr>
                            <th>Project name</th>
                            <th>API KEY</th>
                            <th colspan="2">message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ Session::get('apiInfo')['projectname'] }}</td>
                            <td>{{ Session::get('apiInfo')['token'] }}</td>
                            <td class="text-danger">
                                {{ Session::get('apiInfo')['alert'] }}
                            </td>
                        </tr>
                    </tbody>
        
                </table>
              </div>

              @endif
            </div>  


            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="card border border-3 border-info">
                    <div class="card-body">
                        <h6 class="card-text">Documentation</h6>
                        <hr/>
                        <div class="vstack gap-0">

                             <section class="hstack gap-2 m-0">
                                    <p>GET</p> 
                                    <p class="vr"/>
                                    <h6 class="text-primary">
                                        http://127.0.0.1:8000/api/tasks
                                    </h6>
                             </section>

                             <section class="hstack gap-2 m-0">
                                <p>GET</p> 
                                <p class="vr"/>
                                <h6 class="text-primary">
                                    http://127.0.0.1:8000/api/tasks/{taskid}
                                </h6>
                             </section>

                             <section class="hstack gap-2 m-0">
                                <p>POST</p> 
                                <p class="vr"/>
                                <h6 class="text-primary">
                                    http://127.0.0.1:8000/api/tasks
                                </h6>
                             </section>

                             <section class="hstack gap-2 m-0">
                                <p>DELETE</p> 
                                <p class="vr"/>
                                <h6 class="text-primary">
                                    http://127.0.0.1:8000/api/tasks/{task}
                                </h6>
                             </section>

                             <section class="hstack gap-2 m-0">
                                <p>PATCH</p> 
                                <p class="vr"/>
                                <h6 class="text-primary">
                                    http://127.0.0.1:8000/api/tasks/{task}/edit
                                </h6>
                             </section>

                         

                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
      @endauth
@endsection