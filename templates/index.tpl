{include file="header.tpl"}

<div class="colmask threecol">
	<div class="colmid">
		<div class="colleft">
			<div class="col1">	<!-- Center column start -->
			{include file="news_index.tpl"}
			</div>							<!-- Center column end -->
			<div class="col2">	<!-- Left column start -->
			{include file="news.tpl"}
			</div>							<!-- Left column end -->
			<div class="col3">	<!-- Right Column start -->
			<h4>{$meeting_dates_heading}</h4>
			<ul>
			{foreach $meeting_dates as $day=>$link}
			<li>{if $link ne ''}<a href="{$link[0]}/{$link[1]}" class="{$link[0]}">{$day}</a>{else}{$day}{/if}</li>
			{/foreach}
			</ul>
			<span class="comment">{$meeting_time}</span>
			</div>							<!-- Right column end -->
		</div>
	</div>
</div>

{include file="footer.tpl"}