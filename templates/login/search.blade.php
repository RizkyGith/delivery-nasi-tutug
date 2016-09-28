@extends('skeleton')

@section('content')
	<div class="wrapper">
	
		<div class="ex-login">
                <div class="contentcenter">
                    <div class="middle">
                        <div id="login" class="">
                            <i class="xn xn-lock-open xn-5x"></i>
                            <form method="POST" class="row">
                                <input type="text" name="username" value="" placeholder="Username" class="text">
                                <input type="password" name="password" placeholder="Password" class="password">
                                <input type="submit" value="Login" class="button solid submit">
                                <label class="placeholder"><input type="checkbox" class="checkbox"> Keep me sign in</label>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
	</div>
@endsection

@section('contextual')
@endsection