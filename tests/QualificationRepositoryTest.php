<?php

use App\Models\Qualification;
use App\Repositories\QualificationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class QualificationRepositoryTest extends TestCase
{
    use MakeQualificationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var QualificationRepository
     */
    protected $qualificationRepo;

    public function setUp()
    {
        parent::setUp();
        $this->qualificationRepo = App::make(QualificationRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateQualification()
    {
        $qualification = $this->fakeQualificationData();
        $createdQualification = $this->qualificationRepo->create($qualification);
        $createdQualification = $createdQualification->toArray();
        $this->assertArrayHasKey('id', $createdQualification);
        $this->assertNotNull($createdQualification['id'], 'Created Qualification must have id specified');
        $this->assertNotNull(Qualification::find($createdQualification['id']), 'Qualification with given id must be in DB');
        $this->assertModelData($qualification, $createdQualification);
    }

    /**
     * @test read
     */
    public function testReadQualification()
    {
        $qualification = $this->makeQualification();
        $dbQualification = $this->qualificationRepo->find($qualification->id);
        $dbQualification = $dbQualification->toArray();
        $this->assertModelData($qualification->toArray(), $dbQualification);
    }

    /**
     * @test update
     */
    public function testUpdateQualification()
    {
        $qualification = $this->makeQualification();
        $fakeQualification = $this->fakeQualificationData();
        $updatedQualification = $this->qualificationRepo->update($fakeQualification, $qualification->id);
        $this->assertModelData($fakeQualification, $updatedQualification->toArray());
        $dbQualification = $this->qualificationRepo->find($qualification->id);
        $this->assertModelData($fakeQualification, $dbQualification->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteQualification()
    {
        $qualification = $this->makeQualification();
        $resp = $this->qualificationRepo->delete($qualification->id);
        $this->assertTrue($resp);
        $this->assertNull(Qualification::find($qualification->id), 'Qualification should not exist in DB');
    }
}
