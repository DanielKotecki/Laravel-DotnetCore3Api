@extends('layouts.master')
@section('title_content')
    Magazyn wszystkie produkty
@endsection
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="css/style_table.css">
@if (session('message'))
    @if ((session('message')=='Błąd usuwania towaru z bazy danych')||(session('message')=='Błąd aktualizacji danych'))
    <div class="alert alert-danger" role="alert">
        {{session('message')}}
      </div>
@endif
@if ((session('message')=='Towar usunięty z bazy danych')||(session('message')=='Dane poprawnie zaktualizowane'))
<div class="alert alert-success" role="alert">
    {{session('message')}}
  </div>  

@endif
@endif

<form class="form-inline" action="categorymaterial" method="post">
  @csrf
  <div class="form-group mx-sm-2 ">
   
    <select class="form-control " name="category">
      @foreach ($category as $oneCategory)
          <option value="{{$oneCategory['id']}}">{{$oneCategory['category']}}</option>
      @endforeach
      
    </select>
  </div>
  
  <div class="btn-group" role="group" aria-label="Basic example">
    <button type="submit" class="btn btn btn-primary">Pokaż z wybranej kategorii</button>
    <a type="button" class="btn btn-success" href="/storehouse">Wszystkie Produkty</a>
    <a type="button" class="btn btn-primary" href="/itemadd">Dodaj do magazynu</a>
  </div>
</form>
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
        <th id="th" scope="col">Kategoria</th>
        <th id="th" scope="col">Nazwa</th>
        <th id="th" scope="col">Waga/ilość</th>
        <th id="th" scope="col">Opis</th>
        <th  id='thbutton'scope="col">Przycisk wyboru</th>
      </tr>
    </thead>
    <tbody>  
        @if (empty($material)==true)
        <div class="alert alert-danger" role="alert">
            Brak wybranego towaru danej kategorii.
          </div>
        @endif
        @foreach ($material as $item)
      
        <tr>
        <td  scope="row">{{$item['category']}}</td>
        <td  scope="row">{{$item['name']}}</td>
        
        <td >{{$item['weight']}}:{{$item['unit_of_measure']}}</td>
        <td >
          @if ($item['description']==null)
              Brak opisu
          @endif
          {{$item['description']}}
        </td>
        <td><a class=" btn btn-primary btn-sm" href="edit/storehouse/{{$item['id']}}" >Pokaż i edytuj</a>
           {{-- <a class=" btn btn-danger btn-sm" href="deletestorehouse/{{$item['id']}}" >Usuń</a> --}}
           <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" 
           data-target="#exampleModal" onclick="myFunction({{$item['id']}})"
           id="submit"> 
          Usuń
       </button>
          </td>
      </tr>
        @endforeach
     

    </tbody>
  </table>
    {{-- <!-- Modal --> --}}
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

                <h6 id="modal_body text-justify">Czy napewno chcesz usunąć materiał?</h6>
                <a class=" btn btn-danger btn-sm" id="delete" href="deletestorehouse/" >Tak</a> 
                <button type="button" class="btn btn-secondary btn-sm " data-dismiss="modal">Nie</button>
                

            </div> 
        </div> 
    </div> 
</div> 
{{-- //Modal --}}
{{-- Skrypty --}}
<script src="js/confirmModal.js"></script>
<script src="js/myseacher.js"></script>
<script src="js/scripts_table.js"></script>
@endsection