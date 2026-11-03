<?php

namespace App\Http\Controllers;

   use App\Http\Requests\StoreTreeRequest;
   use App\Models\Tree;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Gate;

   class TreeController extends Controller
   {
       public function index(Request $request)
       {
           return $request->user()->trees()->with('seedType')->get();
       }

       public function store(StoreTreeRequest $request)
       {
           $tree = $request->user()->trees()->create($request->validated());

           return response()->json($tree->refresh()->load('seedType'), 201);
       }

       public function show(Tree $tree)
       {
           Gate::authorize('view', $tree);

           return $tree->load('seedType');
       }

       public function destroy(Tree $tree)
       {
           Gate::authorize('delete', $tree);
           $tree->delete();

           return response()->noContent();
       }
   }