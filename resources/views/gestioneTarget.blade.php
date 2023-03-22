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
                        <th colspan="2" style="width:5%; padding:0px; margin:0; text-align:center"></th>
                        <th style="width:10%; text-align:center">Id</th>
                        <th style="width:5%"></th>
                        <th style="width:70%">Target</th>
                        <th colspan="2" style="width:10%">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($viewTarget as $stampTarget)
                    <tr>
                 
                        <td>  <a class="btn btn-success"  href="/associazioniTarget/{{$stampTarget->id}}"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></td>
                        <td>  <a  href="#" id="edit-nome" class="btn btn-success" data-item-id="{{$stampTarget->id}}" data-nome="{{$stampTarget->nome}}" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                        
                      
                        <td style="width:10%; text-align:center">{{$stampTarget->id}}</td>
                        <td> <a  href="/vediTarget/{{$stampTarget->id}}" class="btn btn-primary"><i class="fa fa-address-card" aria-hidden="true"></i></a></td>
                        <td>{{$stampTarget->nome}}</td>
                        <form action="/gestioneTarget/{{$stampTarget->id}}" method="POST">
                        <td>
                        @method('delete')
                        @csrf
                        <button class="btn btn-success" onclick="return confirm('Sei sicuro?')" type="submit"><i class="fa-solid fa-trash-can"></i></button></td>
                        </form>
                        <td>
                    <div style="float:right; font-size:12px;"><a  href="/export/{{$stampTarget->id}}" class="btn btn-warning"><i class="fa fa-cloud-download" aria-hidden="true"></i></a></div>

                    </td>
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


<!-- MODALE PER MODIFICA TARGET -->
<div class="modal fade" id="modalModTarget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifica Target</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modFormTarget" action="/gestioneTarget" method="POST" >
                <div class="modal-body">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-group">
                            <label>Modifica Nome Target</label>
                            <input id="nomemod" type="text" required  class="form-control" name="nome" value="{{old('nome')}}" aria-describedby="Codice" placeholder="">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CHIUDI</button>
                    <button type="submit" class="btn btn-primary">MODIFICA</button>
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



   /*sezione modale modifica*/
   $(document).on('click', "#edit-nome", function() {
        $(this).addClass('edit-nome-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        var options = {
        'backdrop': 'static'
        };
        $('#modalModTarget').modal(options)
        })
        // on modal show
        $('#modalModTarget').on('show.bs.modal', function() {
        //la classe trigger l'avrà solo l'elemento cliccato
        var el = $(".edit-nome-trigger-clicked");
        console.log(el);
        var id = el.data('item-id');
        var nome = el.data('nome');
        console.log("idstampato:"+id);
        console.log("nome:"+nome);
        var urlAction="/gestioneTarget/"+id;
        console.log("url"+urlAction);
        //alert(urlAction);
        $('#modFormTarget').attr('action', urlAction);
        // fill the data in the input fields
        $("#nomemod").val(nome);
        })
        // on modal hide
        $('#modalModTarget').on('hide.bs.modal', function() {
        //quando si chiude la modali viene rimossa la classe trigger all'elemento cliccato
        $('.edit-nome-trigger-clicked').removeClass('edit-nome-trigger-clicked')
        $("#edit-form").trigger("reset");
        })
        ///////////////////////////////////////////////
    });
</script>


@endsection
