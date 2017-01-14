<div class="post">
{literal}
<style type="text/css">
</style>
{/literal}

	<div class="post_content">
		<div class="contact_form">
			<h3>Contact <span id="contact_to">General inquires</span></h3>
			<form action="/Contactus/Send/" method="post" id="contact_form_form">
				<input type="hidden" name="contact_name" id="contact_name" value="" />
				<input type="hidden" name="contact_realname" id="contact_realname" value="General inquires" />
				<div class="form_cell ui-widget ui-widget-content ui-corner-all">
					<div class="label"><label for="from_name"><img src="/resources/images/gist/name-icon.jpg" alt="Name" /></label></div>
					<div><input type="text" style="width: 245px;" name="name" id="from_name" value="{$smarty.post.from}" maxlength="255" class="textinput required" /></div>
				</div>
			
				<div class="form_cell ui-widget ui-widget-content ui-corner-all">
					<div class="label"><label for="from_email"><img src="/resources/images/gist/email-icon.jpg" alt="Email" style="padding-top: 7px;" /></label></div>
					<div><input type="text" style="width: 245px;" name="email" id="from_email" value="{$smarty.post.from}" maxlength="255" class="textinput required" /> </div>
				</div>
			
				<div class="form_cell ui-widget ui-widget-content ui-corner-all">
					<div class="label"><label for="from_phone"><img src="/resources/images/gist/mobile-icon.jpg" alt="Phone" /></label></div>
					<div><input type="text" style="width: 245px;" name="phone" id="from_phone" value="{$smarty.post.from}" maxlength="255" class="textinput required" /> </div>
				</div>
				
				<div class="form_cell ui-widget ui-widget-content ui-corner-all">
					<div class="label"><label for="from_subject"><img src="/resources/icons/mini/icon_wand.gif" alt="Phone" /></label></div>
					<div><input style="width: 245px;" type="text" name="subject" id="from_subject" value="{if $product}Customer inquiry about {$product->name} [{$product->upc}]{else}{$smarty.post.subject}{/if}" maxlength="255" class="textinput required" /></div>
				</div>
				
				<div class="form_cell ui-widget ui-widget-content ui-corner-all">
					<div><textarea name="message" class="textinput required" id="form_message" style="height: 100px; width: 275px;">{$smarty.post.message}</textarea></div>
				</div>
				
				<div>
					<div class="label"></div>
					<div style="width: 75px;"><input type="image" id="submit_button" src="/resources/images/gist/send-button.jpg" alt="Send" /></div>
				</div>

			</form>
			<span>* - Required fields.</span>
		</div>
	
		<div class="contact_info">
			<h1 class="title">Contact us</h1>

			<p>Seeking <strong>general information</strong> on products and services?</p>
			<p>Then please use the email form.</p>

			<br />
			
			<p>[ <a href="#" onclick="return updateContactTo('','General inquiries');" title=""><img src="/resources/images/gist/email-icon.jpg" alt="Email" style="margin-bottom: -4px;" /></a> ] <strong>General Inquiries</strong></p>

			<br />

			<h3>SALES STAFF</h3>
			<p>530-644-8000 or 1-800-456-4478</p>
			<p class="quiet">(continental United States)</p>

			<br />

			<h3>EXECUTIVE STAFF</h3>
			<p>[ <a href="#" onclick="return updateContactTo('wende','Wende Heinen');" title=""><img src="/resources/images/gist/email-icon.jpg" alt="Email" style="margin-bottom: -4px;" /></a> ] <strong>Wende Heinen</strong></p>
			<p class="quiet">Director of Sales &amp; Media Communications</p>
			<p>530-644-8000 <strong>ext. 228</strong></p>
			
			<br />
			<p>[ <a href="#" onclick="return updateContactTo('jennifer','Jennifer Folsom');" title=""><img src="/resources/images/gist/email-icon.jpg" alt="Email" style="margin-bottom: -4px;" /></a> ] <strong>Jennifer Folsom</strong></p>
			<p class="quiet">V.P. Marketing &amp; Business Development</p>
			<p>Direct line: 405-748-4736</p>
			
		</div>
		
		<div style="clear: both;"></div>
	</div>
</div>
<div class="post_close"></div>
