@extends('layouts.master')
@section('title_content')
    Alerty Ubezpieczenia
@endsection
@section('content')
<div class="row">
   
    <div class="col-lg">
        <h4 class='text-center'>Przed terminem:
            @if (empty($before))
                <span class="badge badge-info">Brak</span>
                @endif
        </h4> 
        @foreach ($before as $item)
         <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">Informacja dotycząca OC!</h4>
            <p>Maszyna:{{$item['mark']}} {{$item['model']}} o rejesracji:<b>{{$item['machine_id']}}</b>. <br>
            {{$item['alertMessage']}} dnia:{{substr($item['date'],0,-9)}}
            </p>
            <hr>
            <p class="mb-0">Jeśli chcesz zmodyfikować dane dotyczące OC kliknij Przycisk <a class="btn btn-primary btn-sm text-decoration-none" href="/edit/{{$item['id']}}">Modyfikuj</a></p>
          </div> 
          @endforeach
           </div>
   
    
       
   
           <div class="col-lg"> 
               <h4 class='text-center'>Po terminie:
                @if (empty($after))
                <span class="badge badge-info">Brak</span>
                @endif
               </h4>
            @foreach ($after as $item)
             <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Informacja dotycząca OC!</h4>
                <p>Maszyna:{{$item['mark']}} {{$item['model']}} o rejesracji:<b>{{$item['machine_id']}}</b>.<br>
                {{$item['alertMessage']}} dnia:{{substr($item['date'],0,-9)}}   
                </p>
                <hr>
                <p class="mb-0">Jeśli chcesz zmodyfikować dane dotyczące OC kliknij Przycisk <a  class="btn btn-primary btn-sm text-decoration-none" href="/edit/{{$item['id']}}">Modyfikuj</a></p>
              </div> 
              @endforeach
               </div>






@endsection