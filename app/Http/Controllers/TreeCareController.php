<?php

namespace App\Http\Controllers;

use App\Http\Resources\TreeCareResource;
use App\Models\Tree;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TreeCareController extends Controller
{
    private const CARES_PER_LEVEL = 5;

    private const HEALTH_PER_CARE = 20;

    private const MAX_HEALTH = 100;

    private const MATURE_LEVEL = 10;

    private const COOLDOWN_MINUTES = 60;

    public function store(Request $request, Tree $tree): JsonResponse
    {
        abort_unless($tree->user_id === $request->user()->id, Response::HTTP_NOT_FOUND);

        if ($tree->next_care_at && $tree->next_care_at->isFuture()) {
            return response()->json([
                'error' => 'El árbol se encuentra en período de enfriamiento.',
                'next_care_at' => $tree->next_care_at->toIso8601ZuluString(),
            ], Response::HTTP_CONFLICT);
        }

        DB::transaction(function () use ($tree) {
            $this->applyCare($tree);
        });

        return response()->json([
            'message' => 'Cuidado aplicado con éxito',
            'tree' => (new TreeCareResource($tree))->resolve($request),
        ], Response::HTTP_OK);
    }

    private function applyCare(Tree $tree): void
    {
        $progress = $tree->progress + 1;
        $level = $tree->level;

        if ($progress >= self::CARES_PER_LEVEL) {
            $progress = 0;
            $level++;
        }

        $tree->forceFill([
            'progress' => $progress,
            'level' => $level,
            'health' => min(self::MAX_HEALTH, $tree->health + self::HEALTH_PER_CARE),
            'care_count' => $tree->care_count + 1,
            'status' => $level >= self::MATURE_LEVEL ? 'MATURE' : $tree->status,
            'last_cared_at' => now(),
            'next_care_at' => now()->addMinutes(self::COOLDOWN_MINUTES),
        ])->save();
    }
}
