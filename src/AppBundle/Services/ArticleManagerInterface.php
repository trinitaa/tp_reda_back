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

/**
 * Interface TripManagerInterface
 *
 * @package TB\Bundle\PlatformBundle\Services
 * @author  El amrani reda <el.amrani.redaa@gmail.com>
 * @license MIT
 * @link    <https://github.com/trinitaa>
 */
interface ArticleManagerInterface
{

    /**
     * Find article by given criteria
     *
     * @param  $criteria
     * @return mixed
     */
    public function findArticleBy($criteria);

    /**
     * Find All articles
     *
     * @return  mixed
     */
    public function findAll();

    /**
     * Create article from the submitted data
     *
     * @param  null $id
     * @return mixed
     */
    public function createArticle($id = null);

    /**
     * Remove a article
     *
     * @param  ArticleInterface $article
     * @return mixed
     */
    public function deleteArticle(ArticleInterface $article);
    /**
     * Returns the article fully qualified class name
     *
     * @return string
     */
    public function getClass();
}
