@if(Auth::user()->designation_id == 'Approver')
        <small>Approver</small>
@endif
@if(Auth::user()->designation_id == 'Operator')
         <small>Operator</small>
@endif
@if(Auth::user()->designation_id == 'Verifier')
       <small>Verifier</small>
@endif
