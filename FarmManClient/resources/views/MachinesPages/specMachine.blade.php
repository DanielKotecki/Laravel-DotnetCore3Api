@extends('layouts.master')
@section('title_content')
    Wszystkie dane maszyny:
    @foreach ($maszyna as $item_machine)
        {{$item_machine['mark']}} 
        {{$item_machine['model']}} 
    @endforeach
@endsection
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <form action="putmachine/{{$maszyna[0]['id']}}" method="POST">
                @csrf
                @foreach ($maszyna as $machine)
                    
                
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="inputFirstname">Marka <small class="text-danger">(wymagane)</small></label>
                        <input type="text" class="form-control" id="inputFirstname" name="marka" value="{{$machine['mark']}}"> @error('marka')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                    <div class="col-sm-4">
                        <label for="inputLastname">Model <small class="text-danger">(wymagane)</small></label>
                        <input type="text" class="form-control" id="inputLastname" name="model" value="{{$machine['model']}}" placeholder="Model">
                        @error('model')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                    <div class="col-sm-4">
                        <label for="inputLastname">Rejestracja maszyny<small class="text-danger">(wymagane)</small></label>
                        <input type="text" class="form-control" id="inputLastname" name="machine_id" value="{{$machine['machine_id']}}" placeholder="Rejestracja maszyny">
                        @error('machine_id')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputAddressLine1">Rok produkcji <small class="text-danger">(wymagane)</small></label>
                        <input type="number" min="1900" max="2500"  class="form-control" id="inputAddressLine1" name="yearproduction" value="{{$machine['year']}}" placeholder="Rok produkcji">
                        @error('yearproduction')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="">Kategoria maszyny <small class="text-danger">(wymagane)</small></label>
                        <select class="form-control" id="inlineFormCustomSelect" name="categorymachines">
                            <option value="{{$machine['category_id']}}"  selected>{{$machine['name_category_machine']}}</option>
                            @foreach ($category as $item)
                            
                                <option value="{{$item['id']}}">{{$item['name_category_machine']}}</option>
                            @endforeach

                          </select> 
                          @error('categorymachines')
                    <small  class=" text-danger">{{$message}}</small>
                @enderror
                    </div>
                   
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="">Moc maszyny(KM)</label>
                        <input type="number" min="0" class="form-control" id="" name="power" value="{{$machine['power']}}" placeholder="Moc maszyny">
                    </div>
                    <div class="col-sm-3">
                        <label for="inputMoc wymagana">Moc wymagana(KM)</label>
                        <input type="number" min="0" class="form-control" id="inputMoc wymagana" name="powerneed" value="{{$machine['power_need']}}" placeholder="Moc wymagana">
                    </div>
                    <div class="col-sm-3">
                        <label for="inputPojemność zbiornika">Pojemność zbiornika(Litry)</label>
                        <input type='number' min="0" class="form-control" id="inpuPojemność zbiornikae" name="capacity" value="{{$machine['capacity']}}" placeholder="Pojemność zbiornika">
                    </div>
                    <div class="col-sm-3">
                        <label for="inputSzerokość robocza">Szerokość robocza(CM)</label>
                        <input type='number' min="0" class="form-control" id="inputszerokość robocza" name="workingwidth" value="{{$machine['working_width']}}" placeholder="Szerokość robocza">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputubezpieczenie">Ubezpieczenie pojazdu ważne do:</label>
                        <input type='date' class="form-control" id="inputubezpieczenie" name="insurance_date" value="{{substr($machine['insurance_date'],0,-9)}}" placeholder="Ubezpieczenie pojazdu ważne do">
                    </div>
                    <div class="col-sm-6">
                        <label for="inputprzeglad">Przeglad techniczny ważny do:</label>
                        <input type="date" class="form-control" id="inputprzeglad" name="mot_check" value="{{substr($machine['mot_check'],0,-9)}}" placeholder="Przeglad techniczny ważny do:">
                    </div>
                </div>
                <div class="custom-control custom-checkbox">
                    @if ($machine['attached']==1)
                       <input class="custom-control-input" type="checkbox"  name="attached" id="customCheckbox1" checked> 
                    @else
                    <input class="custom-control-input" type="checkbox"  name="attached" id="customCheckbox1" >  
                    @endif
                    
                    <label for="customCheckbox1" class="custom-control-label">Maszyna jest doczepiana (nieposiada własnego napędu)</label>
                  </div>
                <button type="submit" class="btn btn-primary px-4 float-right">Zmień dane maszyny</button><br> <br>
                <a class="btn btn-success px-4 float-right" href="/machines">Wróć do listy wszystkich maszyn</a>
           @endforeach
         </form>
        </div>
    </div>
</div>
@endsection