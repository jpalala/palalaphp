<?php
// src/Controller/PostController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Symfony\Component\HttpFoundation\Response;

class PostController extends AbstractController
{
    public function index(): Response
    {
        //get content
        return new Response(
            '<html><body>You have a simple have post/index!</body></html>'
        );
    }
    
    public function show($slug, string $projectDir): Response
    {
        //get content
        if(isset($slug)) {
            if(!($this->getParameter('app.contents_dir'))) {
                throw new NotFoundHttpException('The contents dir was not set!');
            }

            $contentsDir =  $projectDir . '/' . $this->getParameter('app.contents_dir');
            //>getParameter('app.contens_di')
            $file = $contentsDir . $slug . '.markdown';
            $markdown = file_get_contents($file);
            try {
                return $this->render('blog/show.html.twig',[ 'markdown' => $markdown]);
            }
            catch(Exception $e) {
                echo 'Message: ' . $e->getMessage();
            }

            
            
        } else {
            return new Response(
                '<html><body>You seem to have no have any slug!</body></html>'
            );
        }
    }

}
