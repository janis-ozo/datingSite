<?php

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">Matching ...</div>
                    <div class="card-body">
                        @if($history)

                        @else
                            <h3> Keep looking :)... </h3>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


