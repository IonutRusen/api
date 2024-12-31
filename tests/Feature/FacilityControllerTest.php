<?php

namespace Tests\Feature;

use App\Modules\Company\Model\Company;
use App\Modules\Facility\Controller\FacilityController;
use App\Modules\Facility\Model\Facility;
use App\Modules\User\Model\User;
use App\Repository\Repository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery;
use Tests\TestCase;

class FacilityControllerTest extends TestCase
{
    use RefreshDatabase;

    protected FacilityController $facilityController;
    protected Repository $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = \Mockery::mock(Repository::class);
        $this->facilityController = new FacilityController($this->repository);
    }

    /**
     * Test 'index' method of 'FacilityController' class
     */
    public function testIndex()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        // Mocking the getPaginated method
        $items = collect([/* your fake data here */]);
        $paginator = new LengthAwarePaginator($items, $items->count(), 10);

        $repositoryMock = Mockery::mock(Repository::class);
        $repositoryMock->shouldReceive('getPaginated')
            ->andReturn($paginator);

        // Inject the mock and perform your test as usual
        $this->app->instance(Repository::class, $repositoryMock);


        // Perform the API request with the token
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson(route('facility.index'));

        // Assert the response status
        $response->assertStatus(200);
    }

    /**
     * Test 'store' method of 'FacilityController' class
     */
    public function testStoreSuccessfullyCreatesFacility()
    {
        // Arrange
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;
        $company =  Company::factory()->create();

        $data = [
            'name' => 'Test Facility',
            'licence_no' => '1234567',
            'country_id' => 1,
            'time_zone_id' => 1,
            'pay_roll_cycle_id' => 1,
            'company_id' => $company->id,
        ];

        $repositoryMock = Mockery::mock(Repository::class);
        $repositoryMock->shouldReceive('create')

            ->with($data)
            ->andReturn((object)$data);

        $this->app->instance(Repository::class, $repositoryMock);

        // Act
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson(route('facility.store'),$data);

        // Assert the response status
        $response->assertStatus(200);
    }
    /**
     * Test 'show' method of 'FacilityController' class.
     */
    /**
     * Test 'show' method of 'FacilityController' class.
     */
    public function testShowSuccessfullyShowsFacility()
    {
        // Arrange
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;
        $facility = Facility::factory()->create();

        $repositoryMock = Mockery::mock(Repository::class);
        $repositoryMock->shouldReceive('findOrFail')
            ->with($facility->id)
            ->andReturn((object)$facility->toArray());

        $this->app->instance(Repository::class, $repositoryMock);

        // Act
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson(route('facility.show', ['facility' => $facility->id]));

        // Assert the response status
        $response->assertStatus(200);
    }

    /**
     * Test 'update' method of 'FacilityController' class
     */
    public function testUpdateSuccessfullyUpdatesFacility()
    {
        // Arrange
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;
        $facility = Facility::factory()->create();
        $data = [
            'name' => 'Updated Test Facility',
            'licence_no' => '7654321',
            'country_id' => 2,
            'time_zone_id' => 2,
            'pay_roll_cycle_id' => 2,
            'company_id' => $facility->company_id,
        ];

        $repositoryMock = Mockery::mock(Repository::class);
        $repositoryMock->shouldReceive('update')
            ->with($facility->id, $data)
            ->andReturn((object)$data);

        $this->app->instance(Repository::class, $repositoryMock);

        // Act
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->putJson(route('facility.update', $facility->id), $data);


        // Assert the response status and updated data
        $response->assertStatus(200);

    }

    /**
     * Test 'destroy' method of 'FacilityController' class
     */
    public function testDestroySuccessfullyRemovesFacility()
    {
        // Arrange
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;
        $facility = Facility::factory()->create();

        $repositoryMock = Mockery::mock(Repository::class);
        $repositoryMock->shouldReceive('deleteById')
            ->with($facility->id)
            ->andReturnNull();

        $this->app->instance(Repository::class, $repositoryMock);

        // Act
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->deleteJson(route('facility.destroy', $facility->id));

        // Assert the response status
        $response->assertStatus(200);
    }
}
