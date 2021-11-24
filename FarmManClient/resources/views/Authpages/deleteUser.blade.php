@extends('layouts.master')
@section('title_content')
    Usuwanie konta
@endsection
@section('content')
<div class="container">
   @if (session('message'))
    <div class="alert alert-danger" role="alert">
        {{session('message')}}
      </div>
    @endif
    <table class="table ">
       <tbody>
          <tr>
             <td colspan="1">
                <form class="well form-horizontal" method="POST" action="deleteUser">
                   @csrf
                   <fieldset>
                      <div class="form-group">
                         <label class="col-md-4 control-label">Hasło <small class="text-danger">(wymagane)</small></label>
                         <div class="col-md-8 inputGroupContainer">
                            <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input   placeholder="Hasło" class="form-control"  v name="password"' type="password"></div>
                          @error('password')
                      <div class="alert alert-danger" role="alert">
                       {{ $message }}
                      </div>
                      @enderror
                    </div>
                    </div>
                      <div class="form-group">
                         <label class="col-md-4 control-label">Potwierdz hasło <small class="text-danger">(wymagane)</small></label>
                         <div class="col-md-8 inputGroupContainer">
                            <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span><input type="password" placeholder="Potwierdz Hasło" class="form-control" value="" name="confirm_password">
                     </div>
                     @error('confirm_password')
                     <div class="alert alert-danger" role="alert">
                      {{ $message }}
                     </div>
                     @enderror
                      <br>
                      <div class="form-group">
                   <button    class="btn btn-danger btn-lg btn-block" type="text">Usuń Konto</button></div>
                        </div>
                     </div>
                   </fieldset>
                </form>
             </td>
             
          </tr>
       </tbody>
    </table>
 </div>
@endsection