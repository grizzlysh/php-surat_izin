<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Surat Izin</title>
    <?php $this->load->view("partials/head.php") ?>
</head>

<body> 
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-body">
                    <br>
                    <center><div class="border-slate-300 text-slate-300"><a class="navbar-brand-center" href="<?php echo site_url('dashboard') ?>">
                    <img width="120" height="35" src="<?php echo base_url('assets/img/logo.png') ?>"/></a></div>
                    
                        
                        <h3 class="panel-heading">Masuk Surat Izin<small class="display-block"><br>
							Silahkan Masuk</small></h3></center>
                    </div>
                    <div class="panel-body">
                        <?php if(isset($error)) { echo $error; }; ?>
                        <form role="form" method="POST" action="<?php echo site_url('login');?>">
                            <fieldset>
                                <div class="form-group has-feedback has-feedback-left">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus required>
                                    <div class="form-control-feedback">
									    <i class="glyphicon glyphicon-user text-muted"></i>
								    </div>
                                    <?php echo form_error('username'); ?>
                                </div>
                                <div class="form-group has-feedback has-feedback-left">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
                                    <div class="form-control-feedback">
									    <i class="glyphicon glyphicon-lock text-muted"></i>
								    </div>
                                    <?php echo form_error('password'); ?>
                                </div>
                                <div class="checkbox">
                                    <!-- <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label> -->
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <!-- <a href="index.html" class="btn btn-lg btn-success btn-block">Login</a> -->

                                <button class="btn btn-primary btn-m btn-block" name="btn-login" id="btn-login" type="submit">
                                Masuk <i class = "glyphicon glyphicon-log-in"></i></button>
                                <div id="error" style="margin-top: 10px"></div>
                                <!-- <a href="#" class="pull-right need-help"> Need Help? </a><span class="clearfix"></span>
                                <a href="#" class="text-center new-account"> Create Account </a> -->
                                <div id="error" style="margin-top: 10px"></div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sticky Footer -->
		<?php $this->load->view("partials/footer.php") ?>
    <!-- jQuery -->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../assets/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../assets/dist/js/sb-admin-2.js"></script>

</body>

</html>