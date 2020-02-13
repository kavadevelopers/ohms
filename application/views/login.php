<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$this->config->config["projectTitle"]?> | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="shortcut icon" href="<?php echo base_url(); ?>image/favicon.png" type="image/png"/>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>font-awesome/css/font-awesome.min.css">
 
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/iCheck/square/blue.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	 <style type="text/css">
		.login-page{
			background: #ffffff;
		}

	</style>
</head>



<body class="hold-transition login-page" >

	<div class="login-box" style="margin-top: 1.5%;">
		<div class="login-logo">
			<a href="<?php echo base_url(); ?>" class="f-color">
				<img style="width: 40%;" src="<?php echo base_url(); ?><?=$this->config->config["logoFile"]?>" alt="<?=$this->config->config["projectName"]?> logo" >
			</a>
		</div>
		  
			<!-- /.login-logo -->
			<div class="card" style="background: #f7f7f7;">
			    <div class="card-body login-card-body">
			      	<p class="login-box-msg">Sign in to start your session</p>

					    <form action="" method="post" id="login">
					        <div class="form-group">
								<input type="text" 


								<?php if(isset($this->input->cookie()['username']) ){ ?> value="<?php echo $this->input->cookie()['username']; ?>" <?php } ?>


								 name="username" id="user" class="form-control" placeholder="User Name" autocomplete="off" required autofocus>
								
					        </div>
					        <div class="form-group has-feedback">
								
								<input type="password" <?php if(isset($this->input->cookie()['password']) ){ ?> value="<?php echo $this->input->cookie()['password']; ?>" <?php } ?> name="password" id="pass" class="form-control" placeholder="Password" required >
								
					        </div>
					        
					        
					        <div class="row">
					          <div class="col-8">
						            <div class="checkbox icheck">
						              	<label style="cursor:pointer;">
						                	<input type="checkbox" id="check" <?php if(isset($this->input->cookie()['username'] ) ){ ?> checked <?php } ?> > Remember Me
						              	</label>
						            </div>
					          </div>
					          
					          	<div class="col-4">
					            	<button type="submit" id="login-button" class="btn btn-primary btn-block btn-flat">Sign In</button>
					         	</div>
					          
					        </div>
					    </form>

				</div>
			<!-- /.login-card-body -->

			<p style="text-align: center;border-top:1px solid #17a2b8;margin: 5px 0;"><strong>Powered By : </strong><a href="https://kavadevelopers.com" target="_blank">Kava Developers</a> </p>


			</div>

	</div>
	<!-- /.login-box -->

	<!-- jQuery -->
	<script src="<?php echo base_url(); ?>plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url(); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- iCheck -->
	<script src="<?php echo base_url(); ?>plugins/iCheck/icheck.min.js"></script>
	<!-- Notify js -->
	<script src="<?php echo base_url(); ?>plugins/notifyjs/bootstrap-notify.js"></script>
	<script src="<?php echo base_url(); ?>plugins/notifyjs/bootstrap-notify.min.js"></script>
	
	<script>
	  

	  	$(function () {

		    $('input').iCheck({
		      checkboxClass: 'icheckbox_square-blue',
		      radioClass   : 'iradio_square-blue',
		      increaseArea : '20%' // optional
		    })

			$('#login').submit(function(){

			    var user = $('#user').val();
			    var pass = $('#pass').val();
        
        
        		if($('#check').prop('checked') == true){
           			var checkbox = 1;     
          		}
          		else{
            		var checkbox = 0;
          		}
          
          		$('#login-button').attr('disabled',true);

        	$.ajax({
          		type : "post",
          		url : "<?php echo site_url('login_auth/login'); ?>",
          		dataType: "JSON",
          		data : "user="+user+"&pass="+pass+"&check="+checkbox,
          		cache : false,
				beforeSend: function() {
					$.notify({
				        title: '<strong></strong>',
				        icon: 'fa fa-search',
				        message: 'Checking User...'
				      },{
				        type: 'info'
				      });
				},
				success:function( out ){	
              		if(out[0] == '0')
              		{
	                  	$.notify({
	                    	title: '<strong></strong>',
	                    	icon: 'fa fa-check',
	                    	message: 'Login Successful...'
	                  	},{
	                    	type: 'success'
	                  	});

	                  	setTimeout(function(){
                    		window.location.replace('<?php echo base_url(); ?>'+ out[2]); 
                		}, 1000);
                  		
              		}
              		else
              		{
              			$('#login-button').removeAttr('disabled');

                    	$.notify({
                      		title: '<strong></strong>',
                      		icon: 'fa fa-times-circle',
                      		message: out[1]
                    	},{
                      		type: 'danger'
                    	});
              		}
          		}
        	});


	    
        return false;
    });	
	    
	  	<?php if(!empty($this->session->flashdata('error'))){ ?>
    
	      $.notify({
	        title: '<strong></strong>',
	        icon: 'fa fa-times-circle',
	        message: '<?php echo $this->session->flashdata('error'); ?>'
	      },{
	        type: 'danger'
	      });

		<?php $this->session->set_flashdata('error',''); } ?>

		<?php if(!empty($this->session->flashdata('msg'))){ ?>
    
	      $.notify({
	        title: '<strong></strong>',
	        icon: 'fa fa-check',
	        message: '<?php echo $this->session->flashdata('msg'); ?>'
	      },{
	        type: 'success'
	      });

		<?php $this->session->set_flashdata('msg',''); } ?>
	
	})
</script>
</body>
</html>
