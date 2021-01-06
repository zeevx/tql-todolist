<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Use App\Models\TodoList;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//List All TodoLists

Route::get('todolists', function() {

    //Fetch all todolist, sort and paginate by 2

    $todolists =  TodoList::orderBy('id','desc')->paginate(2);

    //Check if any exists
    if (count($todolists) < 1){
        return response()->json([
            'success' => 'true',
            'message' => 'No TodoList yet'
        ]);
    }

    return response()->json([
        'success' => 'true',
        'message' => 'TodoLists Fetched Successfully',
        'data' => $todolists
    ]);

});


//Fetch TodoList

Route::get('todolist/{id}', function($id) {

    //Find a todolist

    $todolist =  TodoList::find($id);

    //Check if TodoList exist

    if ($todolist == null){
        return response()->json([
            'success' => 'true',
            'message' => 'TodoList does not exist'
        ]);
    }

    return response()->json([
        'success' => 'true',
        'message' => 'TodoList Fetched Successfully',
        'data' => $todolist
    ]);

});

//Create TodoList

Route::post('todolist', function(Request $request) {

    //Create a todolist

    //Validate the post data

    if ($request->title == null){
        return response()->json([
            'success' => 'false',
            'message' => 'Title for TodoList is required'
        ]);
    }
    if ($request->body == null){
        return response()->json([
            'success' => 'false',
            'message' => 'Body for TodoList is required'
        ]);
    }

    //Create new instance of todolist

    $todo = new TodoList();

    //Save Title

    $todo->title = $request->title;

    //Save Body

    $todo->body = $request->body;


    //Save todolist

    $todo->save();

    return response()->json([
        'success' => 'true',
        'message' => 'TodoList Created Successfully',
        'data' => $todo
    ]);
});

//Edit TodoList

Route::put('todolist/{id}', function(Request $request, $id) {

    //Find TodoList

    $todolist = TodoList::find($id);

    //Check if it exists

    if ($todolist == null){
        return response()->json([
            'success' => 'true',
            'message' => 'TodoList does not exist'
        ]);
    }

    //Update it

    $todolist->update($request->all());


    return response()->json([
        'success' => 'true',
        'message' => 'TodoList Updated Successfully',
        'data' => $todolist
    ]);
});

//Delete TodoList

Route::delete('todolist/{id}', function($id) {

    //Find todolist

    $todolist = TodoList::find($id);

    //Check if it exists

    if ($todolist == null){
        return response()->json([
            'success' => 'true',
            'message' => 'TodoList does not exist'
        ]);
    }

    //Delete it

    $todolist->delete();

    return response()->json([
        'success' => 'true',
        'message' => 'TodoList Deleted Successfully'
    ]);
});
