<?php

namespace App\Http\Controllers;

use Locale;
use App\Models\Tag;
use App\Models\Meal;
use App\Models\Ingredients;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\Meals;
use App\Models\MealTranslation;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Resources\MealsCollection;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Validator;

class MealController extends Controller
{

    public function filter(Request $request)
    {
          $validator = Validator::make(
            $request->all(),
            [
                'tag'=>'integer',
                'category'=>'nullable|integer',
                'lang'=>'required',
                'diff_time'=>'date'

               
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
 
 

       $meal_query=Meal::with(['tag','ingredients','category']);

       $lang=$request->get('lang');
       $with = $request->get('with');
       $categoryId=$request->get('categories');

       $diff_time = $request->get('diff_time');

 

       if ($categoryId == "null") {
        $meal_query->whereNull('category_id');

        } elseif ($categoryId == "!null") {
        $meal_query->whereNotNull('category_id');

         } elseif ($categoryId) {
        $meal_query->where('category_id', $categoryId);

         }

       if($request->tag)
       {
        $meal_query->whereHas('tag',function($query) use($request)
        {
            $query->whereTranslationLike('tag_id',$request->tag);
        });
       }



       if ($with) {
        $withData = explode(',', $with);
        $meal_query->with($withData);
    }


    if ($diff_time) {
        $meal_query->where('created_at', '>=', $diff_time);
        $meal_query->where('updated_at', '>=', $diff_time);
        $meal_query->withTrashed();

    } 
        
    }



    public function getTags($meal_id)
    {
        return Meal::find($meal_id)->tags;
    }

    public function getMeals($tag_id)
    {
        return Tag::find($tag_id)->tags;
    }

    


    public function index(Request $request,$locale)
    {
      
        
       
        app::setLocale($locale);
    
    
        return view('meals',[
            'meals' => Meal::latest()->filter(request(['search']))->paginate(10)
       ]); 

       
    }
}
