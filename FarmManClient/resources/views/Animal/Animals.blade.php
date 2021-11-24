@extends('layouts.master')
@section('title_content')
    Wszytkie moje zwierzęta
@endsection
@section('content')
<link rel="stylesheet" href="css/style_table.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@if (session('message'))
    @if ((session('message')=='Błąd usuwania zwierzaka z bazy danych')||(session('message')=='Błąd aktualizacji danych')||(session('message')=='Błąd dodawania'))
    <div class="alert alert-danger" role="alert">
        {{session('message')}}
      </div>
@endif
@if ((session('message')=='Zwierzę usunięte z bazy danych')||(session('message')=='Dane poprawnie zaktualizowane')||(session('message')=='Zwierzę dodane do bazy'))
<div class="alert alert-success" role="alert">
    {{session('message')}}
  </div>  

@endif
@endif
<a type="button" class="btn btn-primary" href="/animal">Dodaj zwierzę</a>

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
        <th id="th" scope="col">Numer zwierzęcia</th>
        <th id="th" scope="col">Numer farmy/siedziby</th>
        <th id="th" scope="col">Miejsce z którego przybyło:</th>
        <th id="th" scope="col">Płeć</th>
        <th id="th" scope="col">Rasa</th>
        <th id="th" scope="col">Żyje</th>
        <th id="th" scope="col">Data urodzenia</th>
        <th  id='thbutton'scope="col">Przycisk wyboru</th>
      </tr>
    </thead>
    <tbody>
      @if (empty($animal)==true) 
       <div class="alert alert-danger" role="alert">
          Brak Zwierzaków.
        </div>
      @endif
       @foreach ($animal as $item)
           <tr>
             <td scope='row'>{{$item['animal_id']}}</td>

              <td   scope="row">Farma:{{$item['farm_id']}}<br>Siedziba:{{$item['place_id']}}</td>
              <td>
              @if (($item['old_place_id']==null) &&($item['old_farm_id']==null))
                  Urodzone na miejscu.
              @else
                  Farma:{{$item['old_farm_id']}}<br>Siedziba:{{$item['old_place_id']}}<br>
                  Imię:{{$item['old_name']}}<br>
                  Nazwisko:{{$item['old_surname']}}
              @endif
              </td>
              <td>{{$item['sex']}}</td>
              <td>{{$item['breed']}}</td>
              <td>
              @if (($item['natural_death']==null)&&($item['slaughter_date']==null))
              Żyje
              @endif
              @if (($item['natural_death']==null)&&($item['slaughter_date']!=null))
              Ubite:{{substr($item['slaughter_date'],0,-9)}}
              @endif
              @if (($item['natural_death']!=null)&&($item['slaughter_date']==null))
              Padło:{{substr($item['natural_death'],0,-9)}} 
              @endif
              @if (($item['natural_death']!=null)&&($item['slaughter_date']!=null))
              Padło:{{substr($item['natural_death'],0,-9)}} <br>
              lub<br> 
              Ubite:{{substr($item['slaughter_date'],0,-9)}}
              @endif 
              </td>
              <td>{{substr($item['date_birth'],0,-9)}}</td>
              <td>   
                    <a class=" btn btn-primary btn-sm" href="specanimal/{{$item['id']}}" >Pokaż i edytuj</a>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" 
                      data-target="#exampleModal" onclick="myFunction({{$item['id']}})"
                      id="submit">Usuń</button>
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
                    <h6 id="modal_body text-justify">Czy napewno chcesz usunąć zwierzę?</h6>
                    <a class=" btn btn-danger btn-sm" id="delete" href="deleteanimal/" >Tak</a> 
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