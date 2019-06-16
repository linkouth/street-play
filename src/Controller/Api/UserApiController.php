<?php


namespace App\Controller\Api;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserApiController
 * @package App\Controller\Api
 */
class UserApiController extends AbstractApiController
{
    /**
     * @param int $id
     * @return Response
     *
     * @Route("/users/{id}", methods={GET}, requirements={"id"="%d"})
     */
    public function show(int $id): Response
    {
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($id);

        if ($user) {
            $json = $this->serializer->serialize(
                [
                    "nickname" => $user->getSurname(),
                ],
                "json",
                ['groups' => ["show"]]
            );
            return $this->createResponse($json);
        } else {
            $this->createResponse(null);
        }
    }
}