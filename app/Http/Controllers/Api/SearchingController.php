<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\CustomClasses\ColectionPaginate;
use Illuminate\Support\Facades\View;

class SearchingController extends Controller
{
    function getResult(Request $request)
    {
        $data = array();
        $perpage = 20;
        $searchString = $request->birthYear . $request->birthMonth;
        $cachedResult = Redis::get('filteredData_' . $searchString);
        if (isset($cachedResult)) {
            $cachedResult = json_decode($cachedResult, FALSE);
            $result = ColectionPaginate::paginate(collect($cachedResult), $perpage);
        } else {
            $fetchedResult = Person::where(function ($q) use ($request) {
                if ($request->birthYear) {
                    $q->whereYear('Birthday', '=', $request->birthYear);
                }
                if ($request->birthMonth) {
                    $q->whereMonth('Birthday', '=', $request->birthMonth);
                }
            })->get();
            Redis::set('filteredData_' . $searchString, $fetchedResult, 'EX', 5);
            $result = ColectionPaginate::paginate($fetchedResult, $perpage);
        }
        $data['result'] = $result;
        if ($request->ajax()) {
            return response()->json([
                View::make('renderdata', $data)->render()
            ], 200);
        }
        return view('welcome', $data);
    }
}
