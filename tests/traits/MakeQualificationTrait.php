<?php

use Faker\Factory as Faker;
use App\Models\Qualification;
use App\Repositories\QualificationRepository;

trait MakeQualificationTrait
{
    /**
     * Create fake instance of Qualification and save it in database
     *
     * @param array $qualificationFields
     * @return Qualification
     */
    public function makeQualification($qualificationFields = [])
    {
        /** @var QualificationRepository $qualificationRepo */
        $qualificationRepo = App::make(QualificationRepository::class);
        $theme = $this->fakeQualificationData($qualificationFields);
        return $qualificationRepo->create($theme);
    }

    /**
     * Get fake instance of Qualification
     *
     * @param array $qualificationFields
     * @return Qualification
     */
    public function fakeQualification($qualificationFields = [])
    {
        return new Qualification($this->fakeQualificationData($qualificationFields));
    }

    /**
     * Get fake data of Qualification
     *
     * @param array $postFields
     * @return array
     */
    public function fakeQualificationData($qualificationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'description' => $fake->word,
            'status' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $qualificationFields);
    }
}
