<div id="sign-up" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<form class="validate-form" role="form" action="/module/sign/act-sign-up.php" method="post">
		<input type="hidden" name="act" value="save">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="height:50px; background:#ED0058;border-radius:3px 3px 0 0">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4 hidden-sm hidden-xs">
							<div class="form-group">
								<div class="img-featured circle">
									<img src="{{URL::to('img/stock/'.V_URL.'/chat-bg.png')}}" class="circle">
								</div>
								<div class="text-center extra-margin-top-mini">
									<div>Silahkan <a class="pointer internal-link" href="#securhat">Login</a> Jika Sudah Memiliki Akun.</div>
									<div>atau <a href="/forget-password.html">Klik Disini Jika Lupa Password</a>?</div>
								</div>
							</div>
						</div>
						<div class="col-md-8">
							<div>
								<h4 class="modal-title" id="myModalLabel">Bergabung Dengan Kami</h4>
								Securhat memberikan Kamu kebebasan dalam berbagi dan berdiskusi dengan seluruh komunitas hati lainnya. Ayo buka hatimu, saling tukar isi hati dan temukan yang sehati dengan Kamu.
							</div>
							<hr/>
							<div class="form-group">
								<label for="exampleInputEmail1">Username</label> <span class="required-mark" title="Required">*</span>
								<input type="text" class="form-control validate-required validate-unique" data-validate-table="tc_member" data-validate-field="username" id="username" name="username" placeholder="">
							</div>
							<div class="form-group">
								<label for="email">Email address</label> <span class="required-mark" title="Required">*</span>
								<input type="text" class="form-control validate-required validate-email" id="email" name="email" placeholder="">
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="password">Password</label> <span class="required-mark" title="Required">*</span>
										<input type="password" class="form-control validate-required validate-identical" data-validate-identical="#confirm_password" id="password" name="password" placeholder="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="confirm_password">Confirm Password</label> <span class="required-mark" title="Required">*</span>
										<input type="password" class="form-control validate-required" id="confirm_password" name="confirm_password" placeholder="">
									</div>
								</div>
							</div>
							<hr/>
							<div class="alert alert-danger none alert-submit"></div>
							<div class="form-group">
								<button type="submit" class="btn btn-success btn-block" name="is_subscribe">Daftar</button>
							</div>
							<div class="form-group">
								<a href="/user/fb" class="btn btn-primary btn-block">Daftar dengan Facebook</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>