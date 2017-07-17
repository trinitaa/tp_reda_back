<?php

/**
 * This file is part of the TripblanDev package.
 *
 * (c) AUTO <https://github.com/trinitaa>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace AppBundle\Entity;

/**
 * Class ArticleInterface
 * @package AppBundle\Entity\Model
 *
 * @author El amrani reda <el.amrani.redaa@gmail.com>
 *
 */
interface ArticleInterface
{
    /**
     * Set Id
     *
     * @param $id
     * @return $this
     */
    public function setId($id);
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title);

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set leadding
     *
     * @param string $leadding
     * @return Article
     */
    public function setLeadding($leadding);

    /**
     * Get leadding
     *
     * @return string
     */
    public function getLeadding();

    /**
     * Set body
     *
     * @param string $body
     * @return Article
     */
    public function setBody($body);

    /**
     * Get body
     *
     * @return string
     */
    public function getBody();

    /**
     * Set createdBy
     *
     * @param string $createdBy
     * @return Article
     */
    public function setCreatedBy($createdBy);

    /**
     * Get createdBy
     *
     * @return string
     */
    public function getCreatedBy();

    /**
     * Set slug
     *
     * @param string $slug
     * @return Article
     */
    public function setSlug($slug);

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug();

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Article
     */
    public function setCreatedAt($createdAt);

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Article
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt();
}
