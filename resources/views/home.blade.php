@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Find your sweet hart</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <br>
                        <a href="match">
                            <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner mx-auto" style="  height: 600px;">
                                            <div class="carousel-item active"  >
                                                <div class="card" >

                                                    <img class="d-block w-100" src="{{$user[0]->profile->getPicture()}}" alt="First slide">
                                                </div>

                                            </div>
                                            <div class="carousel-item">
                                                <div class="card"  >
                                                    <img class="d-block w-100 " src="{{$user[1]->profile->getPicture()}}" alt="Second slide">

                                                </div>

                                            </div>
                                            <div class="carousel-item">
                                                <div class="card"  >
                                                    <img class="d-block w-100" src="{{$user[2]->profile->getPicture()}}" alt="Third slide">
                                                </div>

                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>

                                </div>

                            </div>
                        </a>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
