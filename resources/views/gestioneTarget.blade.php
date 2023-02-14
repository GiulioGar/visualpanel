@extends('template.layout')

@section('content')
<div class="container">

    <h2>TARGET</h2>

    <div class="panel panel-default panel-table">
        <div class="text-right mb-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreaTarget">+ TARGET</button>
        </div>

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
            <div class="table-responsive">
                <table id='TableResultStatus' class="table table-striped table-hover dt-responsive display">
                    <thead>
                        <tr>
                        <th style="width:10%"><i class="fa fa-cog"></i></th>
                        <th style="width:10%">Id</th>
                        <th style="width:60%">Target</th>
                        <th style="width:10%">Utenti</th>
                        <th style="width:10%">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($viewTarget as $stampTarget)
                    <tr>
                        <td>
                        <a class="btn btn-success"  href="/associazioniTarget/{{$stampTarget->id}}"><i class="fa fa-folder-open-o"></i></a>
 
                      </td>
                        <td>{{$stampTarget->id}}</td>
                        <td>{{$stampTarget->nome}}</td>
                        <td>5</td>
                        <form action="/gestioneTarget/{{$stampTarget->id}}" method="POST">
                        <td> 
                        @method('delete')
                        @csrf
                        <button class="btn btn-success" onclick="return confirm('Sei sicuro?')" type="submit"><i class="fa-solid fa-trash-can"></i></button></td>
                        </form>
                    </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>

        </div>

  </div>

</div>


<!-- MODALE PER CREAZIONE TARGET -->
<div class="modal fade" id="modalCreaTarget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuovo Target</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/gestioneTarget" method="POST" >
                <div class="modal-body">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Nome Target</label>
                            <input type="text" required  class="form-control" name="nome" value="" aria-describedby="Codice" placeholder="Aggiungi un nuovo target">
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


