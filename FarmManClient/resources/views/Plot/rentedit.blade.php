@extends('layouts.master')
@section('title_content')
    Edycja dzierżawy
@endsection
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <form action="editrent" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label ">Początek dzierżawa <small class="text-danger">(wymagane)</small></label>
                        <input  value="{{$rent[0]['id']}}" name="rent_id" hidden>
                        <input type="date" class="form-control" value="{{substr($rent[0]['start_rent'],0,-9)}}" name="start_rent"> @error('start_rent')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                    <div class="col-sm-6">
                        <label ">Koniec dzierżawy<small class="text-danger">(wymagane)</small></label>
                        <input type="date" class="form-control" value="{{substr($rent[0]['end_date'],0,-9)}}" name="end_date" >
                        @error('end_date')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Koszt dzierżawy(miesięcznie)w zł <small class="text-danger">(wymagane)</small></label>
                        <input type="number" min="0" value="{{$rent[0]['ground_rent_cost']}}" class="form-control" name="ground_rent_cost" placeholder="Koszt dzierżawy w zł">
                        @error('ground_rent_cost')
                        <small  class=" text-danger">{{$message}}</small>
                    @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="">Czas trwania dzierżawy</label>
                        <div class="alert alert-info" role="alert">
                            @if ($rent[0]['year_rent']!=0)
                                Lat:<strong>{{$rent[0]['year_rent']}}</strong>,
                            @endif
                            @if ($rent[0]['date_time_month']!=0)
                                Miesięcy:<strong>{{$rent[0]['date_time_month']}}</strong>,
                            @endif
                            @if ($rent[0]['date_time_days']!=0)
                                Dni:<strong>{{$rent[0]['date_time_days']}}</strong>
                            @endif
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary px-4 float-right">Aktualizuj dzierżawę</button><br><br>
                <a class="btn btn-success px-4 float-right" href="/plots">Wróć do listy działek</a>
            </form>
        </div>
    </div>
</div>
@endsection
