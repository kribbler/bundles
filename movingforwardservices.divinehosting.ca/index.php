<?php
$page_title			 = 'Autism, Yoga and Meditation Training &amp; Consultation - Moving Forward Consulting & Wellness Services';
$page_description	 = 'Offering support for parents of children with Autism (ASD). Yoga Classes and Meditation Groups. Moving Forward Consulting and Wellness Services is a privately owned business committed to providing personalized client focused service to agencies and individuals.';
$page_keywords		 = 'asd coaching, asd services, autism services, autism spectrum disorder, yoga and wellness, yoga classes in barrie ontario, yoga classes in coldwater, yoga classes in orillia';
include('includes/header.html');
?>
<div id="page">
	<div id="pagea">
		<div id="intro"><h1 style="padding:0;font-size:16px">ASD Consultation, Yoga Classes and Meditation</h1><h2><span class="subhead">Moving Forward Together, One Step at a Time.</span></h2><p style="text-align:justify;"><span style="font-style:italic;font-weight:bold;color:#707070;font-size:13px;">Moving Forward Consulting and Wellness Services</span> is a privately owned business committed to providing personalized client focused service to agencies and individuals. We strive to develop an understanding of the needs of our clients and with this information work collaboratively to assist them in successfully reaching their goals. As awareness and knowledge increases, agencies feel more effective in their work and individuals develop ease and clarity in their daily lives.</p></div>
		<div id="cta1">
			<h2>Consulting Services</h2>
			<p>Providing exceptional consul<br>ting, coaching and training regarding <a style="color:white;font-weight:normal" href="consult.php" title="ASD Consultant">Autism Spectrum Disorders (ASD)</a> to agencies and individuals.</p>
			<p><a href="consult.php" title="Autism Spectrum Disorder Consultant (ASD Consultant)">READ MORE</a></p>
		</div>
		<div id="cta2">
			<h2>Wellness Services</h2>
			<p>Teaching skillfully designed <a style="color:white;font-weight:normal" href="wellness.php" title="Yoga Classes">private and group Yoga</a> and/or Meditation classes in a safe and supportive environment.</p>
			<p><a href="wellness.php" title="Meditation Groups, Gentle Yoga Classes and Vipassana Insight Meditation information and services">READ MORE</a></p>
		</div>
	</div>
	<div id="pageb">
		<div id="text">
			<div id="texthead"><h1>Who we are <br> <span class="subhead"> A Business on the Move ~ Bringing Our Services Directly to Clients in Simcoe County (Barrie, Orillia, Midland) and Across Ontario</span></h1></div>
			<div id="textfront"><div class="img"><img src="images/cheryl_homepage.jpg" alt="Cheryl - ASD Consultant, Yoga and Meditation Specialist" title="Cheryl - ASD Consultant, Yoga and Meditation Specialist"></div>Cheryl McCague-Shane, owner of Moving Forward Consulting and Wellness Services, is passionate about <strong>Autism Spectrum Disorders (ASD)</strong>, <strong>Yoga</strong>, and <strong>Meditation</strong> and is thrilled to have the opportunity to bring these three interests together in one business. Life long learning is a personal goal for Cheryl and as such she continues to seek out information to keep informed about ASD, Yoga and Meditation. Cheryl has the ability to listen to <em>clients/students</em>, determine their goals and then to move forward together at a pace that is appropriate for them. Cheryl delivers information to people in a variety of creative and diverse ways. She is energetic, organized, a great communicator, and brings a compassionate and positive attitude to all that she does. As an innovative thinker she is able to assist clients/students to think outside the box and be creative in problem solving.</div>
		</div>
		<div id="contactpic"><img src="images/contact_side.jpg" alt="Orillia, Coldwater, Oro Medonte, Midland, Barrie, Simcoe County and Ontario. Yoga Classes, Autism Training and Meditation Services" title="Orillia, Coldwater, Oro Medonte, Midland, Barrie, Simcoe County and Ontario. Yoga Classes, Autism Training and Meditation Services"/></div>
		<div id="contact">
			<div id="conhead"><h2>Contact Us!</h2></div>
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
				if (isset($scrubbed['comments']) && ($scrubbed['comments'] != ' Leave us message')) {
					$comments = strip_tags($scrubbed['comments']);
				} else {
					$errors = 'Please enter your comments!';
				}
				if (!empty($_POST['url']))
					$errors = 'Go away spammer!';
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
					echo '<div style="width:220px;text-align:center;font-size:10px;color:#cc0000;">' . $errors . '</div>';
				}
			}
			?>
			<a name="contact"></a>
			<form action="/filter.php" method="post" id="filter" onClick="load_here">
				<input type="text" name="url" class="formurl" value=""/>
				<div id="form">
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
					 }" <?php if (!empty($_POST['name'])){
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
					 }" <?php if (!empty($_POST['email'])) {
						echo'style="color:grey;"';
					} else {
						echo'style="color:black;"';
					} ?>/></div>
					<div class="formb"><input type="text" name="phone" style="border:0px;" class="css01" value="<?php if (!empty($_POST['email'])) {
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
					<div id="formd"><input type="image" src="images/submit.jpg" name="submit" span><br /><input type="hidden" name="submitted" value="TRUE"></div>
				</div>
			</form>
			<div id="coninfo"><img src="images/coninfo.png" alt="Let's move forward together, offering yoga classes, asd consultations and meditation classes in the Ontario area" title="Let's move forward together, offering yoga classes, asd consultations and meditation classes in the Ontario area"></div>
		</div>
	</div>
</div>
<?php
include('includes/footer.html');
?>
