<?php

use App\Task;
use Illuminate\Http\Request;

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

/**
 * display all tasks
 */
Route::get('/', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();

    return view('tasks', [
        'tasks' => $tasks
    ]);
});

/**
 * add new task
 */
Route::post('/task', function(Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255'
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->WithErrors($validator);
    }

    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/');
});

/**
 * delete an existing task
 */
Route::delete('/task/{id}', function($id) {
    //
});
