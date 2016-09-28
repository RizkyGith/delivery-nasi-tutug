<?php

namespace App\Provider;

use \Norm\Filter\Filter;
use App\Provider\URL;

class ApiProvider extends \Bono\Provider\Provider
{
    public function initialize()
    {
        $app = $this->app;

        // do something here
        $app->post('/authentication/mobile', function () use ($app) {

            $entry = $post = $app->request->post();

            try {
                $app = \App::getInstance();

                if (!isset($entry['username']) && !isset($entry['password'])) {
                        throw new \Exception("Empty Username or password", 400);

                }

                $memberCollection = \Norm\Norm::factory(@$this->options['User'] ?: 'User');

                $member = $memberCollection->findOne(array(
                    '!or' => array(
                        array('username' => $entry['username']),
                        array('password' => $entry['password']),
                    ),
                ));

                if (function_exists('salt')) {
                    $entry['password'] = salt($entry['password']);
                }

                if (is_null($member) || $member['password'].'' !== $entry['password']) {
                    // return null;
                    throw new \Exception("not found", 400);

                } else {
                    $error = '';
                    $member = $member->toArray();
                    $userLogin = \Norm::factory('UserLogin');
                    $token = salt($member['username'].date('Ymdhis'));
                    $userToken = $userLogin->findOne(array('user_id'=>$member['$id']));
                    if(empty($userToken) && $userToken['expired'] < date('Y-m-d')){
                        $dataUser = array(
                            'user_id' => $member['$id'],
                            'token'=> $token,
                            'expired'=> date('Y-m-d', strtotime('+1 years')),
                            );
                        $dataUsers = $userLogin->newInstance()->set($dataUser)->save();
                        $member['token'] = $dataUser['token'];

                    }else{
                        $member['token'] = $userToken['token'];
                    }

                    $loginMember = array('entry'=>$member);

                }

                if (!empty($error)) {
                    $entry = $error;
                } else {
                    $entry = $loginMember;
                }
                $app->response->data('entry', $entry);

            } catch (\Slim\Exception\Stop $e) {
                throw $e;
            } catch (\Exception $e) {
                throw $e;
            }

        });

        $app->get('/get/schedule/today', function () use ($app) {
            $get = $app->request->get();
            if($get){
                $pic = $get['pic'];
            }else{
                $pic = '';
            }
            $date = date('Y-m-d');
            $scheduleModel = \Norm::factory('Schedule');
            $scheduleData = $scheduleModel->find(array('date_schedule'=>$date, 'pic'=>$pic));

            $schDatas = array();
            foreach ($scheduleData as $key => $schedule) {

                $schDatas[] = $schedule;
            }

            $app->response->data('entries', $scheduleData);
        });

        $app->get('/get/schedule', function () use ($app) {
            $get = $app->request->get();
            if($get){
                $pic = $get['pic'];
            }else{
                $pic = '';
            }
            $scheduleModel = \Norm::factory('Schedule');
            $scheduleData = $scheduleModel->find(array('pic'=>$pic));

            $schDatas = array();
            foreach ($scheduleData as $key => $schedule) {
                $schDatas[] = $schedule;
            }
            // $token = $this->getToken();
            $app->response->data('entries', $schDatas);
        });
    }
}