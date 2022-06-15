<?php

namespace Tests\Unit;

use App\Models\Term;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TermTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_net30_terms()
    {
        $net30 = Term::create([
            'name' => 'Net 30',
            'type' => 'STANDARD',
            'due_days' => 30
        ]);

        $date = now();
        $due_date = $net30->getDueDate($date);

        $this->assertEquals($date->addDays(30)->format('Y-m-d'), $due_date->format('Y-m-d'));
    }

    public function test_net60_terms()
    {
        $net60 = Term::create([
            'name' => 'Net 60',
            'type' => 'STANDARD',
            'due_days' => 60
        ]);

        $date = now();
        $due_date = $net60->getDueDate($date);

        $this->assertEquals($date->addDays(60)->format('Y-m-d'), $due_date->format('Y-m-d'));
    }
}
