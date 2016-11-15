<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class QualificationApiTest extends TestCase
{
    use MakeQualificationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateQualification()
    {
        $qualification = $this->fakeQualificationData();
        $this->json('POST', '/api/v1/qualifications', $qualification);

        $this->assertApiResponse($qualification);
    }

    /**
     * @test
     */
    public function testReadQualification()
    {
        $qualification = $this->makeQualification();
        $this->json('GET', '/api/v1/qualifications/'.$qualification->id);

        $this->assertApiResponse($qualification->toArray());
    }

    /**
     * @test
     */
    public function testUpdateQualification()
    {
        $qualification = $this->makeQualification();
        $editedQualification = $this->fakeQualificationData();

        $this->json('PUT', '/api/v1/qualifications/'.$qualification->id, $editedQualification);

        $this->assertApiResponse($editedQualification);
    }

    /**
     * @test
     */
    public function testDeleteQualification()
    {
        $qualification = $this->makeQualification();
        $this->json('DELETE', '/api/v1/qualifications/'.$qualification->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/qualifications/'.$qualification->id);

        $this->assertResponseStatus(404);
    }
}
