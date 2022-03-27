<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\PostTranslation;
use App\Enum\PostLanguageEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PostFixture extends Fixture implements EventSubscriberInterface
{
    private ConsoleOutput $output;

    public static function getSubscribedEvents()
    {
        return [
            ConsoleEvents::COMMAND => 'init',
        ];
    }

    public function init(ConsoleCommandEvent $event): void
    {
        $this->output = $event->getOutput();
    }

    public function load(ObjectManager $manager): void
    {
        $progressBar = new ProgressBar($this->output, 100000);

        for ($i = 0; $i < 100000; $i++) {
            $post = new Post();

            $post->setEnabled((bool) rand(0, 1));
            $manager->persist($post);
            $manager->flush();

            $post->setTranslations($this->createTranslations($post));
            $manager->flush();

            $progressBar->advance();

            $manager->clear();
        }

        $progressBar->finish();
    }

    private function createTranslations(Post $post): ArrayCollection
    {
        $result = new ArrayCollection();

        foreach (PostLanguageEnum::cases() as $language) {
            $translation = new PostTranslation();

            $translation->setPost($post);
            $translation->setLanguage($language);
            $translation->setTitle($this->generateRandomString(20));
            $translation->setText($this->generateRandomString(100));

            $result->add($translation);
        }

        return $result;
    }

    private function generateRandomString(int $length): string
    {
        $characters = ' 0123456789 abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = mb_strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
