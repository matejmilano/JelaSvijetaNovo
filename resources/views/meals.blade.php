<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
         </head>
            <section
            >
            <div   
            >
            
        </div>
            
          

            <div>
                <h1>
                 @php   echo __('meals.title'); @endphp
                </h1>
                <div>   
                <li>  <a href="/en">{{'EN'}} </a> </li>
                <li>  <a href="/jp">{{'FR'}} </a> </li>
                </div>
            </div>
        </section>
        <main>
            <form action="">
                <div>
                    <div>
                    </div>
                    <input
                        type="text"
                        name="search"
                        placeholder=@php  echo __('meals.SearchText'); @endphp
                    />
                    <div>
                        <button
                            type="submit"
                        >
                        @php   echo __('meals.search'); @endphp
                        </button>
                    </div>
                </div>
            </form>
            <div>
        
            @foreach($meals as $meal)
            <div>
                <div>
                   <div>
                        <h3>
                            {{$meal['title']}}
                        </h3>
                        <div>
                            @php $catId = \App\models\Category::find($meal->category_id)@endphp
                    
                            @if($catId==null)
                            @php   echo __('meals.NoCat'); @endphp
                            <br>
                            @else
                            @php   echo __('meals.category'); @endphp
                            {{$catId->title}}
                            <br>
                            @endif

                            <br>
                            <em>{{$meal->description->description}}</em>
                            
                        </div>

                        @php   echo __('meals.Ing'); @endphp
                        @foreach($meal->ingredients as $ingredient)
                        
                            {{$ingredient->title}}
                            <br>
                        
                        @endforeach
    <br>
    <br>


                @php   echo __('meals.title'); @endphp
                        <ul> @foreach($meal->tag as $tag)
                            <li
                            >
                               
                                <a href="/?tag={{$tag->title}}">{{$tag->title}}</a>
                               
                            </li>
                            @endforeach
                        </ul>
                       
                    </div>
                </div>
            </div>
            @endforeach



 {{$meals->links()}}   

  