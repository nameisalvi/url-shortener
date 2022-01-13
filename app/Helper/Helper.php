<?php
	
	use App\Models\Url;
		
	function getCount()
	{
		
		return Url::where('is_deleted', 0)->count();
		
	
	}