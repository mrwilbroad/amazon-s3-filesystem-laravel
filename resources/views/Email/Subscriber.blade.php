@extends('layouts.config')


@section('config')

@isset($Assignedtask)
<div class="container vw-100 vh-100 d-flex flex-column justify-content-center">
  <section class="row  justify-content-center">
     <section class="col-lg-4 col-md-7 col-sm-12 p-2 border border-3 p-3">
         <h6 class="card-title fw-bold text-center text-primary">
             PAYMENT GATEWAY NOTIFICATION
         </h6>
         <hr/>
           <h4 class="text-primary">Dear {{ $ClientEmail }},</h4>
            
           <p>
             <strong>Task name :</strong> {{ $Assignedtask->name }}
           </p>
           <p>
            <strong>Task Description :</strong> {{ $Assignedtask->description }}
           </p>
           <p>
            <strong class="text-danger">Task priority :</strong> {{ $Assignedtask->priority }}
           </p>
           <p>Best regards,</p>
           <p class="p-0 m-0 text-primary">mrwilbroad@campany</p>
           <p class="p-0 text-primary">mrwilbroadHelpDesk@mrwilbroad.co.tz</p>
      
     </section>
  </section>
</div>
@endisset

@endsection

