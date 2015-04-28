{html}
	{head title='Error'}
	{/head}
	{body}
		{ul items=$error}
			{literal}
			{li}
				{h2}Error Cause [{$item->cause}]{/h2}
				{ul items=$item->message}{/ul}
			{/li}
			{/literal}
		{/ul}
	{/body}
{/html}
