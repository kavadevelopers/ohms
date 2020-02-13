<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salary extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->auth->check_session();
    }

    public function attendance()
    {
        $data['_title'] = 'Attendance Sheet';
                            $this->db->order_by('id','desc');
                            $this->db->limit(100);
        $data['days']   =   $this->db->get('days')->result_array();
        $this->load->template('salary/sheet',$data);
    }

    public function attendance_save()
    {
        foreach ($this->input->post('date') as $key => $value) {
            $per_day_salary = get_one_day($this->input->post('minute')[$key]) * $this->general_model->per_min_salary($this->input->post('empid')[$key]);
            $this->db->where('date',$this->input->post('date')[$key]);
            $this->db->where('emp_id',$this->input->post('empid')[$key]);
            $salary = $this->db->get('salary')->num_rows();
            if($salary > 0){
                $this->db->where('date',$this->input->post('date')[$key]);
                $this->db->where('emp_id',$this->input->post('empid')[$key]);
                $this->db->update('salary',['minute' => $this->input->post('minute')[$key],'salary' => $per_day_salary]);
            }else{
                $this->db->where('date',$this->input->post('date')[$key]);
                $this->db->where('emp_id',$this->input->post('empid')[$key]);
                $data = [
                    'date'   => $this->input->post('date')[$key],
                    'emp_id' => $this->input->post('empid')[$key],
                    'minute' => $this->input->post('minute')[$key],
                    'salary' => $per_day_salary
                ];
                $this->db->insert('salary',$data);
            }
        }

        $this->session->set_flashdata('msg', 'Attendance Saved');
        redirect(base_url('salary/attendance'));
    }

    public function addmonth()
    {               $this->db->order_by('id','desc');
                    $this->db->limit(1);
        $month =    $this->db->get('months')->row_array();
        if($month){
            $newmonth = date( "m", strtotime( "01-".$month['month']."-".$month['year']." +1 month"));
            $newyear = date( "Y", strtotime( "01-".$month['month']."-".$month['year']." +1 month"));
            $this->db->insert('months',['month' => $newmonth,'year' => $newyear]);
            $employees = $this->db->get_where('employees',['df' => ''])->result_array();

            $c_year = $newyear;
            $c_month = $newmonth;
            $no_day = cal_days_in_month(CAL_GREGORIAN, $c_month, $c_year);           
            for($i=1; $i<=$no_day; $i++){ 
                $this->db->insert('days',['date' => $newyear.'-'.$newmonth.'-'.$i]);
                $day_id = $this->db->insert_id();
                foreach ($employees as $key => $employee) {
                    $this->db->insert('salary',['emp_id' => $employee['id'],'date' => $newyear.'-'.$newmonth.'-'.$i]);   
                }
            }
        }
        else{
            $this->db->insert('months',['month' => date('m'),'year' => date('Y')]);
            $employees = $this->db->get_where('employees',['df' => ''])->result_array();

            $c_year = date('Y');
            $c_month = date('m');
            $no_day = cal_days_in_month(CAL_GREGORIAN, $c_month, $c_year);           
            for($i=1; $i<=$no_day; $i++){ 
                $this->db->insert('days',['date' => $c_year.'-'.$c_month.'-'.$i]);
                $day_id = $this->db->insert_id();
                foreach ($employees as $key => $employee) {
                    $this->db->insert('salary',['emp_id' => $employee['id'],'date' => $c_year.'-'.$c_month.'-'.$i]);   
                }
            }
        }

        $this->session->set_flashdata('msg', 'Month Added');
        redirect(base_url('salary/attendance'));
    }

    public function monthly()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST'){
            $data['_title'] = "Monthly Salary";
            $data['_e'] = 1;
            $empid = $this->input->post('name');
            $month = explode('-', $this->input->post('month'))[0];
            $year = explode('-', $this->input->post('month'))[1];
            $this->db->order_by('id','desc');
            $data['months'] = $this->db->get('months')->result_array();
            $data['employees']  = $this->db->get_where('employees',['df'=>''])->result_array();
            $this->db->order_by('date','asc');
            $this->db->where('emp_id',$empid);
            $this->db->where('year(date)',$year);
            $this->db->where('month(date)',$month);
            $data['salary'] = $this->db->get('salary')->result_array();
            $this->load->template('salary/monthly',$data);
        }else{
            $data['_title'] = "Monthly Salary";
            $data['_e'] = 0;
            $this->db->order_by('id','desc');
            $data['months'] = $this->db->get('months')->result_array();
            $data['employees']  = $this->db->get_where('employees',['df'=>''])->result_array();
            $this->load->template('salary/monthly',$data);
        }
    }
}
?>