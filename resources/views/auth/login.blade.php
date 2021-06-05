@extends('layouts.app')

@section('content')




<section class="body-sign">
    <div class="center-sign">
        <a href="http://preview.oklerthemes.com/" class="logo pull-left">
            <img src="{{ url('public') }}/assets/images/gpsjnisi.png" height="94" alt="Porto Admin" />
        </a>

        <div class="panel panel-sign">
            <div class="panel-title-sign mt-xl text-right">
                <h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Ingreso</h2>
            </div>
            <div class="panel-body">
                <form action="{{ url('/login') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} mb-lg">
                        <label>Email</label>
                        <div class="input-group input-group-icon">
                            <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-control input-lg" required autofocus/>
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
                        </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif

                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} mb-lg">
                        <div class="clearfix">
                            <label class="pull-left">Password</label>

                        </div>
                        <div class="input-group input-group-icon">
                            <input name="password" id="password" type="password" class="form-control input-lg" required/>
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <a href="{{ url('/password/reset') }}" class="pull-right reset">Perdiste tu contraseña?</a>
                    </div>

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="checkbox-custom checkbox-default">
                                <input id="Remember" name="remember" type="checkbox"/>
                                <label for="RememberMe">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-sm-4 text-right">
                            <button type="submit" class="btn btn-primary hidden-xs">Ingresar</button>
                            <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Ingresar</button>
                        </div>
                    </div>



                </form>
            </div>
        </div>

        <p class="text-center text-muted mt-md mb-md">Gps Jnisi &copy; Copyright 2016. All Rights Reserved.</p>
    </div>
</section>
@endsection
