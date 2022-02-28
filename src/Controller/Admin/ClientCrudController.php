<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Client::class;
    }

    public function configureFields(string $pageName): iterable
    {
         switch ($pageName) {
            case Crud::PAGE_EDIT:
            case Crud::PAGE_NEW:
                return [
                    TextField::new('nom')
                        ->setFormTypeOptions(["attr" => ["class" => "form-control"]])
                        ->setLabel("Nom"),
                    TextField::new('prenom')
                        ->setFormTypeOptions(["attr" => ["class" => "form-control"]])
                        ->setLabel("Prenom"),
                    EmailField::new('email')
                        ->setFormTypeOptions(["attr" => ["class" => "form-control"]])
                        ->setLabel("Email"),
                    TelephoneField::new('tel')
                        ->setFormTypeOptions(["attr" => ["class" => "form-control"]])
                        ->setLabel("Téléphone"),
                    TextField::new('ville')
                        ->setFormTypeOptions(["attr" => ["class" => "form-control"]])
                        ->setLabel("Ville"),
                    IntegerField::new('cp')
                        ->setFormTypeOptions(["attr" => ["class" => "form-control"]])
                        ->setLabel("Code Postal"),

                ];

            default:
                return [
                    IdField::new('id'),
                    TextField::new('nom')->setLabel("Nom"),
                    TextField::new('prenom')->setLabel("Prénom"),
                    TextField::new('email')->setLabel("Email"),
                    TextField::new('ville')->setLabel("Ville"),
                    IntegerField::new('cp')->setLabel("Code postale"),

                ];
        }
    }

}
