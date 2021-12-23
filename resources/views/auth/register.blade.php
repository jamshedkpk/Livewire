<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    .register {
        background: -webkit-linear-gradient(left, #3931af, #00c6ff);
        padding: 3%;
    }

    .register-left {
        text-align: center;
        color: #fff;
        margin-top: 4%;
    }

    .register-left input {
        border: none;
        border-radius: 1.5rem;
        padding: 2%;
        width: 60%;
        background: #f8f9fa;
        font-weight: bold;
        color: #383d41;
        margin-top: 30%;
        margin-bottom: 3%;
        cursor: pointer;
    }

    .register-right {
        background: #f8f9fa;
        border-top-left-radius: 10% 50%;
        border-bottom-left-radius: 10% 50%;
    }

    .register-left img {
        margin-top: 15%;
        margin-bottom: 5%;
        width: 25%;
        -webkit-animation: mover 2s infinite alternate;
        animation: mover 1s infinite alternate;
    }

    @-webkit-keyframes mover {
        0% {
            transform: translateY(0);
        }

        100% {
            transform: translateY(-20px);
        }
    }

    @keyframes mover {
        0% {
            transform: translateY(0);
        }

        100% {
            transform: translateY(-20px);
        }
    }

    .register-left p {
        font-weight: lighter;
        padding: 12%;
        margin-top: -9%;
    }

    .register .register-form {
        padding: 10%;
        margin-top: 10%;
    }

    .btnRegister {
        float: right;
        margin-top: 10%;
        border: none;
        border-radius: 1.5rem;
        padding: 2%;
        background: #0062cc;
        color: #fff;
        font-weight: 600;
        width: 50%;
        cursor: pointer;
    }

    .register .nav-tabs {
        margin-top: 3%;
        border: none;
        background: #0062cc;
        border-radius: 1.5rem;
        width: 28%;
        float: right;
    }

    .register .nav-tabs .nav-link {
        padding: 2%;
        height: 34px;
        font-weight: 600;
        color: #fff;
        border-top-right-radius: 1.5rem;
        border-bottom-right-radius: 1.5rem;
    }

    .register .nav-tabs .nav-link:hover {
        border: none;
    }

    .register .nav-tabs .nav-link.active {
        width: 100px;
        color: #0062cc;
        border: 2px solid #0062cc;
        border-top-left-radius: 1.5rem;
        border-bottom-left-radius: 1.5rem;
    }

    .register-heading {
        text-align: center;
        margin-top: 8%;
        margin-bottom: -15%;
        color: #495057;
    }
</style>
<div class="container-fluid register" style="background-color:" #3834B0>
    <div class="row">
        <div class="col-md-3 register-left">
            <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt="" />
            <h3>Welcome</h3>
            <p>You are 30 seconds away from earning your own money!</p>
            <a href="{{route('login')}}" class="btn btn-success btn-block">LogIn</a>
        </div>
        <div class="col-md-9 register-right">
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="{{route('register')}}" role="tab" aria-controls="home" aria-selected="true">Registration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="{{route('login')}}" role="tab" aria-controls="profile" aria-selected="false">LogIn</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h3 class="register-heading">Welcome to the Registration section</h3>
                    <form action="{{route('register')}}" method="POST">
                        @csrf
                        <div class="row register-form">
                            <div class="col-md-8 offset-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Please enter your Name" name="name" />
                                    @error('name')
                                    <span>
                                    {{$message}}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8 offset-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Please enter your Email" name="email" />
                                    @error('email')
                                    <span>
                                    {{$message}}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8 offset-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Please enter your Password" name="password"/>
                                    @error('password')
                                    <span>
                                    {{$message}}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8 offset-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Please confirm your Password" name="password_confirmation"/>
                                    @error('password_confirmation')
                                    <span>
                                    {{$message}}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8 offset-2">
                            <div class="form-group">
                            <button class="btn btn-primary btn-block">Register</button>    
                            </div>
                            </div>
                        </div>
                    </form>
                    </div>
                <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <h3 class="register-heading">Apply as a Hirer</h3>
                    <div class="row register-form">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="First Name *" value="" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Last Name *" value="" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email *" value="" />
                            </div>
                            <div class="form-group">
                                <input type="text" maxlength="10" minlength="10" class="form-control" placeholder="Phone *" value="" />
                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="`Answer *" value="" />
                            </div>
                            <input type="submit" class="btnRegister" value="Register" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>