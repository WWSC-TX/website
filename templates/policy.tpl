{include file="header.tpl"}

<div class="colmask twocol">
	<div class="colleft">
		<div class="col1">	<!-- Right column start -->
		<h2><a href="downloads/{$tariff_file}">{$tariff_title}</a></h2>
		
		<h2><a href="downloads/{$bylaws_file}">{$bylaws_title}</a></h2>
		
		<h2><a href="downloads/{$drought_file}">{$drought_title}</a></h2>
		
		<h2><a href="downloads/{$privacy_file}">{$privacy_title}</a></h2>
		</div>							<!-- Right column end -->
		<div class="col2">	<!-- Left column start -->
		{include file="news.tpl"}
		</div>							<!-- Left column end -->
	</div>
</div>

{include file="footer.tpl"}