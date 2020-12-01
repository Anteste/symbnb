<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\Image;
use App\Form\AnnonceType;
use App\Repository\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use function Sodium\add;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index(AdRepository $repo)
    {
        $ads = $repo->findAll();

        return $this->render('ad/index.html.twig', [
            'ads' => $ads,
        ]);
    }

    /**
     * Permet de creer une annonce
     *
     * @Route("/ads/new", name="ads_create")
     * @IsGranted("ROLE_USER")
     *
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $ad = new Ad();

        $form = $this->createForm(AnnonceType::class, $ad);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            foreach ($ad->getImages() as $image)
            {
                $image->setAd($ad);
                $manager->persist($image);
            }

                $ad->setAuthor($this->getUser());

            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <b>{$ad->getTitle()}</b> a bien été enregistrée !"
            );

            return $this->redirectToRoute('ads_show', [
                'slug' => $ad->getSlug()
            ]);
        }

        return $this->render('ad/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet de modifier une annonce
     *
     * @Route("/ads/{slug}/edit", name="ads_edit")
     * @Security("is_granted('ROLE_USER') and user === ad.getAuthor()", message="Cette annonce ne vous appartient pas, vous ne pouvez pas la modifier")
     *
     * @return Response
     */
    public function edit(Ad $ad, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(AnnonceType::class, $ad);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            foreach ($ad->getImages() as $image)
            {
                $image->setAd($ad);
                $manager->persist($image);
            }

            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "Les modifications de l'annonces <b>{$ad->getTitle()}</b> ont bien été enregistrées !"
            );

            return $this->redirectToRoute('ads_show', [
                'slug' => $ad->getSlug()
            ]);
        }

        return$this->render('ad/edit.html.twig', [
            'form' => $form->createView(),
            'ad' => $ad
        ]);
    }

    /**
     * Permet d'afficher une seule annonce
     *
     * @Route("/ads/{slug}", name="ads_show")
     *
     * @return Response
     */
    public function show(Ad $ad)
    {
        return $this->render('ad/show.html.twig',
            [
               'ad' => $ad
            ]);
    }
}
