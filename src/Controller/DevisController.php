<?php


namespace App\Controller;


use App\Entity\Client;
use App\Form\ContactType;
use App\Entity\Devis;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DevisController extends AbstractController
{

    /**
     * @var ManagerRegistry $managerRegistry
     */
    private $entityManager;
    private $clientManager;


    public function __construct(ManagerRegistry $entityManager, ManagerRegistry $clientManager)
    {
        $this->entityManager = $entityManager;
        $this->clientManager = $clientManager;

    }

    /**
     * @Route("/etapeVersFond" , name="Devis-fond")
     * @param SessionInterface $session
     * @param Request $request
     * @return null
     */
    public function etapeVersFondAction(SessionInterface $session, Request $request)
    {
        $forme_piscine = $request->request->get("choix1", "rectangulaire");

        $session->set('forme', $forme_piscine);

        if ($session->get('forme') == "Rectangulaire")
            $session->set('prixForme', 1500);
        else
            $session->set('prixForme',2000);

        return $this->render('site/fond.html.twig');
    }

    /**
     * @Route("/etapeVersCouleur" , name="Devis-couleur")
     * @param SessionInterface $session
     * @param Request $request
     * @return null
     */
    public function etapeVersCouleurAction(SessionInterface $session, Request $request)
    {

        $fond_piscine = $request->request->get("choix2", "plate");

        $session->set('fond', $fond_piscine);
        if ($session->get('fond') == 'Fond progressif')
            $session->set('prixFond', 3000);
        else
            $session->set('prixFond', 2000);

        return $this->render('site/couleur.html.twig');
    }

    /**
     * @Route("/etapeVersTaille" , name="Devis-taille")
     * @param SessionInterface $session
     * @param Request $request
     * @return null
     */
    public function etapeVersTailleAction(SessionInterface $session, Request $request)
    {

        $couleur_piscine = $request->request->get("choix3", "blanc");

        $session->set('couleur', $couleur_piscine);

        switch ($session->get('couleur')) {
            case 'Bleu' :
                $session->set('prixCouleur', 350);
                break;
            case 'Jaune' :
                $session->set('prixCouleur', 250);
                break;
            case 'Rose':
            case 'Rouge' :
                $session->set('prixCouleur', 700);
                break;
            case 'Vert' :
                $session->set('prixCouleur', 450);
                break;
            case 'Orange' :
                $session->set('prixCouleur', 300);
                break;
            default:
                $session->set('prixCouleur', 100);
                break;
        }

        $forme = $session->get('forme');

        if ($forme == "Rectangulaire") {
            return $this->render('site/tailleRect.html.twig');
        } else {
            return $this->render('site/tailleRond.html.twig');
        }
    }

    /**
     * @Route("/etapeVersResume" , name="Devis-resume")
     * @param SessionInterface $session
     * @param Request $request
     * @return null
     */
    public function etapeVersResume(SessionInterface $session, Request $request)
    {
        $largeur = $request->request->get("largeur", 12);
        $longueur = $request->request->get("longueur", 12);
        $diametre = $request->request->get("diametre", 12);

        if ($session->get('forme') == 'Rectangulaire') {
            $session->set('largeur', $largeur);
            $session->set('longueur', $longueur);
            switch ($largeur) {
                case $largeur <= 5 :
                    $session->set('prixLargeur', 1500);
                    break;
                case $largeur <= 8 :
                    $session->set('prixLargeur', 2500);
                    break;
                case $largeur <= 10 :
                    $session->set('prixLargeur', 4000);
                    break;
                case $largeur <= 12 :
                    $session->set('prixLargeur', 6000);
                    break;
                case $largeur <= 15 :
                    $session->set('prixLargeur', 8000);
                    break;
                case $largeur <= 20 :
                    $session->set('prixLargeur', 10000);
                    break;
            }
            switch ($longueur) {
                case $longueur <= 5 :
                    $session->set('prixLongueur', 1500);
                    break;
                case $longueur <= 8 :
                    $session->set('prixLongueur', 2500);
                    break;
                case $longueur <= 10 :
                    $session->set('prixLongueur', 4000);
                    break;
                case $longueur <= 12 :
                    $session->set('prixLongueur', 6000);
                    break;
                case $longueur <= 15 :
                    $session->set('prixLongueur', 8000);
                    break;
                case $longueur <= 20 :
                    $session->set('prixLongueur', 10000);
                    break;
            }
        } else if ($session->get('forme') == 'Ronde'){
            $session->set('diametre', $diametre);
            switch ($diametre) {
                case $diametre <= 5 :
                    $session->set('prixDiametre', 3000);
                    break;
                case $diametre <= 8 :
                    $session->set('prixDiametre', 5000);
                    break;
                case $diametre <= 10 :
                    $session->set('prixDiametre', 8000);
                    break;
                case $diametre <= 12 :
                    $session->set('prixDiametre', 12000);
                    break;
                case $diametre <= 15 :
                    $session->set('prixDiametre', 16000);
                    break;
                case $diametre <= 20 :
                    $session->set('prixDiametre', 20000);
                    break;
            }
        }
        return $this->render('site/resume.html.twig', [
            'forme' => $session->get('forme'),
            'fond' => $session->get('fond'),
            'couleur' => $session->get('couleur'),
            'largeur' => $session->get('largeur'),
            'longueur' => $session->get('longueur'),
            'diametre' => $session->get('diametre'),
        ]);

    }

    /**
     * @Route("/envoiDevis" , name="envoiDevis")
     * @return Response
     */
    public function envoieDevisAction(SessionInterface $session, Request $request, \Swift_Mailer $mailer)
    {

        $formDevis = new Client();

        $form = $this->createForm(ContactType::class, $formDevis);
        $form->handleRequest($request);

        $forme = $session->get('forme');
        $fond = $session->get('fond');
        $couleur = $session->get('couleur');
        $prixForme = $session->get('prixForme');
        $prixFond = $session->get('prixFond');
        $prixCouleur = $session->get('prixCouleur');
        $largeur = $session->get('largeur');
        $longueur = $session->get('longueur');
        $diametre = $session->get('diametre');
        $prixTotal =0;

        if ($forme == 'Rectangulaire') {
            $prixLargeur = $session->get('prixLargeur');
            $prixLongueur = $session->get('prixLongueur');
            $prixTotal = $prixForme + $prixFond + $prixCouleur + $prixLargeur + $prixLongueur;
            $session->set('prixTotal', $prixTotal);

        } else if ($forme == 'Ronde') {
            $prixDiametre = $session->get('prixDiametre');
            $prixTotal = $prixForme + $prixFond + $prixCouleur + $prixDiametre;
            $session->set('prixTotal', $prixTotal);
        }
        if ($form->isSubmitted() && $form->isValid()) {


            $devis = new Devis();
            $devis->setForme($forme);
            $devis->setFond($fond);
            $devis->setCouleur($couleur);

            if ($forme == 'Rectangulaire') {
                $devis->setLargeur($largeur);
                $devis->setLongueur($longueur);
            } else if ($forme == 'Ronde') {
                $devis->setDiametre($diametre);
            }

            $devis->setPrix($prixTotal);
            $devis->setClient($formDevis);
            $this->entityManager->getManager()->persist($devis);
            $this->clientManager->getManager()->persist($formDevis);
            $this->entityManager->getManager()->flush();
            $this->clientManager->getManager()->flush();


            switch ($forme) {
                default;
                case 'Rectangulaire':

                    $contact = $form->getData();

                    // ici on envoi me mail

                    $message = (new \Swift_Message('Votre Estimation - TOPISCINES'))

                        // On attribue le destinataire
                        ->setFrom('projetdiwasymfo@gmail.com')

                        // On attribue l'expediteur

                        ->setTo($contact->getEmail())

                        // On attribue le message avec la vue Twig
                        ->setBody(
                            $this->renderView('emails/contact.html.twig', compact('contact', 'forme', 'fond', 'couleur', 'largeur', 'longueur', 'prixTotal')),
                            'text/html'
                        );
                    // On envoie le message
                    $mailer->send($message);

                    $this->addFlash('message', 'Votre devis à bien été envoyé sur votre adresse : '.$contact->getEmail()); // Permet un message flash de renvoi
                    return $this->redirectToRoute('accueil');
                case 'Ronde':

                    $contact = $form->getData();

                    // ici on envoi me mail
                    $message = (new \Swift_Message('Votre estimation - TOPISCINES'))

                        // On attribue l'expéditeur
                        ->setFrom('projetdiwasymfo@gmail.com')

                        // On attribue le destinataire
                        ->setTo($contact->getEmail())

                        // On attribue le message avec la vue Twig
                        ->setBody(
                            $this->renderView('emails/contact.html.twig', compact('contact', 'forme', 'fond', 'couleur', 'diametre', 'prixTotal' )),
                            'text/html'
                        );

                    // On envoie le message
                    $mailer->send($message);

                    $this->addFlash('message', 'Votre devis à bien été envoyé sur votre adresse : '.$contact->getEmail()); // Permet un message flash de renvoi
                    return $this->redirectToRoute('accueil');
            }

        }

        return $this->render('site/envoiDevis.html.twig', [
            'devisForm' => $form->createView()
        ]);
    }


}
