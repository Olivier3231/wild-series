<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        ['title' => 'Walking Dead', 'synopsis' => 'Le policier Rick Grimes se réveille après un long coma. Il découvre avec effarement que le monde, ravagé par une épidémie, est envahi par les morts-vivants.',
         'poster' => 'https://m.media-amazon.com/images/M/MV5BZmFlMTA0MmUtNWVmOC00ZmE1LWFmMDYtZTJhYjJhNGVjYTU5XkEyXkFqcGdeQXVyMTAzMDM4MjM0._V1_.jpg', 'year' => '2013', 'country' => 'USA'],
        ['title' => 'Stranger Things', 'synopsis' => 'Quand un jeune garçon disparaît, une petite ville découvre une affaire mystérieuse, des expériences secrètes, des forces surnaturelles terrifiantes... et une fillette.',
         'poster' => 'https://imgr.cineserie.com/2017/02/1829872.jpg?imgeng=/f_jpg/cmpr_0/w_212/h_318/m_cropbox&ver=1', 'year' => '2016', 'country' => 'USA'],
        ['title' => 'Game of Thrones', 'synopsis' => 'Nine noble families fight for control over the lands of Westeros, while an ancient enemy returns after being dormant for millennia.',
         'poster' => 'https://m.media-amazon.com/images/I/81yQazv3qyL._AC_UL320_.jpg', 'year' => '2011', 'country' => 'USA'],
        ['title' => 'Friends', 'synopsis' => 'Follows the personal and professional lives of six twenty to thirty-something-year-old friends living in Manhattan.',
         'poster' => 'https://images-na.ssl-images-amazon.com/images/I/51v%2BTk2Mp9S._AC_SX679_.jpg', 'year' => '1994', 'country' => 'USA'],
        ['title' => 'La casa De Papel', 'synopsis' => "Huit voleurs font une prise d'otages dans la Maison royale de la Monnaie d'Espagne, tandis qu'un génie du crime manipule la police pour mettre son plan à exécution.",
         'poster' => 'https://imgr.cineserie.com/2017/04/1481703.jpg?imgeng=/f_jpg/cmpr_0/w_212/h_318/m_cropbox&ver=1', 'year' => '2017', 'country' => 'Espagne'],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $row => $value) {

            $program = new Program();
            $program->setTitle($value['title']);
            $program->setSynopsis($value['synopsis']);
            $program->setPoster($value['poster']);
            $program->setYear($value['year']);
            $program->setCountry($value['country']);
            $program->setCategory($this->getReference('category_0'));
            
            $this->addReference('program_' . $row, $program);
        
            for ($i=0; $i < count(ActorFixtures::ACTORS); $i++) {
                $program->addActor($this->getReference('actor_' . $i));
            }
        
        }    
        $manager->persist($program);

        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          ActorFixtures::class,
          CategoryFixtures::class,
        ];
    }
}
