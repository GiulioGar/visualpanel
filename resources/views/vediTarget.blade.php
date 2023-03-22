@extends('template.layout')

<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap-extended.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/fonts/simple-line-icons/style.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/colors.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

<style>
    .grey-bg {  
    background-color: #F5F7FA;
    -webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
}
</style>

@section('content')
<div class="container">


    <a href="/gestioneTarget"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> torna ai target</a>
    <p>&nbsp;</p>
<div class="grey-bg container-fluid">
  <section id="minimal-statistics">
    <div class="row">
      <div class="col-12 mt-3 mb-1">
        <h4 class="text-uppercase">  <h3>TARGET: <b>{{$nomeTarget->nome}}</b> </h3></h4>
        <p>User del Brand A2A</p>
      </div>
    </div>

</section>
</div>
<p>&nbsp;</p>
<div class="row">

      <div class="col-xl-4 col-sm-6 col-12"> 
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-center">
                  <i class="fa-solid fa-people-group primary font-large-2 float-left"></i>
                </div>
                <div class="media-body text-right">
                  <h3>{{count($users[0])}}</h3>
                  <span>Utenti</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      
      <div class="col-xl-4 col-sm-6 col-12"> 
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-center">
                  <i style="color:dodgerblue" class="fa-solid fa-person font-large-2 float-left"></i>
                </div>
                <div class="media-body text-right">
                  <h3>39</h3>
                  <span>Uomini</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-4 col-sm-6 col-12"> 
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-center">
                  <i style="color:darkorchid" class="fa-solid fa-person-dress font-large-2 float-left"></i>
                </div>
                <div class="media-body text-right">
                  <h3>90</h3>
                  <span>Donne</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


</div>

@endsection

@section('footer')
@parent



@endsection