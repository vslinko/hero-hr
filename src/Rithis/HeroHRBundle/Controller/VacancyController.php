<?php

namespace Rithis\HeroHRBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\TemplateReference,
    FOS\RestBundle\Controller\FOSRestController,
    Symfony\Component\HttpFoundation\Response,
    FOS\Rest\Util\Codes;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache,
    FOS\RestBundle\Controller\Annotations\View,
    Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Rithis\HeroHRBundle\Form\Type\VacancyType,
    Rithis\HeroHRBundle\Entity\Vacancy;

/**
 * @Route("/vacancies")
 */
class VacancyController extends FOSRestController
{
    /**
     * Returns a collection of Vacancy
     *
     * @Route("/", options={"expose":true})
     * @Method("GET")
     * @Cache(expires="+5 Minutes")
     * @View(templateVar="vacancies")
     * @ApiDoc(resource=true)
     */
    public function allAction()
    {
        $vacancies = $this->getVacancyRepository()->findAll();

        if ($this->getRequest()->getRequestFormat() == 'html') {
            return [
                'vacancies' => $vacancies,
                'form' => $this->createForm(new VacancyType())->createView(),
            ];
        } else {
            return $vacancies;
        }
    }

    /**
     * Create a new Vacancy
     *
     * @Route("/", options={"expose":true})
     * @Method("POST")
     * @ApiDoc(input="Rithis\HeroHRBundle\Form\Type\VacancyType", return="Rithis\HeroHRBundle\Entity\Vacancy")
     */
    public function postAction()
    {
        $view = $this->view();

        $form = $this->createForm(new VacancyType());
        $form->bind($this->getRequest()->request->all());

        if ($form->isValid()) {
            $vacancy = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($vacancy);
            $em->flush();

            $locationUrl = $this->generateUrl('rithis_herohr_vacancy_get', ['slug' => $vacancy->getSlug()], true);

            $view->setData($vacancy);
            $view->setStatusCode(Codes::HTTP_CREATED);
            $view->setHeader('Location', $locationUrl);
            $view->setTemplate(new TemplateReference('RithisHeroHRBundle', 'Vacancy', 'get'));
            $view->setTemplateVar('vacancy');
            return $view;
        }

        $data = [];

        switch ($this->getRequest()->getRequestFormat()) {
            case 'html':
                $data['vacancies'] = $this->getVacancyRepository()->findAll();
                $data['form'] = $form->createView();
                $view->setTemplate('RithisHeroHRBundle:Vacancy:all.html.twig');
                break;
            case 'xml':
                $data['form'] = $form->createView();
                $view->setTemplate('RithisHeroHRBundle::errors.xml.twig');
                break;
            case 'json':
                $data = $form;
        }

        $view->setData($data);
        $view->setStatusCode(Codes::HTTP_BAD_REQUEST);

        return $view;
    }

    /**
     * Get a Vacancy
     *
     * @param string $slug Vacancy Slug
     *
     * @Route("/{slug}", requirements={"slug": "[-a-z0-9]+"}, options={"expose":true})
     * @Method("GET")
     * @View
     * @ApiDoc(input="Rithis\HeroHRBundle\Entity\Vacancy", return="Rithis\HeroHRBundle\Entity\Vacancy")
     */
    public function getAction(Vacancy $vacancy)
    {
        return $vacancy;
    }

    private function getVacancyRepository()
    {
        return $this->getDoctrine()->getManager()->getRepository('RithisHeroHRBundle:Vacancy');
    }
}
