<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\LivreRepository;
class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(SessionInterface $session ,LivreRepository $livreRepository)
    {
        $panier = $session->get('panier',[]);

        $panierWithData = [];

        foreach ($panier as $id => $nbExemplaires){
            $panierWithData[] = [
                'livre' => $livreRepository->find($id),
                'nbExemplaires' => $nbExemplaires
            ];
        }
        $total = 0;

        foreach ($panierWithData as $item) {
            $totalItem = $item['livre']->getPrix() * $item['nbExemplaires'];
            $total +=$totalItem;
        }


        return $this->render('cart/index.html.twig', [
            'items' => $panierWithData,
            'total' => $total
        ]);
    }
     /**
     * @Route("/cart/add/{id}", name="cart_add")
     */
    public function add($id , SessionInterface $session ){

        $panier = $session->get('panier',[]);

        if(!empty($panier[$id])){
        $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }


        $session->set('panier',$panier);

        return $this->redirectToRoute("cart");

    }

    /**
     * @Route ("/cart/remove/{id}", name="cart_remove")
     */
    public function remove($id, SessionInterface $session){
        $panier = $session->get('panier',[]);

        if(!empty($panier[$id])) {
            unset($panier[$id]);
        }
        $session->set('panier',$panier);

        return $this->redirectToRoute("cart");

    }
}
