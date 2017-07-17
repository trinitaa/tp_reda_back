<?php


/**
 * This file is part of the TripblanDev package.
 *
 * (c) AUTO <https://github.com/trinitaa>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace AppBundle\Model;

use AppBundle\Entity\ArticleInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use AppBundle\Services\ArticleManagerInterface;

/**
 * Class ArticleManager
 * @package TB\Bundle\AppBundle\Model
 *
 * @author El amrani reda <rel.amrani.redaa@gmail.com>
 *
 */
abstract class ArticleManager implements ArticleManagerInterface
{
    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * Find Article by given $criteria
     * @param $criteria
     * @return mixed
     */
    public function findArticleBy($criteria)
    {
        if (filter_var($criteria, FILTER_VALIDATE_INT)) {
            return $this->findBy(array('id' => $criteria));
        }
        if (filter_var($criteria, FILTER_SANITIZE_STRING)) {
            return $this->findBy(array('slug' => $criteria));
        }

        return $this->findBy(array('id' => $criteria));
    }

    /**
     * Creates an empty Article instance
     * @param null $id
     * @return mixed
     */
    public function createArticle($id = null)
    {
        $class = $this->getClass();
        $article = new $class;
        if (null !== $id) {
            $article->setId($id);
        }

        return $article;
    }

    /**
     * Perform create new article
     *
     * @param ArticleInterface $article
     */
    public function saveArticle(ArticleInterface $article)
    {
        $this->doSaveArticle($article);
    }

    /**
     * Perform delete article
     *
     * @param ArticleInterface $article
     */
    public function deleteArticle(ArticleInterface $article)
    {
        $this->doRemoveArticle($article);
    }

    /**
     * Performs the persistence of the article.
     *
     * @abstract
     * @param ArticleInterface $article
     */
    abstract protected function doSaveArticle(ArticleInterface $article);

    /**
     * {@inheritDoc}
     */
    abstract protected function doRemoveArticle(ArticleInterface $article);

    /**
     * Performs find Article by criteria.
     * @param $criteria
     * @return mixed
     */
    abstract protected function findBy($criteria);
}
