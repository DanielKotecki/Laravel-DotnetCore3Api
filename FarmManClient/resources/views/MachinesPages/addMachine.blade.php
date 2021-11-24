@extends('layouts.master')
@section('title_content')
    Dodaj maszynę
@endsection
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <form action="addmachine" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="inputFirstname">Marka <small class="text-danger">(wymagane)</small></label>
                        <input type="text" class="form-control" id="inputFirstname" name="marka" placeholder="Marka"> @error('marka')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                    <div class="col-sm-4">
                        <label for="inputLastname">Model <small class="text-danger">(wymagane)</small></label>
                        <input type="text" class="form-control" id="inputLastname" name="model" placeholder="Model">
                        @error('model')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                
                <div class="col-sm-4">
                    <label for="inputLastname">Rejestracja maszyny<small class="text-danger">(wymagane)</small></label>
                    <input type="text" class="form-control" id="inputLastname" name="machine_id" value="BRAK" placeholder="Rejestracja maszyny">
                    @error('machine_id')
                   <small  class=" text-danger">{{$message}}</small>
               @enderror
                </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputAddressLine1">Rok produkcji <small class="text-danger">(wymagane)</small></label>
                        <input type="number" min="1900" max="2500" class="form-control" id="inputAddressLine1" name="yearproduction" placeholder="Rok produkcji">
                        @error('yearproduction')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="">Kategoria maszyny <small class="text-danger">(wymagane)</small></label>
                        <select class="form-control" id="inlineFormCustomSelect" name="categorymachines">
                            <option value="" disabled selected>Wybierz jedno</option>
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
                        <input type="number" min="0" class="form-control" id="" name="power" placeholder="Moc maszyny">
                    </div>
                    <div class="col-sm-3">
                        <label for="inputMoc wymagana">Moc wymagana(KM)</label>
                        <input type="number" min="0" class="form-control" id="inputMoc wymagana" name="powerneed" placeholder="Moc wymagana">
                    </div>
                    <div class="col-sm-3">
                        <label for="inputPojemność zbiornika">Pojemność zbiornika(Litry)</label>
                        <input type='number' min="0" class="form-control" id="inpuPojemność zbiornikae" name="capacity" placeholder="Pojemność zbiornika">
                    </div>
                    <div class="col-sm-3">
                        <label for="inputSzerokość robocza">Szerokość robocza(CM)</label>
                        <input type='number' min="0" class="form-control" id="inputszerokość robocza" name="workingwidth" placeholder="Szerokość robocza">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputubezpieczenie">Ubezpieczenie pojazdu ważne do:</label>
                        <input type='date' class="form-control" id="inputubezpieczenie" name="insurance_date" placeholder="Ubezpieczenie pojazdu ważne do">
                    </div>
                    <div class="col-sm-6">
                        <label for="inputprzeglad">Przeglad techniczny ważny do:</label>
                        <input type="date" class="form-control" id="inputprzeglad" name="mot_check" placeholder="Przeglad techniczny ważny do:">
                    </div>
                </div>
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" name="attached" id="customCheckbox1">
                    <label for="customCheckbox1" class="custom-control-label">Maszyna jest doczepiana (nieposiada własnego napędu)</label>
                  </div>
                <button type="submit" class="btn btn-primary px-4 float-right">Dodaj</button>
            </form>
        </div>
    </div>
</div>
@endsection