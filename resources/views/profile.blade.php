@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Your Profile</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="card mb-3" style="max-width: 100%;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{$user->profile->getPicture()}}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$user->profile->name}} {{$user->profile->surname}}</h5>
                                        <br>
                                        <p>Age : {{$user->profile->age}}</p>
                                        <p>Gender : {{$user->profile->gender}}</p>
                                        <p>Location : {{$user->profile->location}}</p>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#editProfileModal">
                            Edit Profile
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog"
                             aria-labelledby="editProfileModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{route('profile.update')}}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label for="picture">Picture</label>
                                                <input type="file" class="form-control-file" id="picture"
                                                       name="picture">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" class="form-control" id="name"
                                                       value="{{old('name',$user->profile->name)}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="surname">Surname</label>
                                                <input type="text" name="surname" class="form-control" id="surname"
                                                       value="{{old('surname',$user->profile->surname)}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="age">Age</label>
                                                <input type="text" name="age" class="form-control" id="age"
                                                       value="{{old('age',$user->profile->age)}}">
                                            </div>

                                            <div class="form-group">
                                                <label for="gender">Gender</label>
                                                <select class="form-control" id="gender" name="gender">
                                                    <option>{{old('gender',$user->profile->gender)}}</option>
                                                    @if ($user->profile->gender === 'Male')
                                                        <option>Female</option>
                                                    @elseif($user->profile->gender === 'Female')
                                                        <option>Male</option>
                                                    @else($user->profile->gender === null)
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="location">Location</label>
                                                <input type="text" name="location" class="form-control" id="location"
                                                       value="{{old('location',$user->profile->location)}}">
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
@endsection
