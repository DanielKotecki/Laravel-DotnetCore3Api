@extends('layouts.master')
@section('title_content')
    Dodaj do zwierzę
@endsection
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <form action="/putanimal" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="input">Numer Zwierzęcia<small class="text-danger">(wymagane)</small></label>
                        <input type="text" class="form-control" id="input"  name="animal_id" value="{{$animal[0]['animal_id']}}" placeholder="Numer Zwięrzęcia"> @error('animal_id')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="input">Numer Farmy<small class="text-danger">(wymagane)</small></label>
                        <input value="{{$animal[0]['id']}}"  name="id_animal" hidden>
                        <input type="text" class="form-control" id="input" value="{{$animal[0]['farm_id']}}" name="farm_id" placeholder="Numer Farmy"> @error('farm_id')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="input">Numer miejsca<small class="text-danger">(wymagane)</small></label>
                        <input  type="text" class="form-control"  id="input" name="place_id" value="{{$animal[0]['place_id']}}" placeholder="Numer miejsca">
                        @error('place_id')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        
                        <div class="custom-control custom-checkbox">
                            @if (($animal[0]['old_farm_id']==null)&&($animal[0]['old_place_id']==null))
                                <input class="custom-control-input" type="checkbox"  name="check_number" id="customCheckbox1" checked> 
                            @else
                               <input class="custom-control-input" type="checkbox" name="check_number" id="customCheckbox1"> 
                            @endif
                            <label for="customCheckbox1" class="custom-control-label">Urodzone na miejscu<small class="text-danger">(wymagane jeśli puste pola starej farmy i miejsca)</small></label>
                          </div></p>
                         @error('check_number')
                       <small  class=" text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="input">Numer starej farmy<small class="text-danger">(wymagane jeśli nie urodzone na miejscu)</small></label>
                        <input type="text" class="form-control" " id="input" value="{{$animal[0]['old_farm_id']}}" name="old_farm_id" placeholder="Numer starej farmy"> @error('old_farm_id')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="input">Numer satarego miejsca<small class="text-danger">(wymagane jeśli nie urodzone na miejscu)</small></label>
                        <input  type="text" class="form-control" id="input" value="{{$animal[0]['old_place_id']}}" name="old_place_id" placeholder="Numer satarego miejsca">
                        @error('old_place_id')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="input">Imie starego właściciela<small class="text-danger">(wymagane jeśli nie urodzone na miejscu)</small></label>
                        <input type="text" class="form-control" id="input" value="{{$animal[0]['old_name']}}" name="old_name" placeholder="Imie starego właściciela">
                     
                    </div>
                    <div class="col-sm-6">
                        <label for="input">Nazwisko starego właściciela<small class="text-danger">(wymagane jeśli nie urodzone na miejscu)</small></label>
                        <input  type="text"  class="form-control" id="input" value="{{$animal[0]['old_surname']}}" name="old_surname" placeholder="Nazwisko starego właściciela">
                     
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="input">Płeć <small class="text-danger">(wymagane)</small></label>
                        <input type="text" class="form-control" id="input" value="{{$animal[0]['sex']}}" name="sex" placeholder="Płeć">
                         @error('sex')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="input">Rasa<small class="text-danger">(wymagane)</small></label>
                        <input  type="text" class="form-control" id="input" value="{{$animal[0]['breed']}}" name="breed" placeholder="Rasa">
                        @error('breed')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="input">Numer matki <small class="text-danger">(wymagane)</small></label>
                        <input type="text" class="form-control" id="input" name="number_mother" value="{{$animal[0]['number_mother']}}" placeholder="Numer matki"> @error('number_mother')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="input">Numer ojca<small class="text-danger">(wymagane)</small></label>
                        <input  type="text" class="form-control" id="input" name="number_father" value="{{$animal[0]['number_father']}}" placeholder="Numer ojca">
                        @error('number_father')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Data urodzenia<small class="text-danger">(wymagane)</small></label>
                        <input type="date" class="form-control" value="{{substr($animal[0]['date_birth'],0,-9)}}" name="date_birth">
                          @error('date_birth')
                        <small  class=" text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label >Data oznakowania(kolczykowanie)<small class="text-danger">(wymagane)</small></label>
                        <input type="date" class="form-control" value="{{substr($animal[0]['date_marking'],0,-9)}}" name="date_marking">
                        @error('date_marking')
                        <small  class=" text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Data śmierci(naturalna)</label>
                        <input type="date"  class="form-control" value="{{substr($animal[0]['natural_death'],0,-9)}}" name="natural_death" >
                    </div>
                    <div class="col-sm-6">
                        <label >Data uboju</label>
                        <input type="date"  class="form-control" value="{{substr($animal[0]['slaughter_date'],0,-9)}}" name="slaughter_date" >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label >Opis zwierzęcia</label>
                        <textarea type='text' rows="4" class="form-control"  name="description" placeholder="Opis produktu">{{$animal[0]['description']}}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary px-4 float-right">Zatwierdz zmiany</button><br><br>
                <a class="btn btn-success px-4 float-right" href="/animals">Wróć do listy zwierząt</a>
            </form>
        </div>
    </div>
</div>

@endsection
