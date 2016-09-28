<?php

namespace App\Provider;

use \Norm\Filter\Filter;
use App\Provider\URL;
use App\Notification\Notification;
use App\Controller\AppController;


class AppProvider extends \Bono\Provider\Provider
{
    public function initialize()
    {
        $app = $this->app;
        $this->enableCors();

        $client = \Norm::factory('Client')->findOne();
        // $app->response->data('client', $client);
        $_SESSION['client'] =$client;

        // do something here
         $app->hook('controller.create.success', function () use ($app) {

            $app->redirect(f('controller.url'));
        });

        $app->hook('controller.update.success', function () use ($app) {
            $app->redirect(f('controller.uri'));
        });

        $app->get('/', function () use ($app) {
            
            $data = $this->dashboardSchedule();
            $app->response->data('schedule', $data);
            $data = $this->dashboardSurvey();
            $app->response->data('survey',$data);
            $app->response->template('static/index');
        });



        $app->get('/upload_file', function () use ($app) {
                $this->uploadFile($app);

        });


        $app->get('/upload_file', function () use ($app) {
         $this->uploadFile($app);

        });

        $app->post('/upload_file', function () use ($app) {
         $this->uploadFile($app);

        });

        $app->get('/upload_mobile_file', function () use ($app) {
         $this->uploadMobileFile($app);

        });

        $app->post('/upload_mobile_file', function () use ($app) {
         $this->uploadMobileFile($app);

        });


        $app->post('/upload_binary_file', function () use ($app) {
          $app->response->data(array('filename'=> $this->uploadBinaryFile($app)));

        });


    }

     protected function enableCors()
    {
        if (!isset($_SERVER['REQUEST_METHOD'])) {
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']) && (
                $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'GET' ||
                $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'POST' ||
                $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'DELETE' ||
                $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'PUT' )) {
                header('Access-Control-Allow-Origin: *');
                header("Access-Control-Allow-Credentials: true");
                header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Authorization');
                header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
                header('Access-Control-Max-Age: 86400');
            }
            exit;
        } else {
                header('Access-Control-Allow-Origin: *');
                header("Access-Control-Allow-Credentials: true");
                header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Authorization');
                header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
                header('Access-Control-Max-Age: 86400');

        }
    }

    private function uploadFile($app)
    {
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

    private function uploadMobileFile($app)
    {
        $base_dir  = $this->options['Upload_Directory'];
        $path = $base_dir . '/content/survey/';


        if (!file_exists($path)) {
          mkdir($path, 0766, true);
        }

        $uploaded = '';


      $tmp_file = $_FILES['files']['tmp_name'];
      $filename = $_FILES['files']['name'];
      $upload = move_uploaded_file($tmp_file, $path.$filename);

      $uploaded = $filename;

      $app->response->data(array('filename' => $upload));

    }


    private function uploadBinaryFile($app){

        $body = $app->request->getBody();
        $base64 = $body['content_image'];
        $base_dir  = $this->options['Upload_Directory'];
        $path = $base_dir . '/content/survey/';
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));
        $name = md5(uniqid(rand(), true)) . '.jpg';

        file_put_contents($path . $name, $data);

        return $name;
    }



    public function dashboardSchedule(){
        $monthstart = date('n')-3;
        $monthend =  date('n');
        $status = array('2'=>'Active','3'=>'Submitted','5'=>'Overdue');

        $query = 'select month(date_schedule) as month,5 as status,count(1) as value from schedule where status != 1 and ((status=2 and date_schedule < now()) or (status = 3 and date_schedule < date(_updated_time))) and month(date_schedule)  >= '.$monthstart.' and month(date_schedule) <= '.$monthend.' group by month(date_schedule)
                union select month(date_schedule) as month,status,count(1) as value from schedule where status != 1 and month(date_schedule)  >= '.$monthstart.' and month(date_schedule) <= '.$monthend.' group by status,month(date_schedule)';

        $data = $this->generateData($query);

        foreach ($data as $key => $value) {
            $value['month'] = date( 'M', mktime(0, 0, 0, $value['month']));
            $value['status'] = $status[$value['status']];
            $data[$key] = $value;
        }

        

        return $data;

    }


    public function dashboardSurvey(){

        $month = Date('m');
        $query = 'select survey.survey_name as category,count(schedule.id) as value  from survey left join schedule on survey.id = schedule.survey_form where month(schedule.date_schedule) in ('.($month-1).') group by survey.survey_name';
        

        $data = $this->generateData($query);
        return $data;

    }



    private function generateData($query){

            $collection = \Norm::factory('Schedule');

            $statement = $collection->getConnection()->getRaw()->prepare($query);
            $statement->execute();
            $result = array();
            while($row = $statement->fetch(\PDO::FETCH_ASSOC)){
                $result[] = $row;
            }

            return $result;


    }

}

