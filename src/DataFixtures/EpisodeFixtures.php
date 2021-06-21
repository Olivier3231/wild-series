<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
   
    const EPISODES = [
        ['title' => 'Days Gone Bye','number' => '1', 'synopsis' => "Deputy Sheriff Rick Grimes awakens from a coma, and searches for his family in a world ravaged by the undead."],
        ['title' => 'Guts','number' => '2', 'synopsis' => 'In Atlanta, Rick is rescued by a group of survivors, but they soon find themselves trapped inside a department store surrounded by walkers.'],
        ['title' => 'What lies ahead','number' => '4', 'synopsis' => "The group's plan to head for Fort Benning is put on hold when Sophia goes missing."],
        ['title' => 'Celui qui a une nouvelle fiancée','number' => '1', "Rachel revient de l'aéroport avec Ross et Julie et tente de cacher sa tristesse. Monica demande à Phoebe de lui couper les cheveux après avoir vu le résultat chez Chandler et Joey. Mais la coupe de Monica se révèle désastreuse, Phoebe ayant confondu la coupe de Demi Moore avec celle de Dudley Moore. Chandler doit se faire faire un costume et Joey lui indique l'adresse de son tailleur. Malheureusement pour Chandler, le tailleur de Joey a les mains baladeuses."],
        ['title' => 'Celui qui détestait le lait maternel','number' => '2', 'synopsis' => "Joey a un nouveau travail, il est chargé de vaporiser de parfum les clients d'un grand magasin mais il trouve un sérieux concurrent sur son territoire. Monica passe du temps avec Julie tout en le cachant à Rachel. Lorsque cette dernière l'apprend, elle est furieuse après son amie, se sentant trahie. Ross n'aime pas le lait maternel et est horrifié lorsque Phoebe et Joey le goûtent."],
        ['title' => "Celui qui est mort dans l'appart du dessous",'number' => '3', 'synopsis' => "M. Heckles, l'excentrique voisin du dessous des filles meurt. Il leur lègue néanmoins toutes ses affaires. Chandler croit se reconnaître en M. Heckles et décide de ne pas finir seul. En effet, il a quelques sérieux problèmes avec ses conquêtes : pour lui, elles ont toutes d'énormes défauts. Ross et Phoebe, de leur côté, se disputent au sujet de la théorie de l'évolution. Phoebe affirme ne pas croire à cette théorie, tandis que Ross, le scientifique, se démène à l'aide de poupées puis de fossiles, pour lui démontrer qu'elle a tort."],
        ['title' => 'Celui qui avait viré de bord','number' => '4', 'synopsis' => "Duncan arrive chez les filles et apprend à Rachel qu'il est le mari de Phoebe. En fait, c'est un patineur homosexuel canadien avec qui Phoebe a fait un mariage blanc. Mais aujourd'hui, il souhaite divorcer pour épouser une femme. Phoebe lui fait comprendre qu'il aurait dû se découvrir avant. Le secret du troisième téton de Chandler est dévoilé. Les secrets des uns et des autres jaillissent et entre autres, on apprend que la petite culotte sur le poteau dans la rue est celle de Monica ou encore que Joey a tourné dans un film érotique. Ross a très envie de faire l'amour avec Julie et demande conseil à Rachel qui lui conseille de retarder encore ce moment."],
        ['title' => 'Le monde à l’envers','number' => '8', 'synopsis' => "Hopper et Joyce sont aux mains du Dr Brenner. Les garçons attendent avec Onze dans le gymnase. Nancy et Jonathan s'arment pour livrer bataille."],
        ['title' => 'Le bain','number' => '7', 'synopsis' => "Onze n'arrive pas à entrer en contact avec Will. Lucas donne l'alerte sur un danger imminent. Nancy et Jonathan montrent à la police les clichés pris par Jonathan."],
        ['title' => 'Le monstre','number' => '6', 'synopsis' => "Paniqué, Jonathan cherche Nancy dans le noir. Steve est lui aussi sur ses traces. Hopper et Joyce découvrent la vérité sur les activités secrètes du laboratoire."],
        ['title' => "La puce et l’acrobate", 'number' => '5', 'synopsis' => "Hopper s'introduit dans le labo, Nancy et Jonathan affrontent la force qui a enlevé Will, et les garçons demandent à M. Clarke comment se rendre dans une autre dimension."],
        ['title' => 'Le corps','number' => '4', 'synopsis' => "Refusant de croire que Will est mort, Joyce essaye d'entrer en contact avec son fils. Onze subit une transformation. Nancy et Jonathan décident d'unir leurs forces."],
        ['title' => 'Petit papa Noël','number' => '3', 'synopsis' => "Plus inquiète que jamais, Nancy se met à la recherche de Barbara et découvre à cette occasion ce que tramait Jonathan. Joyce est persuadée que Will essaie de lui parler."],
        ['title' => 'La barjot de Maple Street','number' => '2', 'synopsis' => "Lucas, Mike et Dustin tentent de communiquer avec la fille qu'ils ont découverte dans les bois. Hopper interroge Joyce à propos d'un étrange appel téléphonique."],
        ['title' => 'La disparition de Will Byers','number' => '1', 'synopsis' => "Tandis qu'il rentre chez lui, le jeune Will est témoin d'une scène terrifiante. Non loin de là, un sinistre secret hante les sous-sols d'un laboratoire du gouvernement."],
        ['title' => "L'hiver vient",'number' => '1', 'synopsis' => "Sur le continent de Westeros, un jeune patrouilleur de la Garde de Nuit, chargée de veiller sur le Mur, est condamné à mort pour désertion par Eddard Stark, seigneur de Winterfell et Gardien du Nord. Mais de sombres nouvelles arrivent de Port-Réal, la capitale des Sept Couronnes : Jon Arryn, ami intime d'Eddard et Main du roi Robert Baratheon, vient de mourir."],
        ['title' => 'La route royale','number' => '2', 'synopsis' => "Daenerys Targaryen, fraîchement mariée au Khal Drogo, entreprend avec les Dothrakis et son frère le long voyage vers Vaes Dothrak. À Winterfell, alors que Bran est toujours dans le coma suite à sa chute, Ned prépare son départ pour Port-Réal. Catelyn, dévastée par l'état de Bran, ne prend pas part aux adieux à sa famille : Arya et Sansa accompagnent leur père, Jon part vers le nord, sur le Mur, accompagné de son oncle Benjen et de Tyrion Lannister."],
        ['title' => 'Lord Snow','number' => '3', 'synopsis' => "À peine arrivé à Port-Réal, Eddard Stark est convoqué à une session du Conseil Restreint et découvre alors que le Royaume est fortement endetté et doit beaucoup d'argent aux Lannister. À Winterfell, Bran, conscient depuis peu, essaie d'accepter son amnésie et son handicap ; pendant que sur le Mur, Jon Snow fait face à sa difficile condition de bâtard parmi ses futurs frères de la Garde de Nuit."],
        
    ];
    public function load(ObjectManager $manager)
    {

        foreach (self::EPISODES as $row => $value) {
            $episode = new Episode();
            $episode->setTitle($value['title']);
            $episode->setNumber($value['number']);
            $episode->setSynopsis($value['synopsis']);
            $episode->setSeason($this->getReference('season_0'));
            $manager->persist($episode);

        }
        $manager->flush();
    }

    public function getDependencies()

    {

        return [

            SeasonFixtures::class,


        ];
    }
}
