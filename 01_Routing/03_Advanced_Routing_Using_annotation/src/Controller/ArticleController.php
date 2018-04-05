<?php
// src/Controller/ArticleController.php
/* We indicate the namespace of the Bundle ********************************************************************/
    namespace App\Controller;
/* BASIC CONTROLLER COMPONENTS ********************************************************************************/
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;     // Allow Router
    use Symfony\Component\HttpFoundation\Response;                  // Allows you to execute Response
/**************************************************************************************************************/
class ArticleController {
    /**
     * Matches /articles/en/2010/my-post
     * Matches /articles/fr/2010/my-post.rss
     * Matches /articles/en/2013/my-latest-post.html
     * 
     * @Route(
     *     "/articles/{_locale}/{year}/{slug}.{_format}",
     *     defaults={"_format": "html"},
     *     requirements={
     *         "_locale": "en|fr",
     *         "_format": "html|rss",
     *         "year": "\d+"
     *     }
     * )
     */
    public function show($_locale, $year, $slug){
        $view_page = '<h1>News Daily Mirror !</h1>';
        foreach($section_array as $key=>$value){
            $view_page = $view_page.'<a href="/news/'.$value.'">'.$value.'</a><br>';
        }
        return new Response($view_page);
    }
}