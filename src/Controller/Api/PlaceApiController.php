<?php


namespace App\Controller\Api;

use App\Entity\Place;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlaceApiController extends AbstractApiController
{
    /**
     * @return Response
     *
     * @Route("/places", methods={"GET"})
     */
    public function index(): Response
    {
        $entity = $this->getDoctrine()
            ->getRepository(Place::class)
            ->findAll();

        $json = $this->serializer->serialize($entity,"json", ['groups' => ["list"]]);
        return $this->createResponse($json);
    }

    /**
     * @param int $id
     * @return Response
     *
     * @Route("/places/{id}", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function show(int $id): Response
    {
        $entity = $this->getDoctrine()
            ->getRepository(Place::class)
            ->find($id);

        $json = $this->serializer->serialize($entity,"json", ['groups' => ["show"]]);
        return $this->createResponse($json);
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/places", methods={"POST"})
     */
    public function new(Request $request): Response
    {

        $entity = $this->serializer->deserialize($request->getContent(), Place::class, 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();

        $json = $this->serializer->serialize($entity,"json", ['groups' => ["show"]]);
        return $this->createResponse($json);
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/places", methods={"PATCH"})
     */
    public function edit(Request $request): Response
    {
        $entity = $this->serializer->deserialize($request->getContent(), Place::class, 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();

        $json = $this->serializer->serialize($entity,"json", ['groups' => ["show"]]);
        return $this->createResponse($json);
    }

    /**
     * @param int $id
     * @return Response
     *
     * @Route("/places/{id}", methods={"DELETE"},  requirements={"id"="\d+"})
     */
    public function delete(int $id): Response
    {
        $entity = $this->getDoctrine()->getRepository(Place::class)->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();

        $json = $this->serializer->serialize('Ok', 'json', ['groups' => ["show"]]);
        return $this->createResponse($json);
    }
}