<div class="innercontainer-blk">
					<p class="heading">Feedback</p>
					<form target="_self" method="post" action="<?php echo $current_url?>" id="ajax-contact-form">
						<div class="one-third column">
							<div class="form-box">
								<label>Name <small>*</small></label>
								<input type="text" class="text" name="txtname" id="txtname">
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label>Email ID <small>*</small></label>
								<input type="text" class="text" name="txtemail" id="txtemail">
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
						
						</div>
						<div class="sixteen columns">
							<div class="form-box big">
								<label>Message <small>*</small></label>
								<textarea name="txtmessage" id="txtmessage"></textarea>
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								<label><?php echo $CAP_captcha; ?> <small>*</small></label><div name="captcha_div" id="captcha_div"><img id="captcha_id" src="/captcha.php"/></div><input type="button" name="captcha_refresh" id="captcha_refresh" value="Refresh" class="button"/><br> <br><input type="text" class="text" name="txtcaptcha" id="txtcaptcha"  value="">
							
							</div><!-- End Box -->
						</div>
						<div class="sixteen columns">
							<div class="form-box">
		<div style="width:0px;height:0px;overflow:hidden;"><input type="submit" class="button" name="submit_hidden" id="submit_hidden"></div><input type="button" class="button" value="submit" name="submit" id="submit">
							</div>
						</div>
					</form>
				</div>
