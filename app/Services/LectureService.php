<?php

namespace App\Services;

use App\Repositories\LectureRepository;

class LectureService
{
    protected $lectureRepository;

    public function __construct(LectureRepository $lectureRepository)
    {
        $this->lectureRepository = $lectureRepository;
    }

    /**
     * Create a new lecture
     * Handles resources uploaded via Flora (URL or path)
     */
    public function createLecture(array $data)
    {
        // If Flora sends a resource URL/path, save it directly
        if (!empty($data['resources'])) {
            $data['resources'] = $data['resources'];
        }

        return $this->lectureRepository->createLecture($data);
    }

    /**
     * Update an existing lecture
     * Handles resources uploaded via Flora (URL or path)
     */
    public function updateLecture(array $data, $id)
    {
        // If Flora sends a resource URL/path, save it directly
        if (!empty($data['resources'])) {
            $data['resources'] = $data['resources'];
        }

        return $this->lectureRepository->updateLecture($data, $id);
    }
}
