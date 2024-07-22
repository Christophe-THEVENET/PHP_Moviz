<?php

namespace App\Controller;

class Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['controller'])) {
                match ($_GET['controller']) {
                    //charger controleur page (acceuil par défaut)
                    'page' => [
                        $controller = new PageController(),
                        $controller->route(),
                    ],
                    'user' => [
                        $controller = new UserController(),
                        $controller->route(),
                    ],
                    'auth' => [
                        $controller = new AuthController(),
                        $controller->route(),

                    ],
                    'admin' => [
                        $controller = new AdminController(),
                        $controller->route(),
 
                    ],
                    // voir le détail d'un film
                    'movie' => [
                        $controller = new MovieController(),
                        $controller->route(),

                    ],
                    default =>  throw new \Exception("Le controleur n'existe pas"),
                };
            } else {
                //Chargement la page d'accueil si pas de controleur dans l'url
                $controller = new PageController();
                $controller->home();
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function render(string $path, array $params = []): void
    {
        $filePath = _ROOTPATH_ . '/templates/' . $path . '.php';

        try {
            if (!file_exists($filePath)) {
                throw new \Exception("Fichier non trouvé : " . $filePath);
            } else {
                // Extrait chaque ligne du tableau et crée des variables pour chacune
                extract($params);
                require_once $filePath;
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }
  
}
