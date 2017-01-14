<?php
$page_title			 = 'ASD Consulting Links &amp; Yoga and Meditation Links - Moving Forward Consulting & Wellness Services';
$page_description	 = 'Moving Forward Consulting and Wellness Services is a privately owned business committed to providing personalized client focused service to agencies and individuals.';
$page_keywords		 = 'asd coaching, asd services, autism services, autism spectrum disorder, yoga and wellness, yoga classes in barrie ontario, yoga classes in coldwater, yoga classes in orillia';
include('includes/header.html');
?>
<div id="page">
	<div id="pageal">
		<h1>Moving Forward Links <em style="font-size:16px">ASD Consulting, Wellness and Yoga Websites</em></h1>
		<div class="links1">
			<h2>ASD Consulting Links</h2>
			<ul>
				<li><a href="http://www.kerrysplace.org" target="_blank">http://www.kerrysplace.org</a></li>
				<li><a href="http://www.autismontario.com/" target="_blank">http://www.autismontario.com/</a></li>
				<li><a href="http://www.autism.net/" target="_blank">http://www.autism.net/</a></li>
				<li><a href="http://www.parentbooks.ca/" target="_blank">http://www.parentbooks.ca/</a></li>
				<li><a href="http://www.setbc.org/" target="_blank">http://www.setbc.org/</a></li>
				<li><a href="http://www.paulakluth.com/" target="_blank">http://www.paulakluth.com/</a></li>
			</ul>
		</div>
		<div class="links2">
			<h2>Yoga and Meditation Links</h2>
			<ul>
				<li><a href="http://sugarridge.ca/" target="_blank">http://sugarridge.ca/</a></li>
				<li><a href="http://www.cedarandsage.com/" target="_blank">http://www.cedarandsage.com/</a></li>
				<li><a href="http://insightmeditationretreats.ca/" target="_blank">http://insightmeditationretreats.ca/</a></li>
				<li><a href="http://www.truenorthinsight.org/" target="_blank">http://www.truenorthinsight.org/</a></li>
			</ul>
		</div>
		<div class="links3">
			<h2>Other Links</h2>
			<ul>
				<li><a href="http://www.wingsandheros.com/" target="_blank">http://www.wingsandheros.com/</a></li>
			</ul>
		</div>


	</div>
	<div id="pageb">
		<div id="text" style="height:auto;">
			<div id="textfront" class="linksgreen"><div style="float:left;padding-right: 17px;"><img src="images/cheryl.jpg" alt="Cheryl McCague-Shane: Consultant for ASD"></div>
				<h2>REMEMBER</h2>
				<p>Moving Forward Consulting and Wellness Services we provide:</p>
				<ul style="padding-left: 14px;">
					<li>Exceptional consulting, coaching and training regarding Autism Spectrum Disorders (ASD) to agencies and individuals.</li>
					<li>Skillfully designed private and group Yoga and/or Meditation classes in a safe and supportive environment.</li>
				</ul>

			</div>
		</div>
		<!--<div id="contactpic"><img src="images/contact_side.jpg" title="Simcoe County, Ontario, Orillia, Barrie, Midland, Coldwater, Oro Medonte areas" alt="Simcoe County, Ontario, Orillia, Barrie, Midland, Coldwater, Oro Medonte areas"/></div>-->
		<div id="contact" style="background:url(/images/con_back2.jpg) no-repeat;margin-right:3px;float:right;padding:0;width: 47%;background-size: 100% 100%;">
			<div id="conhead"><h1>Contact Us!</h1></div>
			<?php
			if (isset($_POST['submitted'])) {
				$errors = array();

				function spam_scrubber($value) {
					$very_bad = array('to:', 'cc:', 'bcc:', 'content-type:', 'mime-version:', 'multipart-mixed:', 'content-transfer-encoding:');
					foreach ($very_bad as $v) {
						if (strpos($value, $v) !== false)
							return '';
					}
					$value = str_replace(array("\r", "\n", "%0a", "%0d"), ' ', $value);
					return trim($value);
				}

				$scrubbed = array_map('spam_scrubber', $_POST);
				if (isset($scrubbed['name'])) {
					if (preg_match('/^[A-Za-z.\']+\s[A-Za-z.\']+$/', $scrubbed['name'])) {
						$name = $scrubbed['name'];
					}
				}
				if (isset($scrubbed['email'])) {
					if (preg_match('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $scrubbed['email'])) {
						$email = $scrubbed['email'];
					} elseif ($scrubbed['email'] = ' Email Address') {
						$errors = 'Please enter your email address!';
					} else {
						$errors = 'Please enter a valid email address!';
					}
				} else {
					$errors = 'Please enter your email address!';
				}
				if (!empty($_POST['url']))
					$errors = 'Go away spammer!';
				if (isset($scrubbed['comments']) && ($scrubbed['comments'] != ' Leave us message')) {
					$comments = strip_tags($scrubbed['comments']);
				} else {
					$errors = 'Please enter your comments!';
				}
				if (empty($errors)) {
					$subject = "Contact from Website\n\n";
					$body	 = "Name:" . $name . "\n\n
         Email:" . $email . "\n\n
		 Phone Number: {$scrubbed['phone']}\n\n
         Comments:{$scrubbed['comments']}";
					$body	 = wordwrap($body, 70);
					mail('info@movingforwardservices.com', $subject, $body, "From: {$scrubbed['email']}");
					echo'<p style="color:#52595e;font-size:10px;padding-left:40px;">Thank you for contacting us!</p>';
					$_POST	 = array();
				} else {
					echo '<div style="text-align:center;font-size:10px;color:#cc0000;">' . $errors . '</div>';
				}
			}
			?>
			<a name="contact"></a>
			<noscript>You need javascript enabled to send messages</noscript>
			<form action="/filter.php" method="post" id="filter" onClick="load_here">
				<input type="text" name="url" class="formurl" value=""/>
				<div id="form" style="float:left;width: 98%;">
					<div id="forma"><input type="text" name="name" style="border:0px;"  class="css01" value="<?php if (!empty($_POST['name'])) {
				echo $_POST['name'];
			} else {
				echo' Full Name';
			} ?>" onFocus="if (this.style.color != 'black') {
				 this.value = '';
				 this.style.color = 'black'
			 }" onBlur="if (this.value == '') {
						 this.value = ' Full Name';
						 this.style.color = 'grey'
					 }" <?php if (empty($_POST['name'])){
						echo'style="color:grey;"';
					} else {
						echo'style="color:black;"';
					} ?>/></div>
					<div class="formb"><input type="text" name="email" style="border:0px;"  class="css01" value="<?php if (!empty($_POST['email'])) {
						echo $_POST['email'];
					} else {
						echo' Email Address';
					} ?>" onFocus="if (this.style.color != 'black') {
				 this.value = '';
				 this.style.color = 'black'
			 }" onBlur="if (this.value == '') {
						 this.value = ' Email Address';
						 this.style.color = 'grey'
					 }" <?php if (empty($_POST['email'])) {
						echo'style="color:grey;"';
					} else {
						echo'style="color:black;"';
					} ?>/></div>
					<div class="formb"><input type="text" name="phone" style="border:0px;" class="css01" value="<?php if (!empty($_POST['phone'])) {
						echo $_POST['phone'];
					} else {
						echo' Phone Number (optional)';
					} ?>" onFocus="if (this.style.color != 'black') {
				 this.value = '';
				 this.style.color = 'black'
			 }" onBlur="if (this.value == '') {
						 this.value = ' Phone Number (optional)';
						 this.style.color = 'grey'
					 }" <?php if (empty($_POST['phone'])) {
						echo'style="color:grey;"';
					} else {
						echo'style="color:black;"';
					} ?>/></div>
					<div id="formc"><textarea name="comments" style="border:0px;"  class="css01" onFocus="if (this.style.color != 'black') {
				 this.value = '';
				 this.style.color = 'black';
			 }" onBlur="if (this.value == '') {
						 this.value = ' Leave us message';
						 this.style.color = 'grey';
					 }"<?php if (empty($_POST["comments"])) {
						echo " style=\"color: grey;\"";
					} else {
						echo " style=\"color: black;\"";
					} ?>><?php if (!empty($_POST['comments'])) {
						echo $_POST['comments'];
					} else {
						echo' Leave us message';
					} ?></textarea></div>
					<div id="formd"><input type="image" src="images/submit.jpg" name="submit" span style="margin-left:145px;"><br /><input type="hidden" name="submitted" value="TRUE"></div>
				</div>
			</form>
			<div id="coninfo" style="float:right;padding:0;padding-right:12px;clear:none"><img src="images/coninfo.png"></div>
		</div>
		<div style="clear:both;text-align:center;overflow: hidden;"><h1>Who we are <br> <span class="subhead"> A Business on the Move ~ Bringing Our Services Directly to Our Clients</span></h1></div>
	</div>

</div>
<?php
include('includes/footer.html');
