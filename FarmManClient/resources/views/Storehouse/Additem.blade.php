@extends('layouts.master')
@section('title_content')
    Dodaj do magazynu
@endsection
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <form action="additem" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="input">Nazwa produktu <small class="text-danger">(wymagane)</small></label>
                        <input type="text" class="form-control" id="input" name="name_p" placeholder="Nazwa Produktu"> @error('name_p')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                    <div class="col-sm-4">
                        <label for="input">Waga/ilość<small class="text-danger">(wymagane)</small></label>
                        <input  type="number" min="0" class="form-control" id="input" name="weight" placeholder="Waga">
                        @error('weight')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                
                <div class="col-sm-4">
                    <label for="input">Rodzaj masy(np.Kg,ml,dag...)<small class="text-danger">(wymagane)</small></label>
                    <select class="form-control"  name="categoryUnit">
                        <option value="" disabled selected>Wybierz jedno</option>
                        @foreach ($units as $oneunit)
                            <option value="{{$oneunit['id']}}">{{$oneunit['unit_of_measure']}}</option>
                        @endforeach

                      </select> 
                    @error('categoryUnit')
                   <small  class=" text-danger">{{$message}}</small>
               @enderror
                </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Kategoria materiału<small class="text-danger">(wymagane)</small></label>
                        <select class="form-control"  name="categoryStorehouse">
                            <option value="" disabled selected>Wybierz jedno</option>
                            @foreach ($category as $onecategory)
                            <option value="{{$onecategory['id']}}">{{$onecategory['category']}}</option>
                            @endforeach
                          </select> 
                          @error('categoryStorehouse')
                        <small  class=" text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    
                    <div class="col-sm-6">
                        <label >Data ważności</label>
                        <input type="date" class="form-control"  name="expiry_date" placeholder="Rok produkcji">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Typ oprysku:<small class=' badge badge-info'>Pole specyficzne do materiału danej kategorii</small></label>
                        <input type="text"  class="form-control"  name="type_spray" placeholder="Typ oprysku">
                    </div>
                    <div class="col-sm-6">
                        <label >Typ aplikacji:<small class=' badge badge-info'>Pole specyficzne do materiału danej kategorii</small></label>
                        <input type="text"  class="form-control"  name="application" placeholder="Typ aplikacji">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label >Opis produktu:</label>
                        <textarea type='text' rows="4" class="form-control"  name="description" placeholder="Opis produktu"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary px-4 float-right">Dodaj materiał</button>
            </form>
        </div>
    </div>
</div>


@endsection

