@extends('layouts.master')
@section('title_content')
    Dodaj do zwierzę
@endsection
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <form action="addanimal" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="input">Numer Zwierzęcia<small class="text-danger">(wymagane)</small></label>
                        <input type="text" class="form-control" id="input"  name="animal_id" placeholder="Numer Zwięrzęcia"> @error('animal_id')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="input">Numer Farmy<small class="text-danger">(wymagane)</small></label>
                        <input type="text" class="form-control" id="input"  name="farm_id" placeholder="Numer Farmy"> @error('farm_id')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="input">Numer siedziby<small class="text-danger">(wymagane)</small></label>
                        <input  type="text" class="form-control"  id="input" name="place_id" placeholder="Numer miejsca">
                        @error('place_id')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="check_number" id="customCheckbox1">
                            <label for="customCheckbox1" class="custom-control-label">Urodzone na miejscu<small class="text-danger">(wymagane jeśli puste pola starej farmy i siedziby)</small></label>
                          </div></p>
                         @error('check_number')
                       <small  class=" text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="input">Numer starej farmy<small class="text-danger">(wymagane jeśli nie urodzone na miejscu)</small></label>
                        <input type="text" class="form-control" " id="input" name="old_farm_id" placeholder="Numer starej farmy"> @error('old_farm_id')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="input">Numer starej siedziby<small class="text-danger">(wymagane jeśli nie urodzone na miejscu)</small></label>
                        <input  type="text" class="form-control" id="input" name="old_place_id" placeholder="Numer satarego miejsca">
                        @error('old_place_id')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="input">Imie starego właściciela<small class="text-danger">(wymagane jeśli nie urodzone na miejscu)</small></label>
                        <input type="text" class="form-control" id="input" name="old_name" placeholder="Imie starego właściciela">
                        @error('old_name')
                        <small  class=" text-danger">{{$message}}</small>
                    @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="input">Nazwisko starego właściciela<small class="text-danger">(wymagane jeśli nie urodzone na miejscu)</small></label>
                        <input  type="text"  class="form-control" id="input" name="old_surname" placeholder="Nazwisko starego właściciela">
                        @error('old_surname')
                        <small  class=" text-danger">{{$message}}</small>
                    @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="input">Płeć <small class="text-danger">(wymagane)</small></label>
                        <input type="text" class="form-control" id="input" name="sex" placeholder="Płeć">
                         @error('sex')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="input">Rasa<small class="text-danger">(wymagane)</small></label>
                        <input  type="text" class="form-control" id="input" name="breed" placeholder="Rasa">
                        @error('breed')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="input">Numer matki <small class="text-danger">(wymagane)</small></label>
                        <input type="text" class="form-control" id="input" name="number_mother" placeholder="Numer matki"> @error('number_mother')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="input">Numer ojca<small class="text-danger">(wymagane)</small></label>
                        <input  type="text" class="form-control" id="input" name="number_father" placeholder="Numer ojca">
                        @error('number_father')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Data urodzenia<small class="text-danger">(wymagane)</small></label>
                        <input type="date" class="form-control" name="date_birth">
                          @error('date_birth')
                        <small  class=" text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label >Data oznakowania(kolczykowanie)<small class="text-danger">(wymagane)</small></label>
                        <input type="date" class="form-control"  name="date_marking">
                        @error('date_marking')
                        <small  class=" text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Data śmierci(naturalna)</label>
                        <input type="date"  class="form-control"  name="natural_death" >
                    </div>
                    <div class="col-sm-6">
                        <label >Data uboju</label>
                        <input type="date"  class="form-control"  name="slaughter_date" >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label >Opis zwierzęcia</label>
                        <textarea type='text' rows="4" class="form-control"  name="description" placeholder="Opis produktu"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary px-4 float-right">Dodaj zwierzę</button>
            </form>
        </div>
    </div>
</div>


@endsection
