<?php
/**
 * This file is part of the TripblanDev package.
 *
 * (c) AUTO <https://github.com/trinitaa>
 * @author "reela"
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace AppBundle\Controller;

use AppBundle\Form\Type\ArticleType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class ArticleRestController
 * @package AppBundle\Controller
 */
class ArticleRestController extends FOSRestController
{
    /**
     * Get Article by unique ID
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getArticleAction($slug)
    {
        $manager = $this->get('article.manager');
        $article = $manager->findArticleBy($slug);
        if (null === $article) {
            return $this->handleView($this->onHandleError());
        }

        return $this->handleView($this->onHandleSuccess($article));
    }

    /**
     * Get All Articles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getArticlesAction()
    {
        $manager = $this->get('article.manager');
        $articles = $manager->findAll();


        return $this->handleView($this->onHandleSuccess($articles));
    }

    /**
     * Creates a new Article from the submitted data
     * @param Request $request
     * @return mixed
     */
    public function postArticlesAction(Request $request)
    {
        $manager = $this->get('article.manager');
        $article = $manager->createArticle();
        $form = $this->createForm(new ArticleType(), $article);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $manager->saveArticle($article);
            return $this->handleView($this->onHandleCreateSuccess($article));
        }

        return $this->handleView($this->onHandleFormError($form));
    }

    /**
     * DELETE Article.
     * @Rest\View(statusCode=204)
     * @return array
     */
    public function deleteArticlesAction($id)
    {
        $manager = $this->get('article.manager');
        $article = $manager->findArticleBy($id);
        if (null === $article) {
            return $this->handleView($this->onHandleError());
        }
        $manager = $this->get('article.manager');
        $manager->deleteArticle($article);
    }

    /**
     * Forwards the action to the article view on a successful form submission.
     * @param  $data
     * @return View
     */
    protected function onHandleSuccess($data)
    {
        $view = View::create()
            ->setStatusCode(Codes::HTTP_OK)
            ->setData($data);

        return $view;
    }

    /**
     * Forwards the action to the article view on a successful form submission.
     * @param  $data
     * @return View
     */
    protected function onHandleCreateSuccess($data)
    {
        $view = View::create()
            ->setStatusCode(Codes::HTTP_CREATED)
            ->setData($data);

        return $view;
    }

    /**
     * @return View
     */
    protected function onHandleError()
    {
        $view = $this->view(
            array(
                'message' => "Article Not Found",
            ),
            Codes::HTTP_NOT_FOUND
        );

        return $view;
    }
    /**
     * Returns a HTTP_BAD_REQUEST response when the form submission fails.
     *
     * @param FormInterface $form
     *
     * @return View
     */
    protected function onHandleFormError(FormInterface $form)
    {
        $view = View::create()
            ->setStatusCode(Codes::HTTP_BAD_REQUEST)
            ->setData(
                array(
                    'code' => Codes::HTTP_BAD_REQUEST,
                    'errors' => $form->getErrors(true),
                )
            );
        return $view;
    }
}
