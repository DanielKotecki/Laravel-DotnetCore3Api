@extends('layouts.master')
@section('title_content')
    Wszytkie prace wybranej działki
@endsection
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{asset('css/style_table.css')}}">
@if (session('message'))
    @if ((session('message')=='Błąd dodania')||(session('message')=='Błąd aktualizacji danych'))
    <div class="alert alert-danger" role="alert">
        {{session('message')}}
      </div>
@endif
@if ((session('message')=='Praca dodana')||(session('message')=='Praca usunięta')||(session('message')=='Dane poprawnie zaktualizowane'))
<div class="alert alert-success" role="alert">
    {{session('message')}}
  </div>  

@endif
@endif
<div class="btn-group" role="group" aria-label="Basic example">
    <a class=" btn btn-primary " href="/plots/addwork/{{ Request::segment(3) }}" >Dodaj prace</a>
    <a type="button" class="btn btn-success" href="/plots">Wszystkie Działki</a>
  </div>
<div class="container">
    <div class="input-group">
        <input class="form-control py-2 border-right-0 border" type="search" placeholder="Co poszukać w tabeli" id="myInput">
        <span class="input-group-append">
            <div class="input-group-text bg-transparent"><i class="fa fa-search"></i></div>
        </span>
    </div>
</div>

<table id="myTable" class="table table-striped">
    <thead>
      <tr>
        <th id="th" scope="col">Od:</th>
        <th id="th" scope="col">Do:</th>
        <th id="th" scope="col">Status:</th>
        <th id="th" scope="col">Opis</th>
        <th  id='thbutton'scope="col">Przycisk wyboru</th>
      </tr>
    </thead>
    <tbody>  
     
      
        @if (empty($works)==true)
        <div class="alert alert-danger" role="alert">
            Brak prac dla wybranej działki.
          </div>
        @endif
         @foreach ($works as $item)
      
        <tr>
        <td  scope="row">{{substr($item['start_working'],0,-9)}}</td>
        <td  scope="row">{{substr($item['end_working'],0,-9)}}</td>
        <td  scope="row">{{$item['status']}}</td>
        <td  scope="row">{{$item['work_description']}}</td>
        <td>
           <a class=" btn btn-primary btn-sm" href="edit/{{$item['id']}}/{{$item['plotId']}}" >Pokaż i edytuj</a>
           {{-- <a class=" btn btn-danger btn-sm" href="deleteworks/{{$item['id']}}" >Usuń</a> --}}
           <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" 
              data-target="#exampleModal" onclick="myFunction({{$item['id']}})"
                id="submit">Usuń</button>
          </td>
      </tr>
        @endforeach 
     

    </tbody>
  </table>

     {{-- <!-- Modal Usuwania Pracy--> --}}
     <div class="modal fade" id="exampleModal" 
     tabindex="-1" 
     aria-labelledby="exampleModalLabel" 
     aria-hidden="true"> 
       
     <div class="modal-dialog"> 
         <div class="modal-content"> 
             <div class="modal-header"> 
                 <h5 class="modal-title" 
                     id="exampleModalLabel"> 
                     Potwierdzenie usuwania
                 </h5> 
                   
             </div> 
 
             <div class="modal-body"> 
 
                 <h6 id="modal_body text-justify">Czy napewno chcesz usunąć pracę?</h6>
                 <a class=" btn btn-danger btn-sm" id="delete" href="deleteworks/" >Tak</a> 
                 <button type="button" class="btn btn-secondary btn-sm " data-dismiss="modal">Nie</button>
             </div> 
         </div> 
     </div> 
 </div> 
 {{-- //Modal Usuwania Pracy--}}

  {{-- Skrypty --}}
<script src="{{asset('js/confirmModal.js')}}"></script>
<script src="{{asset('js/myseacher.js')}}"></script>
<script src="{{asset('js/scripts_table.js')}}"></script>
@endsection