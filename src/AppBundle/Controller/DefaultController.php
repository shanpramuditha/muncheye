<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;
use Goutte\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $url = "http://muncheye.com/";
        $em = $this->getDoctrine()->getManager();
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $links = $crawler->filter('div#right-column > div.item > div.item_info > a')->links();
        $newProducts = 0;
        $updatedProducts = 0;
        $newProd = array();
        $updatedProd = array();

        foreach ($links as $link) {
            $new = false;
            $updated = false;
            $currentLink = ($link->getUri());
            $crawler = $client->request('GET', $currentLink);
            $tr = $crawler->filter('div.product_info > table > tr')->each(function ($tr, $i) {
                return $tr->filter('td')->each(function ($td, $i) {
                    return trim($td->text());
                });
            });
            $product = $em->getRepository('AppBundle:Product')->findOneBy(array('link'=>$link->getUri()));

            if($product == null){
                $new = true;
                $product = new Product();
                $product->setDatetime(new \DateTime('now'));
                $product->setUpdatedAt(new \DateTime('now'));
                $product->setStatus('default');
                $newProducts++;
            }else{
                if($product->getJvPage() != $tr[6][1]){
                    $updated = true;
                    $product->setUpdatedAt(new \DateTime('now'));
                    $updatedProducts++;
                }

            }
            $product->setProductUpdatedAt(new \DateTime('now'));
            $product->setVendor($tr[0][1]);
            $product->setProduct($tr[1][1]);
            $product->setLaunchDate(new \DateTime(date('Y-m-d H:i:s',strtotime($tr[2][1]))));
            $product->setLaunchTime($tr[3][1]);
            $product->setFrontEndPrice($tr[4][1]);
            $product->setCommision($tr[5][1]);
            $product->setJvPage($tr[6][1]);
            $product->setAffiliateNetwork($tr[7][1]);
            $product->setNiche($tr[8][1]);
            $product->setLink($link->getUri());
            $em->persist($product);

            if($new){
                $newProd[] = $product;
            }else if ($updated){
                $updatedProd[] = $product;
            }

//            exit;

//            $all_links[] = $link->getURI();

        }

        $data = '';
        $data.='<h2>New Products</h2><table><thead><th>url</th><th>Added Date</th><th>Updated Date</th></thead><tbody>';
        foreach ($newProd as $prod){
            $data.='<tr><td><a target="_blank" href="'.$prod->getLink().'">'.$prod->getLink().'</a></td><td>'.$prod->getDatetime()->format('Y-m-d H:i:s').'</td><td>'.$prod->getUpdatedAt()->format('Y-m-d H:i:s').'</td></tr>';
        }
        $data.='</tbody></table>';

        $data.='<h2>Updated Products</h2><table><thead><th>url</th><th>Added Date</th><th>Updated Date</th></thead><tbody>';
        foreach ($updatedProd as $prod){
            $data.='<tr><td><a target="_blank" href="'.$prod->getLink().'">'.$prod->getLink().'</a></td><td>'.$prod->getDatetime()->format('Y-m-d H:i:s').'</td><td>'.$prod->getUpdatedAt()->format('Y-m-d H:i:s').'</td></tr>';
        }
        $data.='</tbody></table>';




        $em->flush();

        return new Response('<h1>New Products :'.$newProducts.'</h1><h1>Updated Products :'.$updatedProducts.'</h1>'.$data);

    }

    /**
     * @Route("/product" , name="products_list")
     */
    public function productListAction(Request $request){
        $title = $request->get('title');
        $addedDateFrom = $request->get('addedDateFrom');
        $addedDateTo = $request->get('addedDateTo');
        $updatedDateFrom = $request->get('updatedDateFrom');
        $updatedDateTo = $request->get('updatedDateTo');
        $launchDateFrom = $request->get('launchDateFrom');
        $launchDateTo = $request->get('launchDateTo');
//        var_dump($launchDateFrom);
//        var_dump($launchDateTo);
        $status = $request->get('status');
        $em = $this->getDoctrine()->getManager();
        if($title != null or $title == ''){
            $products = $em->getRepository('AppBundle:Product')->search($title,$addedDateFrom,$addedDateTo,$updatedDateFrom,$updatedDateTo,$launchDateFrom,$launchDateTo,$status);

        }else{
            $products = $em->getRepository('AppBundle:Product')->findAll();
        }

        return $this->render('default/index.html.twig',array(
            'products'=>$products,
            'title'=>$title,
            'addedDateFrom'=>$addedDateFrom,
            'addedDateTo'=>$addedDateTo,
            'updatedDateFrom'=>$updatedDateFrom,
            'updatedDateTo'=>$updatedDateTo,
            'launchDateFrom'=>$launchDateFrom,
            'launchDateTo'=>$launchDateTo,
            'status'=>$status
        ));
    }

    /**
     * @Route("/product/edit/{id}", name="product_edit")
     */
    public function productEditAction(Request $request,$id){
        $product = $this->getDoctrine()->getRepository('AppBundle:Product')->find($id);
        $form = $this->createForm(ProductType::class,$product);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        if($form->isSubmitted() and $form->isValid()){
//            $product->setUpdatedAt(new \DateTime('now'));
            $em->flush($product);
            return $this->redirectToRoute('products_list');
        }

        return $this->render('default/product_edit.html.twig',array(
           'product'=>$product,
            'form'=>$form->createView()
        ));
    }

    /**
     * @Route("/product/view/{id}", name="product_view")
     */
    public function productViewAction(Request $request,$id){
        $product = $this->getDoctrine()->getRepository('AppBundle:Product')->find($id);

        return $this->render(':default:product_view.html.twig',array(
           'product'=>$product
        ));
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request){
        $auth_checker = $this->get('security.authorization_checker');


        $token = $this->get('security.token_storage')->getToken();

        $user = $token->getUser();


        $isRoleAdmin = $auth_checker->isGranted('ROLE_ADMIN');
        if ($isRoleAdmin) {
            return $this->redirect(
                $this->generateUrl("products_list")
            );
        }


        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUserName();
        return $this->render('default/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error
        ));
    }

    /**
     * @Route("/product/change-status", name="changeStatus")
     */

    public function productChangeStatusAction(Request $request){
        $id = $request->get('id');
        $value = $request->get('status');

        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->find($id);
        $product->setStatus($value);
        $em->persist($product);
        $em->flush();
        return new Response("status Changed");
    }
}
