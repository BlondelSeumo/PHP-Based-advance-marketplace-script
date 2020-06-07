<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class CronOperationsHandler extends CI_Model
{
    
    // In this class, array instead of string would be the standard input / output format.
    
    static private function stringToArray($jobs = '') {
        $array = explode("\r\n", trim($jobs)); // trim() gets rid of the last \r\n
        foreach ($array as $key => $item) {
            if ($item == '') {
                unset($array[$key]);
            }
        }
        return $array;
    }
    
    static private function arrayToString($jobs = array()) {
        $string = implode("\r\n", $jobs);
        return $string;
    }
    
    static public function getJobs() {
        $output = shell_exec('crontab -l');
        return self::stringToArray($output);
    }
    
    static public function saveJobs($jobs = array()) {
        $output = shell_exec('echo "'.self::arrayToString($jobs).'" | crontab -');
        return $output;	
    }

    static public function doesJobExist($job = '') {
        $jobs = self::getJobs();
        if (in_array($job, $jobs)) {
            return true;
        } else {
            return false;
        }
    }

    static public function addJob($job = '') {
        if (self::doesJobExist($job)) {
            return false;
        } else {
            $jobs = self::getJobs();
            $jobs[] = $job;
            return self::saveJobs($jobs);
        }
    }
    
    static public function removeJob($job = '') {
        if (self::doesJobExist($job)) {
            $jobs = self::getJobs();
            unset($jobs[array_search($job, $jobs)]);
            return self::saveJobs($jobs);
        } else {
            return false;
        }
    }

    static public function editJob($job = '') {
        if (self::doesJobExist($job)) {
            $jobs = self::getJobs();
            unset($jobs[array_search($job, $jobs)]);
            return self::saveJobs($jobs);
        } else {
            return false;
        }
    }

    public function arrangeJobData(){
        $cronjob_minutes = $this->input->post('cronjob_minutes');
        $cronjob_hours = $this->input->post('cronjob_hours');
        $cronjob_days = $this->input->post('cronjob_days');
        $cronjob_months = $this->input->post('cronjob_months');
        $cronjob_weekdays = $this->input->post('cronjob_weekdays');
        $cronjob_tasks = $this->input->post('cronjob_tasks');

        $jobrt=$cronjob_minutes.' '.$cronjob_hours.' '.$cronjob_days.' '.$cronjob_months.' '.$cronjob_weekdays.' '.'curl'.' '.base_url().'markascompleted';
        return $this->addCronJobtoDB($cronjob_minutes,$cronjob_hours,$cronjob_days,$cronjob_months,$cronjob_weekdays,$cronjob_tasks,$jobrt);
    }

    public function addCronJobtoDB($cronjob_minutes,$cronjob_hours,$cronjob_days,$cronjob_months,$cronjob_weekdays,$cronjob_tasks,$jobrt){
          $data = array(
            'cron_job' =>$cronjob_tasks,
            'cron_Minute' => $cronjob_minutes,
            'cron_Hour' => $cronjob_hours,
            'cron_day' => $cronjob_days,
            'cron_month' => $cronjob_months,
            'cron_weekday' => $cronjob_weekdays,
            'status' => 1
            );

            $this->db->where('cron_job',$cronjob_tasks);
            $q = $this->db->get('tbl_cron');

            if ( $q->num_rows() > 0 ) {
                $this->db->where('cron_job',$cronjob_tasks);
                $query = $this->db->get('tbl_cron');
                $Currentdata=$query->result_array();
                $job=$Currentdata[0]['cron_Minute'].' '.$Currentdata[0]['cron_Hour'].' '.$Currentdata[0]['cron_day'].' '.$Currentdata[0]['cron_month'].' '.$Currentdata[0]['cron_weekday'].' '.'curl'.' '.base_url().$Currentdata[0]['cron_job'];

                CronOperationsHandler::removeJob($job);
                CronOperationsHandler::addJob($jobrt);
                $this->db->where('cron_job', $cronjob_tasks);
                return $this->db->update('tbl_cron', $data); 
            }
            else
            {
                CronOperationsHandler::addJob($jobrt);
                return $this->db->insert('tbl_cron',$data);
            }
    }

    public function get_data()
    {
        $query = $this->db->get('tbl_cron');
        return $query->result_array();
    }

    public function get_data_json()
    {
        $query = $this->db->get('tbl_cron');
        exit(json_encode($query->result_array()));
    }

    public function deletecronDatafromDb($cronjob_tasks)
    {
        $this->db->where('cron_job',$cronjob_tasks);
        $query = $this->db->get('tbl_cron');
        $Currentdata=$query->result_array();
        $job=$Currentdata[0]['cron_Minute'].' '.$Currentdata[0]['cron_Hour'].' '.$Currentdata[0]['cron_day'].' '.$Currentdata[0]['cron_month'].' '.$Currentdata[0]['cron_weekday'].' '.base_url().$Currentdata[0]['cron_job'];

        CronOperationsHandler::removeJob($job);

        $this->db->where('cron_job',$cronjob_tasks);
        return $this->db->delete('tbl_cron');
    }


    
}

?>