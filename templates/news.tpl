<h4>{$office_hours['label']}</h4>

<p>{foreach $office_hours['text'] as $line}{$line}{if $line@last}{else}<br />{/if}{/foreach}</p>



<h4>{$office_location['label']}</h4>

<p>{foreach $office_location['text'] as $line}{$line}{if $line@last}{else}<br />{/if}{/foreach}</p>



<h4>{$office_phone['label']}</h4>

<p>{$office_phone['text']}</p>



<h4>{$office_manager['label']}</h4>

<p>{$office_manager['text']}</p>
<p><a href="mailto:{$office_manager['email']}">{$office_manager['email']}</a></p>



<h4>{$emergency_contact['label']}</h4>

<p>{foreach $emergency_contact['text'] as $line}{$line}{if $line@last}{else}<br />{/if}{/foreach}</p>