@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">Matching ...</div>
                    <div class="card-body">
                        @if($user)

                            <div class="card mb-3 shadow p-3 mb-5 bg-white rounded" style="max-width: 100%;">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <img src="{{$user->profile->getPicture()}}" class="card-img" alt="...">
                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="card-body ">
                                            <hi>{{$user->id}}</hi>
                                            <h5 class="card-title">{{$user->profile->name}} {{$user->profile->surname}}</h5>
                                            <br>
                                            <p>Age : {{$user->profile->age}}</p>
                                            <p>Gender : {{$user->profile->gender}}</p>
                                            <p>Location : {{$user->profile->location}}</p>
                                            <div class="d-flex">
                                                <form method="post" action="{{route('match.like',$user)}}">
                                                    @csrf
                                                    <button class="m-1" type="submit">Like</button>
                                                </form>

                                                <form method="post" action="{{route('match.dislike',$user)}}">
                                                    @csrf
                                                    <button class="m-1" type="submit">Dislike</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            You checked all users!
                        @endif

                        <div class="mx-auto" style="width: 150px;">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Search settings
                            </button>
                        </div>


                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form method="post" action="{{route('match.settings')}}"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <div class="form-group">
                                                    <label for="minAge">min age</label>
                                                    <input type="text" name="minAge" class="form-control" id="minAge"
                                                           value="{{old('minAge',$authUser->settings->min_age)}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="maxAge">max age</label>
                                                    <input type="text" name="maxAge" class="form-control" id="maxAge"
                                                           value="{{old('maxAge',$authUser->settings->max_age)}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="gender">Gender</label>
                                                    <select class="form-control" id="gender" name="gender">
                                                        <option>{{old('gender',$authUser->settings->gender)}}</option>
                                                        @if ($authUser->settings->gender === 'Male')
                                                            <option>Female</option>
                                                        @elseif($authUser->settings->gender === 'Female')
                                                            <option>Male</option>
                                                        @else($authUser->settings->gender === null)
                                                            <option>Male</option>
                                                            <option>Female</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


