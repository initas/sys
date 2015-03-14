@extends('securhat/v1b0/lp/layouts/master.php')
@section('content')
	<div class="content" id="welcome">
		<div class="container">
			<div class="dim">
				<div id="login">
					<div class="item">
						<center>
							<img src="{{URL::to('img/stock/'.V_URL.'/logo.png')}}">
							<h1>~SECURHAT~</h1>
						</center>
						<form role="form" action="/module/sign/sign-in.php" method="post">
							<div class="form-group">
								<input id="username" type="text" name="username" class="form-control" placeholder="Username / Email Address"/>
							</div>
							<div class="form-group">
								<input id="password" type="password" name="password" class="form-control" placeholder="Password"/>
							</div>
							<input type="submit" name="Submit" value="Sign In" class="btn btn-success btn-block" />
							<a href="/user/fb" class="btn btn-primary btn-block">Login With Facebook</a>
						</form>
						<div><a class="pointer" data-toggle="modal" data-target="#sign-up">Sign Up Now &raquo;</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="pattern content" id="berbagi">
		<div class="container">
			<h1 class="item-title">Sebuah Curahan Hati </h1>
			<p class="item-descr">Ayo bergabung dengan Securhat.com untuk berbagi bersama 2000 user yang telah terdaftar. Curahkan isi hati kamu dan temukan yang sehati dengan Kamu!</p>
			<div class="row">
				<div class="col-md-3">
					<div class="item">
						<div class="item-img"><img src="{{URL::to('img/stock/'.V_URL.'/berbagi/status_01.png')}}"></div>
						<div class="item-title">716</div>
						<div class="item-descr">Curhat</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="item">
						<div class="item-img"><img src="{{URL::to('img/stock/'.V_URL.'/berbagi/status_02.png')}}"></div>
						<div class="item-title">270</div>
						<div class="item-descr">Hati</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="item">
						<div class="item-img"><img src="{{URL::to('img/stock/'.V_URL.'/berbagi/status_03.png')}}"></div>
						<div class="item-title">20.000</div>
						<div class="item-descr">View</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="item">
						<div class="item-img"><img src="{{URL::to('img/stock/'.V_URL.'/berbagi/status_04.png')}}"></div>
						<div class="item-title">3.000</div>
						<div class="item-descr">Komentar</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="content" id="diskusi">
		<div class="container">
			<h2 class="item-title">Ayo Diskusi</h2>
			<p class="item-descr">
				Di Securhat, diskusi jadi lebih mudah.
				Curahkan cerita kamu, dapatkan respon dari para komunitas hati, pilih mana solusi yang cocok buat kamu.
			</p>
			<div class="row">
				<div class="col-md-4">
					<div class="item">
						<div class="item-img"><img src="{{URL::to('img/stock/'.V_URL.'/diskusi/1.jpg')}}"></div>
						<div class="item-title">Curahkan</div>
						<div class="item-descr">Curahkan isi hati Kamu. Baik itu momen bahagia ataupun kenangan indah, karena curhat tidak harus selalu menceritakan kesedihan.</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="item">
						<div class="item-img"><img src="{{URL::to('img/stock/'.V_URL.'/diskusi/2.jpg')}}"></div>
						<div class="item-title">Respon</div>
						<div class="item-descr">Dapatkan respon para Curhater dan teman-teman sehati, berupa komentar ataupun jawaban dari curhatan Kamu.</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="item">
						<div class="item-img"><img src="{{URL::to('img/stock/'.V_URL.'/diskusi/3.jpg')}}"></div>
						<div class="item-title">Solusi</div>
						<div class="item-descr">Jika mendapatkan respon yang disukai, Kamu dapat memilih respon tersebut sebagai "solusi" atau "jawaban" dari curhatan Kamu.</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="pattern content" id="sehati">
		<div class="container">
			<h2 class="item-title">Temukan Yang Sehati</h2>
			<div class="item-btn">
				<div class="btn-group">
					<button class="btn btn-default">Terbaru</button>
					<button class="btn btn-default">Aktif</button>
					<button class="btn btn-default">Populer</button>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<div class="item">
						<div class="item-img square" style="background-image:url('{{URL::to('img/stock/'.V_URL.'/user/p11.jpg')}}')"></div>
						<div class="item-title">hikeno</div>
						<div class="item-descr">15 Sehati</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="item">
						<div class="item-img square" style="background-image:url('{{URL::to('img/stock/'.V_URL.'/user/p12.jpg')}}')"></div>
						<div class="item-title">julie.howard</div>
						<div class="item-descr">39 Sehati</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="item">
						<div class="item-img square" style="background-image:url('{{URL::to('img/stock/'.V_URL.'/user/p13.jpg')}}')"></div>
						<div class="item-title">lydia.flores</div>
						<div class="item-descr">359 Sehati</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="item">
						<div class="item-img square" style="background-image:url('{{URL::to('img/stock/'.V_URL.'/user/p14.jpg')}}')"></div>
						<div class="item-title">yolanda.cruz</div>
						<div class="item-descr">252 Sehati</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="item">
						<div class="item-img square" style="background-image:url('{{URL::to('img/stock/'.V_URL.'/user/p15.jpg')}}')"></div>
						<div class="item-title">levi.crawford</div>
						<div class="item-descr">75 Sehati</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="item">
						<div class="item-img square" style="background-image:url('{{URL::to('img/stock/'.V_URL.'/user/p16.jpg')}}')"></div>
						<div class="item-title">audrey.stevens</div>
						<div class="item-descr">125 Sehati</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="content" id="kontak">
		<div class="container">
			<h2 class="item-title">Kontak Kami</h2>
			<p class="item-descr">
				Jika Kamu memiliki pertanyaan, saran, ataupun kritik. Segera hubungi kami di cs@securhat.com dengan mengisi form berikut.
			</p>
			<div class="row">
				<div class="col-md-6">
					<div class="map-container hidden-xs hidden-sm">
						<div id="map-canvas">asdasdasd</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="item-form">
						<form role="form">
							<div class="form-group">
								<label>Email</label>
								<input name="email" type="text" class="form-control" value="">
							</div>
							<div class="form-group">
								<label>Judul</label>
								<input name="title" type="text" class="form-control" value="">
							</div>
							<div class="form-group">
								<label>Deskripsi</label>
								<textarea name="description" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-success btn-block">Kirim</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop