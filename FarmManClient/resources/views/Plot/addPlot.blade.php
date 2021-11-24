@extends('layouts.master')
@section('title_content')
    Dodaj Działkę
@endsection
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <form action="addplot" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputFirstname">Numer działki <small class="text-danger">(wymagane)</small></label>
                        <input type="text" class="form-control" id="inputFirstname" name="number_plot" placeholder="Numer działki"> @error('number_plot')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="inputLastname">Miasto <small class="text-danger">(wymagane)</small></label>
                        <input type="text" class="form-control" id="inputLastname" name="city" placeholder="Miasto">
                        @error('city')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputAddressLine1">Wielkość w hektarach<small class="text-danger">(wymagane)</small></label>
                        <input type="number" min="0"  class="form-control" name="area_hectare" placeholder="Wielkość">
                        @error('area_hectare')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="">Typ działki<small class="text-danger">(wymagane)</small></label>
                        <select class="form-control"  name="plot_typeId">
                            <option value="" disabled selected>Wybierz jedno</option>
                            @foreach ($plot_type as $item)
                            
                                <option value="{{$item['id']}}">{{$item['type_p']}}</option>
                            @endforeach 
                          </select> 
                          @error('plot_typeId')
                        <small  class=" text-danger">{{$message}}</small>
                            @enderror
                    </div>
                   
                </div>

                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" name="rent" id="customCheckbox1">
                    <label for="customCheckbox1" class="custom-control-label">Wynajęta </label>
                  </div>
                <button type="submit" class="btn btn-primary px-4 float-right">Dodaj</button>
            </form>
        </div>
    </div>
</div>
@endsection