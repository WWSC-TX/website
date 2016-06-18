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
			{foreach $meeting_dates as $day=>$links}
			<li>{$day}{if array_key_exists('agenda', $links)}
			&ndash; <a href="agendas/{$links['agenda']}">agenda</a>{/if}{if array_key_exists('minutes', $links)}
			&ndash; <a href="minutes_archive/{$links['minutes']}">minutes</a>{/if}</li>
			{/foreach}
			</ul>
			<span class="comment">{$meeting_time}</span>
			</div>							<!-- Right column end -->
		</div>
	</div>
</div>

{include file="footer.tpl"}