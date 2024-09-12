<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //Vista tareas
    public function index()
    {       
        return view('tasks');
    }
//Optener  tareas y usuarios
    public function getAll()
    {
        $tasks = Task::with('user:id,name')->get();
        $users = User::select('email')->get();
        return response()->json(["tasks"=>$tasks, "users"=>$users]);
    }
    // Crear tarea
    // Para componente web
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:500',
            'user' => 'required|max:500',
        ]);

        $task = new Task($validated);
        $user = User::where('email',$validated['user'])->first();
        $task->user_id = $user->id;
        $task->save();

        return redirect()->back()->with('success', 'Task created successfully.');
    }
// Para componente api
    public function create(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:500',
            'user' => 'required|max:500',
        ]);
        $task = new Task($validated);
        $user = User::where('email',$validated['user'])->first();
        $task->user_id = $user->id;
        $task->save();
        $response_task = Task::with('user:id,name')->find($task->id);
        return response()->json($response_task);
    }

    // Actualizar tarea
    // Para componente web
    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:500',
        ]);

        $task = Task::find($id);

        if(!$task) {
            return redirect()->back()->with('error', 'Task not found.');
        }

        // Corrección: Se actualiza la tarea con datos validados.
        $task->update($validated);
        return redirect()->back()->with('success', 'Task updated successfully.');
    }
    // Completar tarea
    // Para componente api
    public function complete(Request $request, $id)
    {

        $task = Task::with('user:id,name')->find($id);

        if(!$task) {
            return response()->json([
                'message' => 'Task not found'
            ], 404);
        }

        $task->completed = true;
        // Corrección: Se actualiza la tarea con datos validados.
        $task->update();
        return response()->json($task);
    }

    // Eliminar tarea
    // Para componente web
    public function destroy($id)
    {
        $task = Task::find($id);

        if(!$task) {
            return redirect()->back()->with('error', 'Task not found.');
        }

        $task->delete();

        return redirect()->back()->with('success', 'Task deleted successfully.');
    }
    // Para componente api
    public function delete($id)
    {
        $task = Task::find($id);

        if(!$task) {
            return response()->json([
                'message' => 'Task not found'
            ], 404);
        }

        $task->delete();

        return response()->json("deleted");
    }
}
