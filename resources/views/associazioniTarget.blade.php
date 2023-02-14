@extends('template.layout')

@section('content')
<div class="container">

    <h3>TARGET {{$nomeTarget}}</h3>
    <a href="/gestioneTarget"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> torna ai target</a>

    <div class="panel-body">
     <!-- SE PRESENTE STAMPO IL MESSAGGIO DI INSERIMENTO -->
     @if (session()->has('message'))
     <div class="alert alert-info">{{session()->get(('message'))}}</div>
 @endif
 @if (session()->has('messageError'))
     <div class="alert alert-danger">{{session()->get(('messageError'))}}</div>
 @endif
 @if (count($errors))
 <div class="alert alert-danger">
     <ul>
     @foreach($errors->all() as $error)
         <li> {{$error}} </li>
     @endforeach
     </ul>
 </div>
 @endif

 <div class="panel panel-default panel-table">
    <div class="text-right mb-3">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCreaAss">+ ASSOCIAZIONE</button>
    </div>
 
 <div class="table-responsive">
    <table id='TableResultStatus' class="table table-striped table-hover dt-responsive display">
        <thead>
            <tr>
            <th style="width:10%"><i class="fa fa-cog"></i></th>
            <th style="width:10%">Id</th>
            <th style="width:20%">Sid</th>
            <th style="width:20%">Codice domanda</th>
            <th style="width:40%">Opzioni</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($viewAss as $stampAss)
        <tr>
            
            <td>
                <form action="/associazioniTarget/{{$stampAss->id}}" method="POST">
                    
                        @method('delete')
                        @csrf
                        <button class="btn btn-success" onclick="return confirm('Sei sicuro?')" type="submit"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
            </td>

            <td>{{$stampAss->id}}</td>
            <td>{{$stampAss->sid}}</td>
            <td>{{$stampAss->questionCode}}</td>
            <td>{{$stampAss->optionCode}}</td>
        </tr>
        @endforeach

        </tbody>
    </table>

</div>


    </div>

</div>

<!-- MODALE PER CREAZIONE TARGET -->
<div class="modal fade" id="modalCreaAss" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aggiungi associazione</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/associazioniTarget/{{$idTarget}}" method="POST" >

                <div class="modal-body">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Sid</label>
                            <input type="text" required  class="form-control" name="sid" value="" aria-describedby="Codice" placeholder="Sid Ricerca">
                        </div>
                        <div class="form-group">
                            <label>Codice domanda</label>
                            <input type="text" required  class="form-control" name="code" value="" aria-describedby="Codice" placeholder="Code domanda">
                        </div>

                        <div class="form-group">
                            <label>Opzioni domande</label>
                            <input type="text" required  class="form-control" name="options" value="" aria-describedby="Codice" placeholder="Opzioni es. (0,1,2..)">
                        </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CHIUDI</button>
                    <button type="submit" class="btn btn-primary">CREA</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('footer')
@parent
<script>
    $(document).ready(function(){
        $('div.alert-info').fadeOut(5000);
        $('div.alert-danger').fadeOut(5000);
    });


</script>


@endsection