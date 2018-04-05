@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body text-center" id="registerbuttons">
                    <button class="btn btn-success employee"><i class="fas fa-user"></i> Register as an employee</button>
                    <button class="btn btn-danger owner"><i class="fas fa-briefcase"></i> Register the company</button>
                </div>

                <div class="panel-body roles" style="display:none;" id="divemployee">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Full Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('company_email') ? ' has-error' : '' }}">
                                <label for="company_email" class="col-md-4 control-label">Company E-Mail Address</label>
    
                                <div class="col-md-6">
                                    <input id="company_email_check" type="email" class="form-control" name="company_email" value="{{ old('company_email') }}" required>
    
                                    @if ($errors->has('company_email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('company_email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                                <button class="btn btn-danger backness">
                                    Back
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="panel-body roles" style="display:none;" id="divowner">
                    <form class="form-horizontal" method="POST" action="{{url('/registercompany')}}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                                <label for="company_name" class="col-md-4 control-label">Company Name</label>

                                <div class="col-md-6">
                                    <input id="company_name" type="text" class="form-control" name="company_name" value="{{ old('company_name') }}" required autofocus>

                                    @if ($errors->has('company_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('company_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                        <div class="form-group{{ $errors->has('company_email') ? ' has-error' : '' }}">
                                <label for="company_email" class="col-md-4 control-label">Company E-Mail Address</label>
    
                                <div class="col-md-6">
                                    <input id="company_email" type="email" class="form-control" name="company_email" value="{{ old('company_email') }}" required>
    
                                    @if ($errors->has('company_email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('company_email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                                <button class="btn btn-danger backness">
                                    Back
                                </button>
                            </div>
                        </div>
                    </form>
                </div>    
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $('.employee').on('click', function(){
        $('#registerbuttons').hide();
        $('#divemployee').show();
    })

    $('.owner').on('click',function(){
        $('#registerbuttons').hide();
        $('#divowner').show();
    })

    $('.backness').on('click',function(){
        $('.roles').hide();
        $('#registerbuttons').show();
    })

    $('#company_email_check').keyup(function(){
        var emailText = $(this).val();
        $.post('/registercompany_check',
        { company_email: emailText, 
          _token: "{{csrf_token()}}" },
        function(data, status) {
            console.log('Processed: ' + data);
        
        });
    })
</script>
@endsection
