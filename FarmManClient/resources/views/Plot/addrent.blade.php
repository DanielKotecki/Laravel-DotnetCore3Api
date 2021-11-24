@extends('layouts.master')
@section('title_content')
    Dodaj opcje dzierżawy  do działki.
@endsection
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <form action="/one_addrent" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label ">Początek dzierżawa <small class="text-danger">(wymagane)</small></label>
                        <input value=" {{$plotId}}" name="plot_id" hidden>
                        <input type="date" class="form-control"  name="start_rent"> @error('start_rent')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                    <div class="col-sm-6">
                        <label ">Koniec dzierżawy<small class="text-danger">(wymagane)</small></label>
                        <input type="date" class="form-control"  name="end_date" >
                        @error('end_date')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="">Koszt dzierżawy(miesięcznie)w zł <small class="text-danger">(wymagane)</small></label>
                        <input type="number" min="0"  class="form-control" name="ground_rent_cost" placeholder="Koszt dzierżawy w zł">
                        @error('ground_rent_cost')
                        <small  class=" text-danger">{{$message}}</small>
                    @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary px-4 float-right">Dodaj</button>
            </form>
        </div>
    </div>
</div>
@endsection