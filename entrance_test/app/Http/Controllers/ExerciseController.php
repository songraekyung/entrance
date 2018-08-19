<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Price;
use DB;
class ExerciseController extends Controller
{
    /**
     *
     */
    public function exerciseOne()
    {

        echo phpinfo();die;

        $x = DB::table('amounts')->get();
        dd($x);

        $arrLargetNumber = array(0, 6, 100, 46, 47);
        $max1 = max($arrLargetNumber);
        $currentMax = NULL;
        foreach ($arrLargetNumber as $key => $value) {
            if ($value >= $currentMax && $value !== $max1) {
                $currentMax = $value;
            }
        }
        echo $max1; echo $currentMax; die;

        return view('exercise-one');

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

        dd($uniqueNumbers);

    }
    public function exerciseThree($amounts = 2018)
    {
        $sql=Price::all();
        dd($sql);
        $price = array(1, 5, 10, 50);
        return view('exercise-three')->with(compact('amounts', 'price'));
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
            return response()->json(['msg'=>'Successful transaction', 'amountNew'=> $amountNew, 'status' => 200 ]);
        }
        else{
            return "not found";
        }
    }
}
