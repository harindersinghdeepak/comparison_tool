    <div id="page-wrapper" class="page-wrapper">
        <div class="col-lg-12">
            <div class="col-lg-4 login_wrapper">
            	<h3 class="text-center login_heading">Comparison Tool</h3>
            	<form name="login_form" action="/manage/login" method="POST">
            		<div class="form-group">
						<label>User name: </label>
						<input type="text" name="username" class="form-control">
					</div>

            		<div class="form-group">
						<label>Password: &nbsp;</label>
						<input type="password" name="password" class="form-control">
            		</div>
            		
            		<?php
            		if ($this->session->flashdata('error'))
            		{
            		?>
	            		<div class="alert alert-danger text-center">
							<strong><?php echo $this->session->flashdata('error'); ?></strong>
						</div>
            		<?php
            		}
            		?>

            		<div class="form-group text-center">
						<input type="submit" name="submit" class="btn btn-flat btn-default iLoginBtn iBlueBtn" value="Log in">
            		</div>
            	</form>
            </div>
        </div>
    </div>
</div>