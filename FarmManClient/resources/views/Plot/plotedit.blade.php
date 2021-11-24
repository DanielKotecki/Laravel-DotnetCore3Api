@extends('layouts.master')
@section('title_content')
    Dodaj Działkę
@endsection
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <form action="putplot" method="POST">
                
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputFirstname">Numer działki <small class="text-danger">(wymagane)</small></label>
                        <input value="{{$plot[0]['id']}}" name="plot_id" hidden>
                        <input value="{{$plot[0]['rent']}}" name="rent" hidden>
                        <input type="text" class="form-control" value="{{$plot[0]['number_plot']}}" name="number_plot" placeholder="Numer działki"> @error('number_plot')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="inputLastname">Miasto <small class="text-danger">(wymagane)</small></label>
                        <input type="text" class="form-control" value="{{$plot[0]['city']}}" name="city" placeholder="Miasto">
                        @error('city')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputAddressLine1">Wielkość w hektarach<small class="text-danger">(wymagane)</small></label>
                        <input type="number" min="0" class="form-control" name="area_hectare" value="{{$plot[0]['area_hectare']}}" placeholder="Wielkość">
                        @error('area_hectare')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="">Typ działki<small class="text-danger">(wymagane)</small></label>
                        <select class="form-control"  name="plot_typeId">
                            <option value="{{$plot[0]['plot_typeId']}}" selected>{{$plot[0]['plot_type_name']}}</option>
                            @foreach ($plot_type as $item)
                            
                                <option value="{{$item['id']}}">{{$item['type_p']}}</option>
                            @endforeach 
                          </select> 
                          @error('plot_typeId')
                        <small  class=" text-danger">{{$message}}</small>
                            @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary px-4 float-right">Dodaj</button><br><br>
                <a class="btn btn-success px-4 float-right" href="/plots">Wróć do listy działek</a>
            </form>
        </div>
    </div>
</div>
@endsection