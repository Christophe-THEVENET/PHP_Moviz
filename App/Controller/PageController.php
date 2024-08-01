<?php

namespace App\Controller;


class PageController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                match ($_GET['action']) {
                    //charger controleur home
                    'home' => $this->home(),
                    'movies' => $this->movies(),
                    default => throw new \Exception("Cette action n'existe pas : " . $_GET['action']),
                };
            } else {
                throw new \Exception("Aucune action détectée");
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function home()
    {

        $this->render('page/home', [
          
        ]);
    }

    protected function movies()
    {

        $this->render('page/movies', [
           
        ]);
    }
}
