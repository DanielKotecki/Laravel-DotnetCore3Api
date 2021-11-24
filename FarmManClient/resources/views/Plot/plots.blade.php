@extends('layouts.master')
@section('title_content')
   Wszystkie działki
@endsection
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="css/style_table.css">
@if (session('message'))
    @if ((session('message')=='Błąd usuwania dzierżawy')||(session('message')=='Błąd aktualizacji')||(session('message')=='Błąd dodawania')||(session('message')=='Błąd aktualizacji')||(session('message')=='Błąd dodania dzierżawy podczas dodawania działki')||(session('message')=='Błąd dodania')||(session('message')=='Błąd usuwania'))
    <div class="alert alert-danger" role="alert">
        {{session('message')}}
      </div>
@endif
@if ((session('message')=='Dzierżawa usunięta poprawnie')||(session('message')=='Działka poprawnie zaktualizowana')||(session('message')=='Dzierżawa dodana')||(session('message')=='Dzierżawa poprawnie zaktualizowana')||(session('message')=='Działka dodana wraz z dzierżawą')||(session('message')=='Działka dodana')||(session('message')=='Działka usunięta'))
<div class="alert alert-success" role="alert">
    {{session('message')}}
  </div>  
  
@endif
@endif

<form class="form-inline" action="categoryplot" method="post">
  @csrf
  <div class="form-group mx-sm-2 ">
   
    <select class="form-control " name="category">
      @foreach ($plot_type as $oneCategory)
          <option value="{{$oneCategory['id']}}">{{$oneCategory['type_p']}}</option>
      @endforeach
      
    </select>
  </div>
  
  <div class="btn-group" role="group" aria-label="Basic example">
    <button type="submit" class="btn btn btn-primary">Pokaż z wybranej kategorii</button>
    <a type="button" class="btn btn-success" href="/plots">Wszystkie Działki</a>
    <a type="button" class="btn btn-primary" href="/plotadd">Dodaj działkę</a>
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
        <th id="th" scope="col">Numer działki</th>
        <th id="th" scope="col">Miasto</th>
        <th id="th" scope="col">Wielkość</th>
        <th id="th" scope="col">Kategoria</th>
        <th id="th" scope="col">Dzierżawiona</th>
        <th  id='thbutton'scope="col">Przycisk wyboru</th>
      </tr>
    </thead>
    <tbody>  
         @if (empty($plots)==true)
        <div class="alert alert-danger" role="alert">
            Brak Działek .
          </div>
        @endif
        @foreach ($plots as $item)
      
        <tr>
        <td  scope="row">{{$item['number_plot']}}</td>
        <td  scope="row">{{$item['city']}}</td>
        
        <td >{{$item['area_hectare']}}</td>
        <td >{{$item['plot_type_name']}}</td>
        @if ($item['rent'])
        <td > TAK</td>
        @else
            <td>NIE</td>
        @endif
        <td><a class=" btn btn-primary btn-sm" href="/edit/plotone/{{$item['id']}}" >Pokaż i edytuj</a>
           @if ($item['rent'])
               <a class=" btn btn-primary btn-sm" href="/edit/rentone/{{$item['id']}}" >Pokaż dzierżawę</a>
               <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" 
                data-target="#exampleModalrent" onclick="myFunction({{$item['id']}})"
                id="submit">Usuń dzierżawę</button>
            @else
               <a class=" btn btn-primary btn-sm" href="edit/addrentpage/{{$item['id']}}" >Dodaj dzierżawę</a>
            @endif 
            <a class=" btn btn-primary btn-sm" href="/plots/addwork/{{$item['id']}}" >Dodaj Pracę</a>
            <a class=" btn btn-primary btn-sm" href="/plots/works/{{$item['id']}}" >Pokaż wszystkie prace</a>
            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" 
              data-target="#exampleModal" onclick="myusuwanie({{$item['id']}})"
                id="submit">Usuń</button>
        </td>
      </tr>
        @endforeach 
     

    </tbody>
  </table>
  {{-- Modal usuwania dzierżawy --}}
        <div class="modal fade" id="exampleModalrent" 
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

                    <h6 id="modal_body text-justify">Czy napewno chcesz usunąć dzierżawę??</h6>
                    <a class=" btn btn-danger btn-sm" id="delete" href="/delete/rentone/" >Tak</a> 
                    <button type="button" class="btn btn-secondary btn-sm " data-dismiss="modal">Nie</button>
                </div> 
            </div> 
        </div> 
      </div> 
  {{--// Modal usuwania dzierżawy --}}
     {{-- <!-- Modal Usuwania działki--> --}}
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
 
                 <h6 id="modal_body text-justify">Czy napewno chcesz usunąć działkę?</h6>
                 <a class=" btn btn-danger btn-sm" id="deleteplot" href="deleteplot/" >Tak</a> 
                 <button type="button" class="btn btn-secondary btn-sm " data-dismiss="modal">Nie</button>
             </div> 
         </div> 
     </div> 
 </div> 
 {{-- //Modal Usuwania działki--}}
  {{-- Skrypty --}}
<script src="js/confirmModal.js"></script>
<script src="js/myseacher.js"></script>
<script src="js/scripts_table.js"></script>
@endsection