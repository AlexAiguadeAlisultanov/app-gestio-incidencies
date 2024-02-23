<form method="POST" action="{{ route('profesors/incidencies/update',$incidencies->id) }}" role="form" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
 
    @include('profesors.incidencies.frm.prt')
                                                                            
</form>