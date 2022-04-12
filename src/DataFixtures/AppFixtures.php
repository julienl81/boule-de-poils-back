<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use App\Entity\Association;
use App\Entity\Department;
use App\Entity\Species;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $faker->seed(806);
        
        // $product = new Product();
        // $manager->persist($product);

        // prépartion des données

        // ! On veut créer une liste de 4 espèces et les stocker dans un tableau
        $species = [
            'Chat',
            'Chien',
            'Lapin',
            'Rongeurs'
        ];

       // va contenir les objets espèces que l'on a créé
       $speciesObjects = [];

       foreach ($species as $currentSpecies) {
           // On crée une nouvelle espèce
           $species = new Species();
           // On lui donne un nom
           $species->setName($currentSpecies);
           // On stocke l'espèce dans le tableau
           $speciesObjects[] = $species;
            // On l'enregistre dans le manager
           $manager->persist($species);
        }

        // ! On crée des users
        $admin = new User();
        $admin->setPseudo('admin');
        $admin->setEmail('admin@admin.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword('$2y$13$mpcFCRBquPyK9t95MZJBPeE0gPjHGfMoA.09ZjWlCAcL0ZQRvXWi2');
        $admin->setActive(1); // 1 = true
        $manager->persist($admin);

        $association = new User();
        $association->setPseudo('association');
        $association->setEmail('association@association.com');
        $association->setRoles(['ROLE_ASSOCIATION']);
        $association->setPassword('$2y$13$zM5O0WCkukKEDR3osiDnMeF2lDHsVUmCDE5WLkk6RBAGPnhlZ2fLK');
        $association->setActive(1); // 1 = true
        // Attention $manager = le Manager de Doctrine :D
        $manager->persist($association);

        $user = new User();
        $user->setPseudo('user');
        $user->setEmail('user@user.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword('$2y$13$OC8AAfLtX5T/8P8rL0qNQOwZHNDCsTEYTSXTzcTKG2WG/1R0VnYVK');
        $user->setActive(1); // 1 = true
        $manager->persist($user);
        

        // ! On veut créer une liste des départements et les stocker dans un tableau
        $department = [
            '01 - Ain',
            '02 - Aisne',
            '03 - Allier',
            '04 - Alpes-de-Haute-Provence',
            '05 - Hautes-alpes',
            '06 - Alpes-maritimes',
            '07 - Ardèche',
            '08 - Ardennes',
            '09 - Ariège',
            '10 - Aube',
            '11 - Aude',
            '12 - Aveyron',
            '13 - Bouches-du-Rhône',
            '14 - Calvados',
            '15 - Cantal',
            '16 - Charente',
            '17 - Charente-maritime',
            '18 - Cher',
            '19 - Corrèze',
            '2A - Corse-du-sud',
            '2B - Haute-Corse',
            '21 - Côte-d\'Or',
            '22 - Côtes-d\'Armor',
            '23 - Creuse',
            '24 - Dordogne',
            '25 - Doubs',
            '26 - Drôme',
            '27 - Eure',
            '28 - Eure-et-loir',
            '29 - Finistère',
            '30 - Gard',
            '31 - Haute-garonne',
            '32 - Gers',
            '33 - Gironde',
            '34 - Hérault',
            '35 - Ille-et-vilaine',
            '36 - Indre',
            '37 - Indre-et-loire',
            '38 - Isère',
            '39 - Jura',
            '40 - Landes',
            '41 - Loir-et-cher',
            '42 - Loire',
            '43 - Haute-loire',
            '44 - Loire-atlantique',
            '45 - Loiret',
            '46 - Lot',
            '47 - Lot-et-garonne',
            '48 - Lozère',
            '49 - Maine-et-loire',
            '50 - Manche',
            '51 - Marne',
            '52 - Haute-marne',
            '53 - Mayenne',
            '54 - Meurthe-et-moselle',
            '55 - Meuse',
            '56 - Morbihan',
            '57 - Moselle',
            '58 - Nièvre',
            '59 - Nord',
            '60 - Oise',
            '61 - Orne',
            '62 - Pas-de-calais',
            '63 - Puy-de-dôme',
            '64 - Pyrénées-atlantiques',
            '65 - Hautes-Pyrénées',
            '66 - Pyrénées-orientales',
            '67 - Bas-rhin',
            '68 - Haut-rhin',
            '69 - Rhône',
            '70 - Haute-saône',
            '71 - Saône-et-loire',
            '72 - Sarthe',
            '73 - Savoie',
            '74 - Haute-savoie',
            '75 - Paris',
            '76 - Seine-maritime',
            '77 - Seine-et-marne',
            '78 - Yvelines',
            '79 - Deux-sèvres',
            '80 - Somme',
            '81 - Tarn',
            '82 - Tarn-et-Garonne',
            '83 - Var',
            '84 - Vaucluse',
            '85 - Vendée',
            '86 - Vienne',
            '87 - Haute-vienne',
            '88 - Vosges',
            '89 - Yonne',
            '90 - Territoire de belfort',
            '91 - Essonne',
            '92 - Hauts-de-seine',
            '93 - Seine-Saint-Denis',
            '94 - Val-de-marne',
            '95 - Val-d\'Oise',
            '971 - Guadeloupe',
            '972 - Martinique',
            '973 - Guyane',
            '974 - La réunion',
            '976 - Mayotte'
        ];

       // va contenir les objets espèces que l'on a créé
       $departmentObjects = [];

       foreach ($department as $currentDepartment) {
           // On crée unnouveau département
           $department = new Department();
           // On lui donne un nom
           $department->setName($currentDepartment);
           $department->setNumber(0);
           // On stocke le département dans le tableau
           $departmentObjects[] = $department;
            // On l'enregistre dans le manager
           $manager->persist($department);
        }


        // ! On veut créer une liste des associations
        $nbAssociation = 20;

        // va contenir les objets associations que l'on a créé
        $associationObjects = [];

       for ($associationCount = 0; $associationCount < $nbAssociation; $associationCount++) {
           $association = new Association();
           $association->setName($faker->company());
           $association->setDescription($faker->text(100));
           $association->setSiren($faker->siren());
           $association->setStreet($faker->streetAddress());
           $association->setZipCode($faker->postcode());
           $association->setCity($faker->city());
           $association->setPhoneNumber($faker->phoneNumber());
           $association->setEmail($faker->email());
           $association->setActive($faker->boolean(80));
           
           $manager->persist($association);
           $associationObjects[] = $association;
           
        }


       // ! On créer une liste d'url d'images personnalisées
       $imageAninmal = [
        'https://cdn.pixabay.com/photo/2020/02/29/18/59/rabbit-4890861_960_720.jpg',
        'https://cdn.pixabay.com/photo/2017/07/13/16/10/cute-2500929_960_720.jpg',
        'https://cdn.pixabay.com/photo/2017/07/25/01/22/cat-2536662_960_720.jpg',
        'https://cdn.pixabay.com/photo/2017/03/26/00/57/easter-2174681_960_720.jpg',
        'https://cdn.pixabay.com/photo/2019/07/31/19/21/hare-4375952_960_720.jpg',
        'https://cdn.pixabay.com/photo/2017/11/09/21/41/cat-2934720_960_720.jpg',
        'https://cdn.pixabay.com/photo/2019/07/07/07/18/hare-4321913_960_720.jpg',
        'https://cdn.pixabay.com/photo/2018/08/08/05/12/cat-3591348_960_720.jpg',
        'https://cdn.pixabay.com/photo/2016/03/24/12/27/bunny-1276628_960_720.jpg',
        'https://cdn.pixabay.com/photo/2018/03/23/15/38/tiger-cat-3254032_960_720.jpg',
        'https://cdn.pixabay.com/photo/2019/06/28/09/58/rabbit-4303823_960_720.jpg',
        'https://cdn.pixabay.com/photo/2017/08/16/10/39/hare-2647220_960_720.jpg',
        'https://cdn.pixabay.com/photo/2019/09/05/07/50/border-collie-4453408_960_720.jpg',
        'https://cdn.pixabay.com/photo/2017/09/07/23/35/cat-2727159_960_720.jpg',
        'https://cdn.pixabay.com/photo/2021/04/17/23/58/bunny-6187026_960_720.jpg',
        'https://cdn.pixabay.com/photo/2021/12/15/04/48/animal-6871771_960_720.jpg',
        'https://cdn.pixabay.com/photo/2020/03/29/11/21/cat-4980341_960_720.jpg',
        'https://cdn.pixabay.com/photo/2014/04/05/11/10/lop-eared-314881_960_720.jpg',
        'https://cdn.pixabay.com/photo/2014/04/02/20/51/cat-308244_960_720.jpg',
        'https://cdn.pixabay.com/photo/2018/03/24/21/52/fur-3257995_960_720.jpg',
        'https://cdn.pixabay.com/photo/2016/10/01/20/54/mouse-1708347_960_720.jpg',
        'https://cdn.pixabay.com/photo/2014/01/11/23/40/guinea-pig-242520_960_720.jpg',
        'https://cdn.pixabay.com/photo/2017/12/29/10/23/nature-3047194_960_720.jpg',
        'https://cdn.pixabay.com/photo/2016/10/26/22/00/hamster-1772742_960_720.jpg',
        'https://cdn.pixabay.com/photo/2016/11/21/12/32/happy-1845090_960_720.jpg',
        'https://cdn.pixabay.com/photo/2014/11/23/16/12/guinea-pig-542917_960_720.jpg',
        'https://cdn.pixabay.com/photo/2022/02/25/02/25/mouse-7033416_960_720.jpg',
        'https://cdn.pixabay.com/photo/2016/02/25/15/50/dog-1222364_960_720.jpg',
        'https://cdn.pixabay.com/photo/2015/12/13/20/25/beagle-1091670_960_720.jpg',
        'https://cdn.pixabay.com/photo/2020/02/13/08/11/happy-4844817_960_720.jpg',
        'https://cdn.pixabay.com/photo/2020/05/25/17/45/perro-5219693_960_720.jpg',
        'https://cdn.pixabay.com/photo/2020/12/09/16/56/dog-5817962_960_720.jpg',
        'https://cdn.pixabay.com/photo/2020/06/18/11/57/hund-5313212_960_720.jpg',
        'https://cdn.pixabay.com/photo/2020/05/27/18/30/frenchie-5228379_960_720.jpg',
        'https://cdn.pixabay.com/photo/2015/09/01/01/16/tuxedo-cat-916335_960_720.jpg',
        'https://cdn.pixabay.com/photo/2016/11/21/12/31/beach-1845081_960_720.jpg',
        'https://cdn.pixabay.com/photo/2020/03/04/17/31/tongue-4902262_960_720.jpg',
        'https://cdn.pixabay.com/photo/2019/07/24/13/58/dogue-de-bordeaux-4360233_960_720.jpg',
        'https://cdn.pixabay.com/photo/2020/06/23/18/11/cute-cat-5333325_960_720.jpg'
       ];


       // ! On veut créer une liste d'animaux
       $nbAnimal = 5000;

       for ($animalCount = 0; $animalCount < $nbAnimal; $animalCount++) {
           // ajout de l'animal
           $animal = new Animal();
           
           $animal->setName($faker->firstName());
           $animal->setSpecies($faker->randomElement($speciesObjects));
           $animal->setGender($faker->numberBetween(0, 1));
           $animal->setAge($faker->randomFloat(1, 1, 20));
           $animal->setPicture($faker->randomElement($imageAninmal));
           $animal->setChildCompatibility($faker->boolean());
           $animal->setOtherAnimalCompatibility($faker->boolean());
           $animal->setGardenNeeded($faker->boolean());
           $animal->setStatus($faker->randomFloat(1, 0, 4));
           $animal->setDescription($faker->realText(150));
           $animal->setAssociation($faker->randomElement($associationObjects));
           $animal->setDepartment($faker->randomElement($departmentObjects));

           $manager->persist($animal);
       }

        
        $manager->flush();
    }
}



