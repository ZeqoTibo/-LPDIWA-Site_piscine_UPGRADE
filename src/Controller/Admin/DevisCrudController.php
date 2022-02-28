<?php

namespace App\Controller\Admin;

use App\Entity\Devis;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DevisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Devis::class;
    }

    public function configureFields(string $pageName): iterable
    {
        switch ($pageName) {
            default:
                return [
                    IdField::new('id'),
                    TextField::new('forme')->setLabel("Forme"),
                    TextField::new('fond')->setLabel("Fond"),
                    TextField::new('couleur')->setLabel("Couleur"),
                    IntegerField::new('largeur')->setLabel("Largeur"),
                    IntegerField::new('longueur')->setLabel("Longueur"),
                    IntegerField::new('diametre')->setLabel("Diametre"),
                    MoneyField::new('prix')->setLabel("Prix")->setStoredAsCents(false)->setNumDecimals(0)->setCurrency('EUR'),
                    AssociationField::new('client')->setLabel('Client')
                    ];
        }
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->remove(Crud::PAGE_INDEX,Action::EDIT);

    }


}
