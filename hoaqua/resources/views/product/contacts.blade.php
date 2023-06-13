<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BetaDesign &mdash; Contacts</title>
	<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="/source/assets/dest/css/font-awesome.min.css">
	<link rel="stylesheet" href="/source/assets/dest/vendors/colorbox/example3/colorbox.css">
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
	<link rel="stylesheet" title="style" href="/source/assets/dest/css/style.css">
	<link rel="stylesheet" href="/source/assets/dest/css/animate.css">
	<link rel="stylesheet" title="style" href="/source/assets/dest/css/huong-style.css">
</head>
<body>
@include('layouts.header') 

	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Contacts</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index.html">Home</a> / <span>Contacts</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="beta-map">
		
		<div class="abs-fullwidth beta-map wow flipInX"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3678.0141923553406!2d89.551518!3d22.801938!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ff8ff8ef7ea2b7%3A0x1f1e9fc1cf4bd626!2sPranon+Pvt.+Limited!5e0!3m2!1sen!2s!4v1407828576904" ></iframe></div>
	</div>
	<div class="container">
		<div id="content" class="space-top-none">
			
			<div class="space50">&nbsp;</div>
			<div class="row">
				<div class="col-sm-8">
					<h2>Contact Form</h2>
					<div class="space20">&nbsp;</div>
					<div class="space20">&nbsp;</div>
					<form action="#" method="post" class="contact-form">	
						<div class="form-block">
							<input name="your-name" type="text" placeholder="Your Name (required)">
						</div>
						<div class="form-block">
							<input name="your-email" type="email" placeholder="Your Email (required)">
						</div>
						<div class="form-block">
							<input name="your-subject" type="text" placeholder="Subject">
						</div>
						<div class="form-block">
							<textarea name="your-message" placeholder="Your Message"></textarea>
						</div>
						<div class="form-block">
							<button type="submit" class="beta-btn primary">Send Message <i class="fa fa-chevron-right"></i></button>
						</div>
					</form>
				</div>
				<div class="col-sm-4">
					<h2>Contact Information</h2>
					<div class="space20">&nbsp;</div>

					<h6 class="contact-title">Address</h6>
					<p>
						Suite 127 / 267 – 277 Brussel St,<br>
						62 Croydon, NYC <br>
						Newyork
					</p>
					<div class="space20">&nbsp;</div>
					<h6 class="contact-title">Business Enquiries</h6>
					<p>
						Doloremque laudantium, totam rem aperiam, <br>
						inventore veritatio beatae. <br>
						<a href="mailto:biz@betadesign.com">biz@betadesign.com</a>
					</p>
					<div class="space20">&nbsp;</div>
					<h6 class="contact-title">Employment</h6>
					<p>
						We’re always looking for talented persons to <br>
						join our team. <br>
						<a href="hr@betadesign.com">hr@betadesign.com</a>
					</p>
				</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->
	@include('layouts.footer') 


<script>
	 jQuery(document).ready(function($) {
                'use strict';
				
// color box

//color
      jQuery('#style-selector').animate({
      left: '-213px'
    });

    jQuery('#style-selector a.close').click(function(e){
      e.preventDefault();
      var div = jQuery('#style-selector');
      if (div.css('left') === '-213px') {
        jQuery('#style-selector').animate({
          left: '0'
        });
        jQuery(this).removeClass('icon-angle-left');
        jQuery(this).addClass('icon-angle-right');
      } else {
        jQuery('#style-selector').animate({
          left: '-213px'
        });
        jQuery(this).removeClass('icon-angle-right');
        jQuery(this).addClass('icon-angle-left');
      }
    });
				});
	</script>
</body>
</html>