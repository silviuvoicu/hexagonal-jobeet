<?php

namespace Jobeet\Bundle\FinderBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Jobeet\Finder\Application\UseCase\Dto\Job\Job;
use Jobeet\Bundle\FinderBundle\Form\Type\JobType;

/**
 * Job\Job controller.
 *
 * @Route("/job")
 */
class JobController extends Controller
{
    /**
     * Lists all Job\Job entities.
     *
     * @Route("/", name="job")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('JobeetFinderBundle:Job\Job')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Job\Job entity.
     *
     * @Route("/", name="job_create")
     * @Method("POST")
     * @Template("JobeetFinderBundle:Job\Job:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $dto = new Job();
        $form = $this->createCreateForm($dto);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get('jobeet.finder.use_case.create_job')->execute($dto);

            return $this->redirect($this->generateUrl('job_show', array('token' => $dto->getToken())));
        }

        return array(
            'entity' => $dto,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Job\Job entity.
    *
    * @param Job $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Job $entity = null)
    {
        $form = $this->createForm('job', $entity, array(
            'action' => $this->generateUrl('job_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Job\Job entity.
     *
     * @Route("/new", name="job_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $form   = $this->createCreateForm();

        return array(
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Job\Job entity.
     *
     * @Route("/{token}", name="job_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($token)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JobeetFinderBundle:Job\Job')->findOneByToken($token);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Job\Job entity.');
        }

        $deleteForm = $this->createDeleteForm($token);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Job\Job entity.
     *
     * @Route("/{id}/edit", name="job_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JobeetFinderBundle:Job\Job')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Job\Job entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Job\Job entity.
    *
    * @param Job $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Job $entity)
    {
        $form = $this->createForm(new JobType(), $entity, array(
            'action' => $this->generateUrl('job_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Job\Job entity.
     *
     * @Route("/{id}", name="job_update")
     * @Method("PUT")
     * @Template("JobeetFinderBundle:Job\Job:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JobeetFinderBundle:Job\Job')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Job\Job entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('job_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Job\Job entity.
     *
     * @Route("/{id}", name="job_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('JobeetFinderBundle:Job\Job')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Job\Job entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('job'));
    }

    /**
     * Creates a form to delete a Job\Job entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('job_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
