<div class="post">
	<h2 class="title">{$user->username} {$lang->ROLE} {$lang->ADMIN}</h2>

	<div class="post_content">
		{assign var=basedir value=$smarty.const.INCLUDE_PATH}
		{include file="$basedir/templates/form.tpl"}
	</div>
</div>
