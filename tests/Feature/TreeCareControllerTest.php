<?php

namespace Tests\Feature;

use App\Models\SeedType;
use App\Models\Tree;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TreeCareControllerTest extends TestCase
{
    use RefreshDatabase;

    private function treeFor(User $user): Tree
    {
        $seedType = SeedType::create([
            'name' => 'Normal',
            'cares_per_level' => 5,
            'harvest_reward' => 10,
        ]);

        return Tree::create([
            'user_id' => $user->id,
            'seed_type_id' => $seedType->id,
        ]);
    }

    public function test_it_cares_for_a_tree(): void
    {
        $user = User::factory()->create();
        $tree = $this->treeFor($user);

        Sanctum::actingAs($user);

        $this->postJson("/api/trees/{$tree->id}/care")
            ->assertOk()
            ->assertJson([
                'message' => 'Cuidado aplicado con éxito',
                'tree' => [
                    'id' => $tree->id,
                    'level' => 0,
                    'health' => 100,
                    'progress' => 1,
                    'status' => 'ACTIVE',
                ],
            ])
            ->assertJsonStructure(['tree' => ['next_care_at']]);
    }

    public function test_it_returns_conflict_during_cooldown(): void
    {
        $user = User::factory()->create();
        $tree = $this->treeFor($user);
        $tree->forceFill(['next_care_at' => now()->addHour()])->save();

        Sanctum::actingAs($user);

        $this->postJson("/api/trees/{$tree->id}/care")
            ->assertStatus(409)
            ->assertJson([
                'error' => 'El árbol se encuentra en período de enfriamiento.',
            ])
            ->assertJsonStructure(['next_care_at']);
    }

    public function test_it_levels_up_and_becomes_mature(): void
    {
        $user = User::factory()->create();
        $tree = $this->treeFor($user);
        $tree->forceFill(['level' => 9, 'progress' => 4, 'health' => 90])->save();

        Sanctum::actingAs($user);

        $this->postJson("/api/trees/{$tree->id}/care")
            ->assertOk()
            ->assertJson([
                'tree' => [
                    'level' => 10,
                    'progress' => 0,
                    'health' => 100,
                    'status' => 'MATURE',
                ],
            ]);
    }
}
