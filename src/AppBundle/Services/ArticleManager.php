<?php

/**
 * This file is part of the TripblanDev package.
 *
 * (c) AUTO <https://github.com/trinitaa>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace AppBundle\Services;

use AppBundle\Entity\ArticleInterface;
use AppBundle\Entity\ArticleRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use AppBundle\Model\ArticleManager as BaseArticleManager;

/**
 * Default ORM NotificationManager.
 *
 * @author El amrani REda <el.amrani.redaa@gmail.com>
 */
class ArticleManager extends BaseArticleManager
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * @var string
     */
    protected $class;

    /**
     * Constructor.
     *
     * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $dispatcher
     * @param \Doctrine\ORM\EntityManager $em
     * @param string $class
     */
    public function __construct(
        EventDispatcherInterface $dispatcher,
        ArticleRepository $repository,
        EntityManager $em,
        $class
    ) {
        parent::__construct($dispatcher);

        $this->em = $em;
        $this->repository = $repository;

        $metadata = $em->getClassMetadata($class);
        $this->class = $metadata->name;
    }

    /**
     * {@inheritDoc}
     */
    public function findBy($criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * {@inheritDoc}
     */
    public function findAll()
    {
        return $this->repository->findAll();
    }

    /**
     * {@inheritDoc}
     */
    protected function doSaveArticle(ArticleInterface $article)
    {
        try {
            $this->em->persist($article);
            $this->em->flush();
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function doRemoveArticle(ArticleInterface $article)
    {
        try {
            $this->em->remove($article);
            $this->em->flush();
            return true;
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /** {@inheritDoc}
    */
    public function isNewArticle(ArticleInterface $article)
    {
        return !$this->em->getUnitOfWork()->isInIdentityMap($article);
    }

    /**
     * Returns the fully qualified trip class name
     *
     * @return string
     **/
    public function getClass()
    {
        return $this->class;
    }
}
