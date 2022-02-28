<?php

namespace App\EventSubscriber;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Event\EntityLifecycleEventInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Exception;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PasswordHasherSubscriber implements EventSubscriberInterface
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityUpdatedEvent::class => ['updatePasswordHash'],
            BeforeEntityPersistedEvent::class => ['createPasswordHash'],
        ];
    }

    /**
     * Créer un hash du mot de passe passé en paramètre
     * @param EntityLifecycleEventInterface $event - événement générique qui renvoie les informations que l'on a besoin pour mettre à jour notre entité (ou la créer)
     * @return void
     */
    public function createPasswordHash(EntityLifecycleEventInterface $event): void
    {
        $entity = $event->getEntityInstance();
        // seulement si c'est une instance d'utilisateur
        if ($entity instanceof User) {

            // vérifie que la méthode existe bien
            if (method_exists($entity, 'setPassword')) {

                // si le mot de passe n'est pas présent on l'ajoute
                if ($entity->getPlainPassword() === null || $entity->getPlainPassword() === "") {
                    $encodedPassword = $this->passwordHasher->hashPassword($entity, $this->_generatePassword(32));
                } else {
                    //Suppression des espaces
                    $passwd = trim($entity->getPlainPassword());
                    $encodedPassword = $this->passwordHasher->hashPassword($entity, $passwd);
                }
                // Met à jour le MDP de l'utilisateur que l'on viens de créer.
                $entity->setPassword($encodedPassword);
                // supprime le MDP ici
                $entity->setPlainPassword(null);
            }
        }
    }


    public function updatePasswordHash(EntityLifecycleEventInterface $event): void
    {
        $entity = $event->getEntityInstance();
        // seulement si c'est une instance d'utilisateur
        if (($entity instanceof User)) {
            if (method_exists($entity, 'setPassword')) {
                if ($entity->getPlainPassword() !== null && $entity->getPlainPassword() !== "" && strlen($entity->getPlainPassword()) > 0) {
                    //Suppression des espaces
                    $clearPassword = trim($entity->getPlainPassword());
                    if ($clearPassword !== '') {
                        $encodedPassword = $this->passwordHasher->hashPassword($entity, $clearPassword);
                        $entity->setPassword($encodedPassword);
                        $entity->setPlainPassword(null);
                    }
                }
            }
        }
    }

    /**
     * Génère un mot de passe de force pour éviter tous attaque
     * @private
     * @param int|null $length - Longueur du mdp à encrypté
     * @return string
     */
    private function _generatePassword(?int $length): ?string
    {
        if (!isset($length) || intval($length) <= 8) {
            $length = 32;
        }
        // vérifie que la fonction existe bien
        if (function_exists('random_bytes')) {
            try {
                return bin2hex(random_bytes(32));
            } catch (Exception $e) {
                // en cas d'exception on passe sur openssl
                return bin2hex(openssl_random_pseudo_bytes($length));
            }
        }
        if (function_exists('openssl_random_pseudo_bytes')) {
            return bin2hex(openssl_random_pseudo_bytes($length));
        }
        return "";
    }

}
