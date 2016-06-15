{include file="header.tpl"}

<div class="colmask twocol">
	<div class="colleft">
		<div class="col1">	<!-- Right column start -->
		<p>{$introduction}</p>
		<ul style="list-style-type:circle;padding-left:5px">
			{foreach $links as $text=>$url}
			<li><a href="{$url}" rel="external">{$text}</a></li>
			{/foreach}
		</ul>
		</div>							<!-- Right column end -->
		<div class="col2">	<!-- Left column start -->
		{include file="news.tpl"}
		</div>							<!-- Left column end -->
	</div>
</div>

{include file="footer.tpl"}