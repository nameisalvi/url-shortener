<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MainService;
use Validator;

class MainController extends Controller
{
    public function __construct(MainService $mainService)
    {
    	$this->mainService = $mainService;
    }
    /**
    * Function for getting all urls
    *
    * @return Json
    */
    public function getUrl()
    {
    	return $this->mainService->getUrl();
    }

    /**
    * Function for add/update content
    *
    * @param Request Illuminate\Http\Request
    *
    */
    public function save(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'title' => 'required',
            'url' => 'required'
    	]);
    	$created = $this->mainService->save($request);
    	if ($created) {
    		return response()->json(['success' => true], 200);
    	}
    }

    public function getSlugUrl($slug)
    {
    	$url =  $this->mainService->getSlugUrl($slug);
        return redirect()->away($url['0']);
    }
}
