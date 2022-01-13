<?php

namespace App\Services;

use Carbon\Carbon as Carbon;
use App\Models\Url;

class MainService 
{
	public function getUrl()
	{
		
		return Url::where('is_deleted', 0)->select('*')->get();
		
	
	}

	

	public function save($request)
	{
		
		$data = [
			'title' => $request->title,
			'url' => $request->url,
			'slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->url))),
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		];
		return Url::insert($data);
		
	
	}

	public function getSlugUrl($slug)
	{
		
		return Url::where('is_deleted', 0)->where('slug', $slug)->pluck('url')->toArray();
		
	
	}
	
}

