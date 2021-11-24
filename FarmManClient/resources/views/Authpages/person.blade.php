@extends('layouts.master')
@section('title_content')
    Dane osobowe
@endsection
@section('content')
<div class="container">
   @if (session('message'))
    @if (session('message')=='Błąd aktualizacji danych')
    <div class="alert alert-danger" role="alert">
        {{session('message')}}
      </div>
@endif
@if (session('message')=='Dane zaktualizowane')
<div class="alert alert-success" role="alert">
    {{session('message')}}
  </div>  

@endif
@endif
    <table class="table ">
       <tbody>
          <tr>
             <td colspan="1">
                <form class="well form-horizontal" method="POST" action="personput">
                   @csrf
                   <fieldset>
                      <div class="form-group">
                         <label class="col-md-4 control-label">Imię:</label>
                         <div class="col-md-8 inputGroupContainer">
                            <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="fullName"  placeholder="Imię" class="form-control"  value="{{$person[0]['name']}}" name='name' type="text"></div>
                         </div>
                      </div>
                      <div class="form-group">
                         <label class="col-md-4 control-label">Nazwisko:</label>
                         <div class="col-md-8 inputGroupContainer">
                            <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span><input id="addressLine1" placeholder="Nazwisko" class="form-control" value="{{$person[0]['surname']}}" name="surname" type="text"></div>
                         </div>
                      </div>
                      <div class="form-group">
                         <label class="col-md-4 control-label">Miasto:</label>
                         <div class="col-md-8 inputGroupContainer">
                            <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span><input id="addressLine2" placeholder="Miasto/Kod pocztowy" class="form-control"  value="{{$person[0]['city']}}" name="city" type="text"></div>
                         </div>
                      </div>
                      <div class="form-group">
                         <label class="col-md-4 control-label">Adres:</label>
                         <div class="col-md-8 inputGroupContainer">
                            <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span><input id="city"  placeholder="Ulica/numer domu" class="form-control"  value="{{$person[0]['address']}}" name="address" type="text"></div>
                         </div>
                      </div>
                      <div class="form-group">
                         <label class="col-md-4 control-label">Kraj:</label>
                         <div class="col-md-8 inputGroupContainer">
                            <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span><input id="state"  placeholder="Kraj" class="form-control"  value="{{$person[0]['country']}}" name="country" type="text"></div>
                         </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="col-md-8 inputGroupContainer">
                           <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                              <button    class="btn btn-success" value="Zatwierdzam zmiany"  value="" type="text">Zatwierdzam zmiany</button>
                           </div>
                        </div>
                        <br><br>
                        <div class="col-md-8 inputGroupContainer">
                           <h5>Aby usunąć konto wciśnij przycisk który pozwoli usunąć konto wraz z wszystkimi danymi</h5>
                           <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                              <a href="{{asset('/deleteAccount')}}" class="btn btn-danger" type="text">Usuń konto</a>
                           </div>
                        </div>
                     </div>
                   </fieldset>
                </form>
             </td>
             
          </tr>
       </tbody>
    </table>
 </div>
@endsection