@extends('layouts.master')
@section('title_content')
    Dodaj Pracę
@endsection
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <form action="/putwork" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-12">
                      
                        <input value="{{$work[0]['id']}}" name="idwork" hidden>
                        <input value="{{$work[0]['plotId']}}" name="plot_id" hidden>
                        <label>Opis pracy:<small class="text-danger">(wymagane)</small></label>
                        <textarea type="text" rows="4" class="form-control"  name="description" placeholder="Opis pracy nadziałce">{{$work[0]['work_description']}}</textarea>@error('description')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label >Od:<small class="text-danger">(wymagane)</small></label>
                        <input type="date"  class="form-control" value="{{substr($work[0]['start_working'],0,-9)}}" name="start_working">
                        @error('start_working')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                    <div class="col-sm-4">
                        <label >Do:<small class="text-danger">(wymagane)</small></label>
                        <input type="date" value="{{substr($work[0]['end_working'],0,-9)}}"  class="form-control" name="end_working">
                        @error('end_working')
                       <small  class=" text-danger">{{$message}}</small>
                   @enderror
                    </div>
                    <div class="col-sm-4">
                        <label for="">Status<small class="text-danger">(wymagane)</small></label>
                        <select class="form-control"  name="status">
                            <option value="{{$work[0]['status']}}"   selected>{{$work[0]['status']}}</option> 
                            <option value="Nie rozpoczęte"  >Nie rozpoczęte</option> 
                            <option value="W trakcie"  >W trakcie</option> 
                            <option value="Zakończone" >Zakończone</option> 
                          </select> 
                          @error('status')
                        <small  class=" text-danger">{{$message}}</small>
                            @enderror
                    </div>
                   
                </div>
                <button type="submit" class="btn btn-primary px-4 float-right">Aktualizuj</button><br> <br>
                <a class="btn btn-success px-4 float-right" href="/plots/works/{{$work[0]['plotId']}}">Wróć do listy prac</a>
            </form>
        </div>
    </div>
</div>
@endsection