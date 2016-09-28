@extends('skeleton')

@section('content')
	<div class="wrapper">
		<h4 class="sub-title">Fluid Container</h4>

		<!-- <p>Fluid Countainer is a Container whose length is <strong>always 100%</strong>. This container can be used to form a website application to further maximize the use of screen spaces and fill the screen spaces with more usefull information. This container can somehow hard to maintain, because all the screen element inside this contianer will need to addapt on every size of the browser size.</p> -->

		<div class="panel-group" id="accordion1">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne">
          <i class="fa fa-user fa-fw"></i>Full Name
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
        Full Name: <input type="text" ng-model="user.name" placeholder="Full Name" />
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo">
          <i class="fa fa-star fa-fw"></i>Occupation
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        Occupation: <input type="text" ng-model="user.occupation" placeholder="Occupation" />
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion1" href="#collapseThree">
          <i class="fa fa-comment fa-fw"></i>Email</a>
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        Email: <input type="text" ng-model="user.email" placeholder="Email-ID" />
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion1" href="#collapseFour">
          <i class="fa fa-hand-o-right fa-fw"></i>Personal Link 1
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse">
      <div class="panel-body">
        http://<input type="text" ng-model="user.link1" placeholder="Personal Link-1" />
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion1" href="#collapseFive">
          <i class="fa fa-hand-o-right fa-fw"></i>Personal Link 2
        </a>
      </h4>
    </div>
    <div id="collapseFive" class="panel-collapse collapse">
      <div class="panel-body">
        http://<input type="text" ng-model="user.link2" placeholder="Personal Link-2" />
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion1" href="#collapseSix">
          <i class="fa fa-picture-o fa-fw"></i>Company Logo
        </a>
      </h4>
    </div>
    <div id="collapseSix" class="panel-collapse collapse">
      <div class="panel-body">
        http://<input type="text" ng-model="user.companylogo" placeholder="Company Logo URL" />
      </div>
    </div>
  </div>
</div>


<div class="panel-group" id="accordion2">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion2" href="#collapseSeven">
          <i class="fa fa-qrcode fa-fw"></i>Card Gradient Color
        </a>
      </h4>
    </div>
    <div id="collapseSeven" class="panel-collapse collapse in">
      <div class="panel-body">
        From: <input type="color" ng-model="user.color1" placeholder="Card Color1" />&nbsp;
        To: <input type="color" ng-model="user.color2" placeholder="Card Color2" />
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion2" href="#collapseEight">
          <i class="fa fa-angle-right fa-fw"></i>Text Color 1
        </a>
      </h4>
    </div>
    <div id="collapseEight" class="panel-collapse collapse">
      <div class="panel-body">
        Text-Color 1: <input type="color" ng-model="user.textcolor1" placeholder="Text-Color 1" />
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion2" href="#collapseNine">
          <i class="fa fa-angle-right fa-fw"></i>Text Color 2
        </a>
      </h4>
    </div>
    <div id="collapseNine" class="panel-collapse collapse">
      <div class="panel-body">
        Text-Color 2: <input type="color" ng-model="user.textcolor2" placeholder="Text-Color 2" />
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion2" href="#collapseTen">
          <i class="fa fa-twitter fa-fw"></i>Twitter
        </a>
      </h4>
    </div>
    <div id="collapseTen" class="panel-collapse collapse">
      <div class="panel-body">
        twitter.com/<input type="text" ng-model="user.tusername" placeholder="Twitter Username" />
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion2" href="#collapseEleven">
          <i class="fa fa-facebook fa-fw"></i>Facebook
        </a>
      </h4>
    </div>
    <div id="collapseEleven" class="panel-collapse collapse">
      <div class="panel-body">
        facebook.com/<input type="text" ng-model="user.fusername" placeholder="Facebook Profile" />
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion2" href="#collapseTwelve">
          <i class="fa fa-google-plus fa-fw"></i>Google+
        </a>
      </h4>
    </div>
    <div id="collapseTwelve" class="panel-collapse collapse">
      <div class="panel-body">
        google.com/<input type="text" ng-model="user.gusername" placeholder="Google+ Profile" />
      </div>
    </div>
  </div>
</div>

	</div>
@endsection

@section('contextual')
@endsection