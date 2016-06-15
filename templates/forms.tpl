{include file="header.tpl"}

<div class="colmask twocol">
	<div class="colleft">
		<div class="col1">	<!-- Right column start -->
		<ul>
		{foreach $form_links as $name=>$file}
			<li>{if $file ne ''}<a href="downloads/{$file}">{$name}</a>{else}{$name}{/if}</li>
		{/foreach}
		</ul>
		</div>							<!-- Right column end -->
		<div class="col2">	<!-- Left column start -->
		{include file="news.tpl"}
		</div>							<!-- Left column end -->
	</div>
</div>

{include file="footer.tpl"}