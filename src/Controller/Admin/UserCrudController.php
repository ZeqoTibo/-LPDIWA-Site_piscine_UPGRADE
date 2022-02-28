<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;

class UserCrudController extends AbstractCrudController
{

    public function __construct(UserPasswordHasherInterface $passwordEncoder, Security $security
    )
    {
        $this->passwordEncoder = $passwordEncoder;
        if (null !== $security->getUser()) {
            $this->password = $security->getUser()->getPassword();
        }
    }


    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, "Utilisateur")
            ->setPageTitle(Crud::PAGE_NEW, "Création d'un utilisateur")
            ->setPageTitle(Crud::PAGE_EDIT, "Edition de l'utilisateur");
    }

    public function configureFields(string $pageName): iterable
    {
        $password = TextField::new('plainPassword')
            ->setFormType(PasswordType::class)
            ->setFormTypeOption("empty_data", "")
            ->setLabel("Mot de passe")
            ->setHelp("Si le mot de passe ne dois pas être changé, laissez le vide.")
            ->setRequired(false);

        $passwordNew = TextField::new('plainPassword')
            ->setFormType(PasswordType::class)
            ->setFormTypeOption("empty_data", "")
            ->setLabel("Mot de passe")
            ->setHelp("Par défaut, un mot de passe est généré. Veuillez le changer.")
            ->setRequired(true);

        switch ($pageName) {
            case Crud::PAGE_NEW:
                return [
                    TextField::new('username')->setFormTypeOptions(["attr" => ["class" => "form-control"]])->setLabel("Nom d'utilisateur"),
                    TextField::new('email')->setFormType(EmailType::class)->setFormTypeOptions(["attr" => ["class" => "form-control"]])->setLabel("Email"),
                    $passwordNew
                ];
            case Crud::PAGE_EDIT:
                return [
                    TextField::new('username')->setFormTypeOptions(["attr" => ["class" => "form-control"]])->setLabel("Nom d'utilisateur"),
                    TextField::new('email')->setFormType(EmailType::class)->setFormTypeOptions(["attr" => ["class" => "form-control"]])->setLabel("Email"),
                    $password
                ];
            default:
                return [
                    IdField::new('id'),
                    TextField::new('username')->setLabel("Nom d'utilisateur"),
                    TextField::new('email')->setLabel("Email"),
                ];
        }
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel("Créer un utilisateur");
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setLabel("Editer");
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setLabel("Supprimer");
            })
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER, function (Action $action) {
                return $action->setLabel("Créer et en ajouter un autre");
            })
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action->setLabel("Créer");
            })
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, function (Action $action) {
                return $action->setLabel("Sauvegarder et continuer d'éditer");
            })
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action->setLabel("Sauvegarder les changements");
            });
    }

}
