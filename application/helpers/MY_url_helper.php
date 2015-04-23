<?php

if(!function_exists('admin_url'))
{
	function admin_url($uri = '')
	{
		return site_url('admin/'.$uri);
	}
}