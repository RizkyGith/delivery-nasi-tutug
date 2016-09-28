<?php

namespace App\Provider;

class AppProvider extends \Bono\Provider\Provider
{
    // public function initialize()
    // {
    //     $app = $this->app;

    //     // do something here

    //     //* upload file
    //     $app->get('/upload_file', function () use ($app) {
    //      $this->uploadFile($app);

    //     });

    //     $app->post('/upload_file', function () use ($app) {
    //      $this->uploadFile($app);

    //     });
    // }

    public function initialize()
    {

      $app = $this->app;
      
        $app->filter('auth.authorize', function ($options) use ($app) {
            if (is_array($options) && isset($options['uri'])) {
                $uri = $options['uri'];
                // var_dump($uri); exit();
            } else {
                $uri = $options;
            }

            switch($uri) {
                case '/test':
                case '/home':
                case '/static':
                    return true;
            }

            return $options;
        }, 0);
        
        $app->get('/', function () use ($app) { 
            $app->redirect('/home');       
        });

        $app->get('/home', function () use ($app) { 
            $app->response->template('home/index'); 
        });

        $app->get('/static', function () use ($app) { 
            $app->response->template('static/index'); 
        });

        $app->filter('auth.authorize', function ($options) {
          if (is_bool($options)) {
            return $options;
          }

          if (empty($_SESSION['user']['level'])) {
            if (strpos($options['uri'], '/profil') === 0) {
              return true;
            } else {
              return $options;
            }
          }
          // something to do
          return $options;
        });

        $app->filter('auth.authorize', function ($options) {
          if (is_bool($options)) {
            return $options;
          }

          if (empty($_SESSION['user']['level'])) {
            if (strpos($options['uri'], '/caraPembelian') === 0) {
              return true;
            } else {
              return $options;
            }
          }
          // something to do
          return $options;
        });

        $app->filter('auth.authorize', function ($options) {
          if (is_bool($options)) {
            return $options;
          }

          if (empty($_SESSION['user']['level'])) {
            if (strpos($options['uri'], '/hubungi') === 0) {
              return true;
            } else {
              return $options;
            }
          }
          // something to do
          return $options;
        });

        $app->filter('auth.authorize', function ($options) {
          if (is_bool($options)) {
            return $options;
          }

          if (empty($_SESSION['user']['level'])) {
            if (strpos($options['uri'], '/riwayat') === 0) {
              return true;
            } else {
              return $options;
            }
          }
          // something to do
          return $options;
        });

        $app->filter('auth.authorize', function ($options) {
          if (is_bool($options)) {
            return $options;
          }

          if (empty($_SESSION['user']['level'])) {
            if (strpos($options['uri'], '/user') === 0) {
              return true;
            } else {
              return $options;
            }
          }
          // something to do
          return $options;
        });

        $app->filter('auth.authorize', function ($options) {
          if (is_bool($options)) {
            return $options;
          }

          if (empty($_SESSION['user']['level'])) {
            if (strpos($options['uri'], '/menuMakanan') === 0) {
              return true;
            } else {
              return $options;
            }
          }
          // something to do
          return $options;
        });

        //* upload file
         $app->get('/upload_file', function () use ($app) {
         $this->uploadFile($app);

        });

        $app->post('/upload_file', function () use ($app) {
         $this->uploadFile($app);

        });
    }

    private function uploadFile($app){

      $base_dir  = $this->options['Upload_Directory'];
      $path = $base_dir . '/';
      

      if (!file_exists($path)) {
          mkdir($path, 0766, true);
      }

      $uploaded = '';
      foreach ($_FILES['files']['name'] as $k => $filename) {
       $tmp_file = $_FILES['files']['tmp_name'][$k];

          $upload = move_uploaded_file($tmp_file, $path.$filename);

          $uploaded = $filename;
      }

      echo json_encode($uploaded);
      exit();

    }
}
