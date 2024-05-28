@extends('layouts.bodyAuth')
@section('links')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/css/multi-select-tag.css">
@endsection
@section('body')

<div class="row m-0">
    <div class="col-12 p-0">
        <div class="login-card login-dark">
        <div>
            <div><a class="logo" href=""><img class="img-fluid for-light w-25" src="{{asset("images/logo/landing_page.png")}}" alt="looginpage"><img class="img-fluid for-dark" src="{{asset("assets/images/logo/logo_dark.png")}}" alt="looginpage"></a></div>
            <div class="login-main" style="width: 600px">
             <form class="theme-form" method="POST" action="{{route('register.active')}}">
                @csrf
                <input type="hidden" name="idDoc" value="{{$id}}">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Continue registration Dc. {{$parametre->doctor->fname}}</h3>
                    </div>
                    <div class="col-md-12 mt-2">
                        <label class="form-label" for="validationTooltip04">Motifs <span class="text-danger">*</span></label>
                        <select name="motifs[]" multiple class="form-select @error('motifs') is-invalid @enderror" id="speciality" >
                            @foreach ($specialities as $speciality)
                                <optgroup label="{{ $speciality->name_sp }}">
                                    @foreach ($motifs as $motif)
                                        @if ($motif->speciality_id == $speciality->id)
                                            <option value="{{ $motif->id }}">{{ $motif->nom_motif }}</option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        @error('motifs')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <div class="col-md-8 mt-2">
                        <label class="form-label" >Adress du cabinet<span class="txt-danger">*</span></label>
                        <input class="form-control @error('adresse') is-invalid @enderror" value="{{old("adresse")}}" name="adresse"  type="text" >
                        @error('adresse')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-2">
                        <label class="form-label" >Zip Code<span class="txt-danger">*</span></label>
                        <input class="form-control @error('zip_code') is-invalid @enderror" value="{{old("zip_code")}}" name="zip_code"  type="number" >
                        @error('zip_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12 mt-2">
                        <label class="form-label" for="validationTooltip04">languages speak<span class="text-danger">*</span></label>
                        <select data-live-search="true" name="languages[]" multiple class="form-select @error('languages') is-invalid @enderror" id="languages">
                            <option disabled>Choose...</option>
                            <option value="anglais">Anglais</option>
                            <option value="arabe">Arabe</option>
                            <option value="espagnol">Espagnol</option>
                            <option value="francais">Français</option>
                        </select>
                        @error('languages')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                </div>
                <div class="form-group mb-0">
                    <button class="btn btn-primary btn-block w-100 mt-4 " type="submit">Create Account</button>
                </div>

            </form>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/js/multi-select-tag.js"></script>
<script>
    // new MultiSelectTag('speciality')  // id
    new MultiSelectTag('languages')  // id
</script>


@endsection
