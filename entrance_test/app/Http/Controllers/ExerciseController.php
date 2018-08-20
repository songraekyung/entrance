<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Price;
use App\UserInfo;
use App\Menu;
use Illuminate\Support\Facades\Hash;
class ExerciseController extends Controller
{
    /**
     *
     */
    public function exerciseOne()
    {
        $arrLargetNumber = array(0, 6, 100, 46, 47);
        $largetNumber = max($arrLargetNumber);
        $currentMax = NULL;
        foreach ($arrLargetNumber as $key => $value) {
            if ($value >= $currentMax && $value !== $largetNumber) {
                $currentMax = $value;
            }
        }
        $arrNews = implode( ", ", $arrLargetNumber );
        return view('exercise-one')->with(compact ('largetNumber', 'currentMax', 'arrNews'));


    }
    public function exerciseTwo()
    {
        $arrRepeat = array(4, 8, 9, 5, 8, 9, 4, 1, 9, 5, 11);
        $counterArrRepeat = array_count_values($arrRepeat);
        $uniqueNumbers = [];
        foreach ($counterArrRepeat as $number => $count) {
            if ($count === 1) {
                $uniqueNumbers[] = $number;
            }
        }
        $arrNews = implode( ", ", $arrRepeat );
        return view('exercise-two')->with(compact ( 'uniqueNumbers', 'arrNews'));


    }
    public function exerciseThree()
    {

        $sql = UserInfo::first();
        if ($sql)
        {
            $amounts = $sql->amounts;
            $price = array(1, 5, 10, 50);
            return view('exercise-three')->with(compact('amounts', 'price'));
        }
        return "Errors connect to server";

    }
    public function exerciseAmounts(Request $request)
    {
        if($request->ajax())
        {
            $res = $request->all();
            $amounts = $res['amounts'];
            $price = $res['price'];
            $amountNew = $amounts - $price;
            if ($amountNew < 0)
            {
                return response()->json(['msg'=> 'Your account balance is not sufficient to perform a transaction', 'status' => 400]);
            }
            $sqlUpdateAmount = UserInfo::where('email', 'nguyendinhchien.cit@gmail.com')->update(['amounts' => $amountNew]);
            $sqlHistoryPrice = new Price();
            $sqlHistoryPrice->user_id = 1;
            $sqlHistoryPrice->amounts = $amounts;
            $sqlHistoryPrice->amounts_news = $amountNew;
            $sqlHistoryPrice->price = $price;
            $resSql = $sqlHistoryPrice->save();
            if ($resSql)
            {
                return response()->json(['msg'=>'Successful transaction', 'amountNew'=> $amountNew, 'status' => 200 ]);
            }
            return "Errors connect to server";
        }
        else
        {
            return "not found";
        }
    }
    public function exerciseHistory()
    {
        $sql = Price::where('user_id', 1)->get()->toArray();
        if($sql)
        {
            $zone          = view('ajax-history', compact('sql'))->render();
            return response()->json(compact('zone'));

        }
        return "Errors connect to server";

    }
    public function exerciseFour()
    {
        $menuSql = Menu::get()->toArray();
        return view('exercise-four')->with(compact('menuSql'));
    }
    public function addMenu(Request $request)
    {
        $request = $request->all();
        if($request)
        {
            $sqlMenu = new Menu();
            $sqlMenu->name_menu = $request['name_menu'];
            $sqlMenu->parent = $request['choose-menu'];
            $sqlMenu->save();
        }

        return back();
    }
}
