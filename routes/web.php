<?php

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\LazyCollection;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/lazy', function () {
    function OneFunction()
    {
        $collection = Collection::times(1000000)->map(function ($number) {
            return pow(2, $number);
        })->all();
        return 'done';
    }


    function LazyOneFunction()
    {
        // here is the usage of lazy collection
        $collection = LazyCollection::times(10000000)->map(function ($number) {
            return pow(2, $number);
        })->all();
        return 'done';
    }

    return LazyOneFunction();
});


Route::get('/generator', function () {
    function UnHappyFunction($number)
    {
        $returnArr = [];

        for ($i = 1; $i < $number; $i++) {
            $returnArr[] = $i;
        }

        return $returnArr;
    }

    function HappyFunction($number)
    {
        for ($i = 1; $i < $number; $i++) {
            yield $i;     // here is the usage of php generator
        }
    }

    foreach (HappyFunction(100000000) as $number) {
        if ($number % 1000 == 0) {
            dump('Hello');
        }
    }
});
