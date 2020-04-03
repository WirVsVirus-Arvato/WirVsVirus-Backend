<?php

namespace App\Controller;

use App\Entity\User;
use LasseRafn\InitialAvatarGenerator\InitialAvatar;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @Security("is_granted('ROLE_USER')")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'menu_active' => 'dashboard',
            'corona_tracker_de' => $this->getLatestCoronaData("de"),
            'corona_tracker_ww' => $this->getLatestCoronaData()
        ]);
    }

    /**
     * @Route("/profile/{id}/avatar", name="profile_avatar")
     * @Security("is_granted('ROLE_USER')")
     */
    public function profileAvatar($id)
    {
        /* @var $user \App\Entity\User */
        $user = $this->getDoctrine()->getRepository(User::class)->findOneById($id);
        if (!$user) {
            return new Response("Not found", 404);
        }

        $avatar = new InitialAvatar();
        $text = $user->getFirstname() . " " . $user->getLastname();
        if (trim($text) == "") {
            $image = $avatar->name("?")->width(250)->height(250)->generate();
        } else {
            $image = $avatar->name($user->getFirstname() . " " . $user->getLastname())->width(250)->height(250)->generate();
        }

        return new Response($image->encode("png"), 200, ['Content-Type' => 'image/png']);

    }

    private function getLatestCoronaData($country = null)
    {
        #return false;
        if($country == null) {
            $url = "https://coronavirus-tracker-api.herokuapp.com/v2/latest";
            $obj = json_decode(file_get_contents($url), true);

            $obj["latest"]["last_updated"] = new \DateTime("now");
            return $obj["latest"];

        } else {
            $url = "https://coronavirus-tracker-api.herokuapp.com/v2/locations?country_code=" . $country;
            $obj = json_decode(file_get_contents($url), true);

            if(count($obj["locations"]) == 0) return false;
            $obj["locations"][0]["latest"]["last_updated"] = new \DateTime($obj["locations"][0]["last_updated"]);
            return $obj["locations"][0]["latest"];
        }
    }


}
