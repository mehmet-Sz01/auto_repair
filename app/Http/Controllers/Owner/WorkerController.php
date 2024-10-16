<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{



    public function store(Request $request)
    {
        $worker = Worker::create([
            'worker_name' => $request->worker_name,
            'worker_lastname' => $request->worker_lastname, // İsteğe bağlı, formda ekleme yapabilirsiniz
            'number' => $request->number, // İsteğe bağlı
            'wage' => $request->wage, // İsteğe bağlı
        ]);

        return response()->json($worker, 201);
    }

    public function getWorker()
    {
        return Worker::all(['id', 'worker_name', 'worker_lastname', 'number', 'wage']);
    }

    public function updateWorker(Request $request, $id)
    {
        $request->validate([
            'worker_name' => 'required|string|max:255',
            'worker_lastname' => 'required|string|max:255',
            'number' => 'required|string|max:15',
            'wage' => 'required|numeric',
        ]);

        $worker = Worker::findOrFail($id);
        $worker->worker_name = $request->input('worker_name');
        $worker->worker_lastname = $request->input('worker_lastname');
        $worker->number = $request->input('number');
        $worker->wage = $request->input('wage');
        $worker->save();

        return response()->json($worker, 200);
    }

    public function deleteWorker($id)
    {
        $worker = Worker::findOrFail($id);
        $worker->delete();

        return response()->json(['message' => 'Çalışan başarıyla silindi.'], 200);
    }
}
