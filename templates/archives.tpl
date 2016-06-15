{include file="header.tpl"}

<div class="colmask twocol">
	<div class="colleft">
		<div class="col1">	<!-- Right column start -->
		<h2>{$title}</h2>
		{foreach $minutes as $section}
		<h3>{$section->year}</h3>
		<ul>
			{foreach $section->minutes as $date=>$file}
			<li><a href="minutes_archive/{$file}">{$date|date_format:"%B %e"}</a>
			{if $section->annual[$date]}&ndash; {$annual_display}{/if}</li>
			{/foreach}
		</ul>
		{/foreach}
		</div>							<!-- Right column end -->
		<div class="col2">	<!-- Left column start -->
		{include file="news.tpl"}
		</div>							<!-- Left column end -->
	</div>
</div>

{include file="footer.tpl"}