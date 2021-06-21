<?php

namespace App\DataFixtures;
use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    public const ACTORS = [
        ['name' => 'Norman Reedus'],
        ['name' =>'Andrew Lincoln'],
        ['name' =>'Lauren Cohan'],
        ['name' =>'Jeffrey Dean Morgan'],
        ['name' =>'Danai Gurira'],
        ['name' =>'Chandler Riggs'],
        ['name' =>'Úrsula Corberó'],
        ['name' =>'Winona Ryder'],
        ['name' =>'David Harbour'],
        ['name' =>'Finn Wolfhard'],
        ['name' =>'Millie Bobby Brown'],
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::ACTORS as $key => $value) {
            $actor = new Actor();
            $actor->setName($value['name']);
            $manager->persist($actor);
            $this->addReference('actor_' . $key, $actor);
        }
        $manager->flush();
    }
}
