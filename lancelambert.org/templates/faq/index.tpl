<div class="post faq_page">
	<div id="postcontent">
		<h1 class="title">F.A.Q.'s</h1>
	
		{foreach from=$faqs item=faq}
		<div>
			<div class="question" onclick="jQuery('#answer_{$faq->id}').toggle('fast');">
				<div class="capital">Q:</div>
				<div class="content">{$faq->question}</div>
				<div style="clear: both;"></div>
			</div>
			
			<div id="answer_{$faq->id}" class="answer" style="display: none;">
				<div class="capital">A:</div>
				<div class="content">{$faq->answer}</div>
				<div style="clear: both;"></div>
			</div>
		</div>
		
		{/foreach}

		<div style="clear: both;"></div>
	</div>
</div>
<div class="post_close"></div>
{literal}
<script type="text/javascript">
	Cufon.replace('.faq_page .capital', { fontFamily: 'Copperplate' });
</script>
{/literal}
