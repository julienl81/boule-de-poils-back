<?php

namespace App\DataFixtures;

use App\Entity\Species;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        // prépartion des données

        // On veut créer une liste de 4 espèces et les stocker dans un tableau
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



        




        


        
        $manager->flush();
    }
}



// 01 - Ain - Bourg-en-bresse
// 02 - Aisne - Laon
// 03 - Allier - Moulins
// 04 - Alpes-de-Haute-Provence - Digne-les-bains
// 05 - Hautes-alpes - Gap
// 06 - Alpes-maritimes - Nice
// 07 - Ardèche - Privas
// 08 - Ardennes - Charleville-mézières
// 09 - Ariège - Foix
// 10 - Aube - Troyes
// 11 - Aude - Carcassonne
// 12 - Aveyron - Rodez
// 13 - Bouches-du-Rhône - Marseille
// 14 - Calvados - Caen
// 15 - Cantal - Aurillac
// 16 - Charente - Angoulême
// 17 - Charente-maritime - La rochelle
// 18 - Cher - Bourges
// 19 - Corrèze - Tulle
// 2A - Corse-du-sud - Ajaccio
// 2B - Haute-Corse - Bastia
// 21 - Côte-d'Or - Dijon
// 22 - Côtes-d'Armor - Saint-brieuc
// 23 - Creuse - Guéret
// 24 - Dordogne - Périgueux
// 25 - Doubs - Besançon
// 26 - Drôme - Valence
// 27 - Eure - Évreux
// 28 - Eure-et-loir - Chartres
// 29 - Finistère - Quimper
// 30 - Gard - Nîmes
// 31 - Haute-garonne - Toulouse
// 32 - Gers - Auch
// 33 - Gironde - Bordeaux
// 34 - Hérault - Montpellier
// 35 - Ille-et-vilaine - Rennes
// 36 - Indre - Châteauroux
// 37 - Indre-et-loire - Tours
// 38 - Isère - Grenoble
// 39 - Jura - Lons-le-saunier
// 40 - Landes - Mont-de-marsan
// 41 - Loir-et-cher - Blois
// 42 - Loire - Saint-étienne
// 43 - Haute-loire - Le puy-en-velay
// 44 - Loire-atlantique - Nantes
// 45 - Loiret - Orléans
// 46 - Lot - Cahors
// 47 - Lot-et-garonne - Agen
// 48 - Lozère - Mende
// 49 - Maine-et-loire - Angers
// 50 - Manche - Saint-lô
// 51 - Marne - Châlons-en-champagne
// 52 - Haute-marne - Chaumont
// 53 - Mayenne - Laval
// 54 - Meurthe-et-moselle - Nancy
// 55 - Meuse - Bar-le-duc
// 56 - Morbihan - Vannes
// 57 - Moselle - Metz
// 58 - Nièvre - Nevers
// 59 - Nord - Lille
// 60 - Oise - Beauvais
// 61 - Orne - Alençon
// 62 - Pas-de-calais - Arras
// 63 - Puy-de-dôme - Clermont-ferrand
// 64 - Pyrénées-atlantiques - Pau
// 65 - Hautes-Pyrénées - Tarbes
// 66 - Pyrénées-orientales - Perpignan
// 67 - Bas-rhin - Strasbourg
// 68 - Haut-rhin - Colmar
// 69 - Rhône - Lyon
// 70 - Haute-saône - Vesoul
// 71 - Saône-et-loire - Mâcon
// 72 - Sarthe - Le mans
// 73 - Savoie - Chambéry
// 74 - Haute-savoie - Annecy
// 75 - Paris - Paris
// 76 - Seine-maritime - Rouen
// 77 - Seine-et-marne - Melun
// 78 - Yvelines - Versailles
// 79 - Deux-sèvres - Niort
// 80 - Somme - Amiens
// 81 - Tarn - Albi
// 82 - Tarn-et-Garonne - Montauban
// 83 - Var - Toulon
// 84 - Vaucluse - Avignon
// 85 - Vendée - La roche-sur-yon
// 86 - Vienne - Poitiers
// 87 - Haute-vienne - Limoges
// 88 - Vosges - Épinal
// 89 - Yonne - Auxerre
// 90 - Territoire de belfort
// 91 - Essonne
// 92 - Hauts-de-seine
// 93 - Seine-Saint-Denis
// 94 - Val-de-marne
// 95 - Val-d'Oise
// 971 - Guadeloupe
// 972 - Martinique
// 973 - Guyane
// 974 - La réunion
// 976 - Mayotte