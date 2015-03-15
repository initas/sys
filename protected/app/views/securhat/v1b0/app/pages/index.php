@extends('securhat/v1b0/app/layouts/master.php')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="offset-margin">
					@include('securhat/v1b0/app/widgets/user-preview.php')
					@include('securhat/v1b0/app/widgets/trends.php')
					@include('securhat/v1b0/app/widgets/ranks.php')
					@include('securhat/v1b0/app/widgets/copyright.php')
				</div>
			</div>
			<div class="col-md-7">
				@include('securhat/v1b0/app/templates/composer.php')
				<div class="curhat-container">
					@include('securhat/v1b0/app/templates/curhat.php')
					@include('securhat/v1b0/app/templates/curhat.php')
					@include('securhat/v1b0/app/templates/curhat.php')
				</div>
			</div>
			<div class="col-md-2">
				<div class="offset-margin">
					@include('securhat/v1b0/app/widgets/friends.php')
					@include('securhat/v1b0/app/widgets/friend-requests.php')
					@include('securhat/v1b0/app/widgets/waiting-approval.php')
				</div>
			</div>
		</div>
	</div>
@stop