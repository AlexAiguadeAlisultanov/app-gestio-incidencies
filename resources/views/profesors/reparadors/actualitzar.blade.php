<form method="POST" action="{{ route('profesors/reparadors/update',$reparadors->id) }}" role="form" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
 
    @include('profesors.reparadors.frm.prt')
</form>