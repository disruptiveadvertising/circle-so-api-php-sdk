<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\Course;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;
use AdroSoftware\CircleSoSdk\Exception\{
    CommunityIdNotPresentException,
    UnsuccessfulResponseException,
};

class Courses extends AbstractEndpoint implements EndpointInterface
{
    /**
     * @throws CommunityIdNotPresentException
     */
    public function sections($params = [], ?int $communityId = null): mixed
    {
        $this->ensureCommunityIdIsPresent($communityId);
        $query = ['community_id=' . $this->communityId];
        foreach($params as $n=>$v)
            $query[] = "$n=$v";

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->get(
                "/course_sections?" . implode('&', $query)
            )
        );
    }

    /**
     * @throws CommunityIdNotPresentException
     * @throws UnsuccessfulResponseException
     */
    public function showSection(int $id, ?int $communityId = null): mixed
    {
        $this->ensureCommunityIdIsPresent($communityId);

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->get(
                "/course_sections/{$id}?community_id={$this->communityId}"
            )
        );
    }

    /**
     * @throws CommunityIdNotPresentException
     */
    public function lessons($params = [], ?int $communityId = null): mixed
    {
        $this->ensureCommunityIdIsPresent($communityId);
        $query = ['community_id=' . $this->communityId];
        foreach($params as $n=>$v)
            $query[] = "$n=$v";

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->get(
                "/course_lessons?" . implode('&', $query)
            )
        );
    }

    /**
     * @throws CommunityIdNotPresentException
     * @throws UnsuccessfulResponseException
     */
    public function showLesson(int $id, ?int $communityId = null): mixed
    {
        $this->ensureCommunityIdIsPresent($communityId);

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->get(
                "/course_lessons/{$id}?community_id={$this->communityId}"
            )
        );
    }

    /**
     * Create a course lesson.
     *
     * @throws CommunityIdNotPresentException
     * @throws UnsuccessfulResponseException
     */
    public function createLesson(
        array $data,
        ?int $communityId = null,
    ): mixed {
        $this->ensureCommunityIdIsPresent($communityId);

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->post(
                uri: "/course_lessons?community_id={$this->communityId}",
                body: json_encode($data),
            )
        );
    }

    /**
     * Delete a course lesson.
     *
     * @throws CommunityIdNotPresentException
     * @throws UnsuccessfulResponseException
     */
    public function deleteLesson(
        int $id,
        ?int $communityId = null,
    ): mixed {
        $this->ensureCommunityIdIsPresent($communityId);

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->delete(
                "/course_lessons/{$id}?community_id={$this->communityId}",
            )
        );
    }
}
