<?php

use App\Jobs\PerformAMLChecks;
use App\Models\AMLResult;
use App\Models\Client;
use App\Models\ConveyancingCase;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class);
uses(RefreshDatabase::class);

it('performs AML checks and stores the result', function () {
    // Arrange: Create a conveyancing case and a client
    $conveyancingCase = ConveyancingCase::factory()->create();
    $client = Client::factory()->create();

    // Mock the AMLChecker service
    $amlChecker = Mockery::mock(\App\Contracts\AMLChecker::class);
    $amlChecker->shouldReceive('performCheck')
               ->once()
               ->with($client)
               ->andReturn(true); // Simulate a successful AML check

    // Act: Dispatch the PerformAMLChecks job
    // Note type hinting for AMLChecker will not work here
    (new PerformAMLChecks($conveyancingCase, $client))->handle($amlChecker);

    // Assert: Check that the AMLResult was created
    $this->assertDatabaseHas('aml_results', [
        'conveyancing_case_id' => $conveyancingCase->id,
        'client_id' => $client->id,
        'success' => true,
    ]);
});

it('handles a failed AML check', function () {
    // Arrange: Create a conveyancing case and a client
    $conveyancingCase = ConveyancingCase::factory()->create();
    $client = Client::factory()->create();

    // Mock the AMLChecker service
    $amlChecker = Mockery::mock(\App\Contracts\AMLChecker::class);
    $amlChecker->shouldReceive('performCheck')
               ->once()
               ->with($client)
               ->andReturn(false); // Simulate a failed AML check

    // Act: Dispatch the PerformAMLChecks job
    // Note type hinting for AMLChecker will not work here
    (new PerformAMLChecks($conveyancingCase, $client))->handle($amlChecker);

    // Assert: Check that the AMLResult was created
    $this->assertDatabaseHas('aml_results', [
        'conveyancing_case_id' => $conveyancingCase->id,
        'client_id' => $client->id,
        'success' => false,
    ]);
});