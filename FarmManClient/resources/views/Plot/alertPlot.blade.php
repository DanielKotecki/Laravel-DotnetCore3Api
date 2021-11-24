@extends('layouts.master')
@section('title_content')
    Alerty Działek
@endsection
@section('content')
<div class="row">
   
    <div class="col-lg ">
        <h4 class='text-center'>Dzierżawy:
            @if (empty($alerts))
                <span class="badge badge-info">Brak</span>
                @endif
        </h4> 
        @foreach ($alerts as $item)
        <div class="alert alert-warning " role="alert">
            <p>Na działce o numerze: <strong>{{$item['numberPlot']}}</strong> w <strong>{{$item['city']}}</strong> {{$item['alertMessage']}}({{substr($item['dateEnd'],0,-9)}}).<br> Pozostało <strong>{{$item['days_to_end']}}</strong> dni do wygaśniecia umowy dzierżawy.
            </p>
            <hr>
            <p class="mb-0">Jeśli chcesz zmodyfikować dane dotyczące Pracy kliknij Przycisk <a class="btn btn-primary btn-sm text-decoration-none" href="/edit/rentone/{{$item['plotId']}}">Modyfikuj</a></p>
        </div> 
          @endforeach
    </div>
    <div class="col-lg">
        <h4 class='text-center'>Prace na działkach:
            @if (empty($alerts_work))
                <span class="badge badge-info">Brak</span>
                @endif
        </h4> 
        @foreach ($alerts_work as $item_work)
        <div class="alert alert-warning "  role="alert">
            <p>Na działce o numerze: <strong>{{$item_work['numberPlot']}}</strong> w <strong>{{$item['city']}}</strong> {{$item_work['alertMessage']}} <strong>{{$item_work['work_description']}}</strong>.<br> Do końca terminu prac pozostało dni:<strong>{{$item_work['days_to_end']}}</strong>.
            </p>
            <hr>
            <p class="mb-0">Jeśli chcesz zmodyfikować dane dotyczące Pracy kliknij Przycisk <a class="btn btn-primary btn-sm text-decoration-none" href="/plots/works/edit/{{$item_work['id']}}/{{$item_work['plotId']}}">Modyfikuj</a></p>
        </div> 
          @endforeach
    </div>
   
</div>
    
       

</div>






@endsection


