<?php   

namespace App\Controller\Api;

use App\Entity\Department;
use App\Form\DepartmentType;
use App\Repository\DepartmentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Serializer;


class DepartmentController extends AbstractController
{
    /**
     * @Route("/api/department", name="app_api_department", methods={"GET"})
     */
    public function departmentList(DepartmentRepository $departmentRepository): Response
    {
        $departments = $departmentRepository->findAll();

        return $this->json($departments, Response::HTTP_OK,[], ['groups' => 'api_departments_list']);
    }

}