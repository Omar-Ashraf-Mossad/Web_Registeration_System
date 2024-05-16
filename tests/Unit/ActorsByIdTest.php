<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Http\Controllers\FetchController;

class ActorsByIdTest extends TestCase
{
    /** @test */
    public function fetch_actor_info_by_id()
    {
        $actorId = 'nm4865040';

        $fetchController = new FetchController();
        $actorName = $fetchController->getActorInfo($actorId);

        echo $actorName;

        $this->assertIsString($actorName);
        $this->assertNotEmpty($actorName);
    }
}
