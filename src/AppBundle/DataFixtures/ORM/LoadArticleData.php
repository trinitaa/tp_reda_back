<?php
/**
 * This file is part of the TripblanDev package.
 *
 * (c) AUTO <https://github.com/trinitaa>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Article;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadUserData
 * @package AppBundle\DataFixtures\ORM
 */
class LoadUserData implements FixtureInterface
{
    /**
     * @param ObjectManager $manager
     * Load fixtures data
     */
    public function load(ObjectManager $manager)
    {
        $articles = array(
            array('title' => 'Article 1', 'leadding' => 'Leading1', 'body'=> 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de limprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte', 'createdBy'=>'Reda'),
            array('title' => 'Article 2', 'leadding' => 'Leading2', 'body'=> 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de limprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte.', 'createdBy'=>'Reda'),
            array('title' => 'Article 3', 'leadding' => 'Leading3', 'body'=> 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de limprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte.', 'createdBy'=>'Reda')
        );
        foreach ($articles as $item) {
            $article = new Article();
            $article->setTitle($item['title']);
            $article->setLeadding($item['leadding']);
            $article->setBody($item['body']);
            $article->setCreatedBy($item['createdBy']);
            $manager->persist($article);
        }

        $manager->flush();
    }
}
