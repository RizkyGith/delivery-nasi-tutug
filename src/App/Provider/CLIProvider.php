<?php

namespace App\Provider;

use Norm\Schema\String;
use Norm\Schema\Integer;
use Norm\Schema\Text;
use Norm\Schema\Date;
use Norm\Schema\DateTime;
use Norm\Schema\Reference;

class CLIProvider extends \Bono\Provider\Provider
{
    public function initialize()
    {
        $app = $this->app;

        $app->get('/generate_report', function () use ($app) {
        	$collection = \Norm::factory('User');
        	$dialect = $collection->getConnection()->getDialect();

        	$connection = \Norm::getConnection('mysql');
        	$surveyModel = \Norm::factory('Survey')->find(array('status' => 1));

        	$defaultschema = array(
        						'survey_id'     		=> Integer::create('survey_id'),
						        'survey_name'   		=> String::create('survey_name'),
						        'survey_start'  		=> Date::create('survey_start'),
						        'survey_finish' 		=> Date::create('survey_finish'),
						        'user_id' 				=> Reference::create('user_id', 'User')->to('User', '$id', 'username'),
						        'schedule_id' 			=> Integer::create('schedule_id'),
						        'asset_number' 			=> String::create('asset_number'),
						        'asset_name' 			=> String::create('asset_name'),
						        'component_asset_id'	=> Integer::create('component_asset_id'),
						        'component_asset_name'	=> String::create('component_asset_name'),
						        'grade'					=> Integer::create('grade'),
						        '_created_by' 			=> String::create('_created_by'),
						        '_updated_by' 			=> String::create('_updated_by'),
						        '_created_time'  		=> DateTime::create('_created_time'),
						        '_updated_time' 		=> DateTime::create('_updated_time'),
							);

        	$schema = array();
        	$param = array();
        	foreach ($surveyModel as $key => $survey) {
        		$questionModel = \Norm::factory('Question');
        		$questions = $questionModel->find(array('survey_id' => $survey['$id']));

        		$fields = array();
        		foreach ($questions as $q => $question) {

        			$fields[$question['question_name']] = String::create($question['question_name'],$question['question']);

        		}

        		$survey_name = str_replace(' ', '_', strtolower($survey['survey_name']));
        		
        		$mergeschema = array_merge($defaultschema, $fields);

	        	$query = $dialect->grammarCreate($survey_name, $mergeschema);
	        	$modified_query = $query.' ENGINE = MyISAM';
	        	// echo "<pre>";
	        	// print_r($query.' ENGINE = MyISAM'); exit;

	            $statement = $connection->getRaw()->query($modified_query);
		        $statement->execute();

	        	$param[$survey['$id']] = array(
	        			'defaultschema' => $defaultschema,
	        			'schema' => $fields,
	        			'table' => $survey_name,
	        		);
        	}
        	$this->dataSummary($param, $connection, $dialect);

        });

        $app->get('/set_schedule_active', function () use ($app) {
        	$now = date('Y-m-d');
        	$schedules = \Norm::factory('Schedule')->find(array('status' => '1', 'supervisor_approval'=>'1', 'chief_approval'=>'1', 'date_schedule'=>$now));
        	foreach ($schedules as $key => $schedule) {
        		$scheduleModel = \Norm::factory('Schedule')->findOne($schedule['$id']);
        		$scheduleModel->set(array('status'=>'2'))->save();
        	}
			echo " Schedule has been activated";
			exit();
        });
	}

	private function dataSummary($datas, $connection, $dialect)
	{
		foreach ($datas as $key => $data) {
			$actual_survey = \Norm::factory('ActualSurvey')->find(array('survey_id' => $key, 'report_status' => 1, 'approved_by!ne' => 'NULL'));
			$datasummary = array();
			foreach ($actual_survey as $survey => $actual) {
				$actual_question = \Norm::factory('ActualQuestion', 'question_model')->find(array('actual_survey_id' => $actual['$id']));

				$datasummary[$survey] = array();
				$grade = array();
				foreach ($actual_question as $act_qst => $act_question) {
						
					foreach ($data['schema'] as $schema) {

						if (strpos($act_question['question_name'], '[]') !== false) {
							$act_question['question_name'] = trim($act_question['question_name'],'[]');
						}

						if ($schema['name'] == $act_question['question_name']) {
							if ($act_question['question_model'] == 'multiple' || $act_question['question_model'] == 'dropdown' || $act_question['question_model'] == 'checkbox') {
								$questionModel = \Norm::factory('Question')->findOne(array('$id' => $act_question['question_id']));
								foreach ($questionModel['question_model'][0]['choice'] as $each => $choice) {
									if ($act_question['question_model'] == 'checkbox') {
						                if (strpos($act_question['value'], ';') > 0) {
						                    $checked = explode(';', $act_question['value']);

						                    foreach ($checked as $ck => $check) {
												if ($check == $choice['choice_value']) {
													$check_value[$ck] = $choice['choice_label'];
												}
						                    }

											$value = implode(', ', $check_value);
						                }else{
											if ($act_question['value'] == $choice['choice_value']) {
												$value = $choice['choice_label'];
											} 
						                }

										$datasummary[$survey][$schema['name']] = $value;
									} else {
										if ($act_question['value'] == $choice['choice_value']) {
											$datasummary[$survey][$schema['name']] = $choice['choice_label'];
										} 
									}
								}
							} else {
								$datasummary[$survey][$schema['name']] = $act_question['value'];
							}


							$grade[] = $act_question['grade'];
						}
					}

				}

				foreach ($data['defaultschema'] as $defaultschema) {

					$datasummary[$survey][$defaultschema['name']] = $actual[$defaultschema['name']];
					if ($defaultschema['name'] == 'grade') {
						$datasummary[$survey]['grade'] = array_sum($grade);
					}
				}
				
				// $actual->set('grade', array_sum($grade));
				$actual->set('report_status', 2);
				$actual->save();
			}

			foreach ($datasummary as $sum => $summary) {
	        	$connection->persist($data['table'], $summary);
			}

		}
		
	}

}