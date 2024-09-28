<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class crud_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // $this->load->library('excel');
        $this->load->helper('url'); // Load the URL helper
        $this->load->library('session');
        $this->load->model('crud_model');
    }

    
    public function index()
    {  
        $this->load->helper('url'); // Load the URL helper
        // $this->load->view('crud.php');
        $details['studentdata']=$this->crud_model->listing_data();
        $details['data'] = $this->crud_model->display_regulations();
        $this->load->view('student_details.php',$details);
        
    }

   
    public function backtoLogin(){
        $this->load->helper('url'); // Load the URL helper
        $this->load->view('login_page.php');
    }



    public function students_details_save(){
        // echo "<pre>post";print_r($_POST);exit;
      
        if(!empty($_POST)){
            $stud_data=array(
                'stud_regulation'=>$this->input->post('regulation'),
                'stud_registration'=>$this->input->post('registerno'),
                'stud_name'=>$this->input->post('name'),
                'date_of_birth'=>$this->input->post('dob'),
                'stud_email'=>$this->input->post('email'),
                'contact_number'=>$this->input->post('contact'),
                'current_sem'=>$this->input->post('csemester'),
                'percentage'=>$this->input->post('percentage'),
               
            );
            // echo "<pre>result";print_r($result);exit;
        }else{
            redirect('student_details');
        } 
        $insertedData= $this->db->insert('student_details',$stud_data);
           if ($insertedData == 1) {
            $this->session->set_flashdata('message_type', 'alert-success');
            $this->session->set_flashdata('message', 'Successfully Saved please login - ' . date('d-m-Y h:i a'));
         
        } else {
            $this->session->set_flashdata('message_type', 'alert-danger');
            $this->session->set_flashdata('message', 'Error Details - ' . date('d-m-Y h:i a'));
          
        }
        header("refresh: 1; url=index");
    }

    //listing datas in datatable
  public function listing_data(){
    $details['studentdata']=$this->crud_model->listing_data();
    $details['data'] = $this->crud_model->display_regulations();
    $this->load->view('student_details',$details);
}
public function updating($id) {
    $details['data'] = $this->crud_model->updating_data($id);
    $details['regulations'] = $this->crud_model->display_regulations();

    $this->load->view('updatedata', $details);
}


    public function updated_data($id){
    //    echo "<pre>";print_r($_POST);exit;
        if(!empty($_POST)){
            $updated_data=array(
                'stud_regulation'=>$this->input->post('regulation'),
                'stud_registration'=>$this->input->post('registerno'),
                'stud_name'=>$this->input->post('name'),
                'date_of_birth'=>$this->input->post('dob'),
                'stud_email'=>$this->input->post('email'),
                'contact_number'=>$this->input->post('contact'),
                'current_sem'=>$this->input->post('csemester'),
                'percentage'=>$this->input->post('percentage'),
               
            );
            $this->crud_model->updateddata($id,$updated_data);
           

        }else{
            redirect('crud_controller/index');
        } 
        header("refresh: 1; url=index");
    }

    public function delete($id){
        $this->crud_model->delete_data($id);
         redirect('crud_controller/index');
    }

    public function downloadpdf(){
        // Include the main TCPDF library (search for installation path).
        require_once(APPPATH.'helpers/tcpdf/tcpdf.php');
    
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetTitle('Student Details Page');
        $pdf->SetHeaderData('', 0, 'Student Details Report', '');
        
        
    
        // Set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    
        // Set font
        $pdf->SetFont('helvetica', 'B', 10);
    
        // Add a page
        $pdf->AddPage('L','A4');
    
        // Set header and footer fonts
        $pdf->setHeaderFont(Array('helvetica', '', 10));
        $pdf->setFooterFont(Array('helvetica', '', 10));

        $studentdata = $this->crud_model->listing_data();
        // Set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetX(250);
      $pdf->Cell(8, 10, 'Date: ' . date('d-m-Y'), 0, 0, 'C', false);

        $pdf->Ln();
        // Set table header
        $pdf->Cell(8, 10, 'S.no', 'LTRB', 0, 'C', FALSE);
        $pdf->Cell(24, 10, 'Regulation', 'LTRB', 0, 'C', FALSE);
        $pdf->Cell(40, 10, 'Registration Number', 'LTRB', 0, 'C', FALSE);
        $pdf->Cell(32, 10, 'Student Name', 'LTRB', 0, 'C', FALSE);
        $pdf->Cell(30, 10, 'Date of birth', 'LTRB', 0, 'C', FALSE);
        $pdf->Cell(60, 10, 'Email Address', 'LTRB', 0, 'C', FALSE);
        $pdf->Cell(30, 10, 'Contact Number', 'LTRB', 0, 'C', FALSE);
        $pdf->Cell(30, 10, 'Current Semester', 'LTRB', 1, 'C', FALSE);
        $pdf->SetFont('helvetica', '', 10);
        $i=1;
        foreach ($studentdata as $data) {
            $pdf->Cell(8, 10, $i, 'LTRB', 0, 'C', FALSE);
            $pdf->Cell(24, 10, $data['stud_regulation'], 'LTRB', 0, 'C', FALSE);
            $pdf->Cell(40, 10, $data['stud_registration'], 'LTRB', 0, 'C', FALSE);
            $pdf->Cell(32, 10, $data['stud_name'], 'LTRB', 0, 'C', FALSE);
            $pdf->Cell(30, 10, $data['date_of_birth'], 'LTRB', 0, 'C', FALSE);
            $pdf->Cell(60, 10, $data['stud_email'], 'LTRB', 0, 'C', FALSE);
            $pdf->Cell(30, 10, $data['contact_number'], 'LTRB', 0, 'C', FALSE);
            $pdf->Cell(30, 10, $data['current_sem'], 'LTRB', 1, 'C', FALSE);
            $i++;
        }
        // Output PDF to browser or save to file
        $pdf->Output('example.pdf', 'I');
    }
//     public function downloadexcel(){
//         // $this->load->library('excel');
//         $this->excel->setActiveSheetIndex(0);
//         $this->excel->getActiveSheet()->setTitle('Reconciliation Report');
//          $k=1;
//        $this->excel->getActiveSheet()->setCellValue('A'.$k, 'Transaction Date');
//        $this->excel->getActiveSheet()->getStyle('A'.$k)->getFont()->setBold(true);

//      $this->excel->getActiveSheet()->setCellValue('B'.$k, 'Value Date');
//      $this->excel->getActiveSheet()->getStyle('B'.$k)->getFont()->setBold(true);

//      $this->excel->getActiveSheet()->setCellValue('C'.$k, 'Branch
// ');                 $this->excel->getActiveSheet()->getStyle('C'.$k)->getFont()->setBold(true);
     
//                 $this->excel->getActiveSheet()->setCellValue('D'.$k, 'Cheque No.
// ');                               $this->excel->getActiveSheet()->getStyle('D'.$k)->getFont()->setBold(true);
//                 $this->excel->getActiveSheet()->setCellValue('E'.$k, 'from Portal
// ');                               $this->excel->getActiveSheet()->getStyle('E'.$k)->getFont()->setBold(true);
//                 $this->excel->getActiveSheet()->setCellValue('F'.$k, 'Description
// ');                                 $this->excel->getActiveSheet()->getStyle('F'.$k)->getFont()->setBold(true);
//                 $this->excel->getActiveSheet()->setCellValue('G'.$k, 'Income Details
// ');                                 $this->excel->getActiveSheet()->getStyle('G'.$k)->getFont()->setBold(true);
//                 $this->excel->getActiveSheet()->setCellValue('H'.$k, 'Expense Details
// ');                               $this->excel->getActiveSheet()->getStyle('H'.$k)->getFont()->setBold(true);
//                 $this->excel->getActiveSheet()->setCellValue('I'.$k, 'Student Name
// ');                               $this->excel->getActiveSheet()->getStyle('I'.$k)->getFont()->setBold(true);
//                 $this->excel->getActiveSheet()->setCellValue('J'.$k, 'Roll Number
// ');                               $this->excel->getActiveSheet()->getStyle('J'.$k)->getFont()->setBold(true);

//                 $this->excel->getActiveSheet()->setCellValue('k'.$k, 'Credit
// ');                            $this->excel->getActiveSheet()->getStyle('k'.$k)->getFont()->setBold(true);

//                  $this->excel->getActiveSheet()->setCellValue('L'.$k, 'Debit
// ');                             $this->excel->getActiveSheet()->getStyle('L'.$k)->getFont()->setBold(true);
//                   $this->excel->getActiveSheet()->setCellValue('M'.$k, 'Balance
// ');                               $this->excel->getActiveSheet()->getStyle('M'.$k)->getFont()->setBold(true);
//                 $k++;
//                 // foreach($final as $d){
//                 //  // echo"<pre>";print_r($d);exit;
//                 //         $this->excel->getActiveSheet()->setCellValue('A'.$k, $d['trans_date']);
//                 //         $this->excel->getActiveSheet()->setCellValue('B'.$k, $d['value_date']);
//                 //         $this->excel->getActiveSheet()->setCellValue('C'.$k, $d['branch']);
//                 //         $this->excel->getActiveSheet()->setCellValue('D'.$k, $d['c_n_d_no']);
//                 //         $this->excel->getActiveSheet()->setCellValue('E'.$k, $d['portal_office']);
//                 //         $this->excel->getActiveSheet()->setCellValue('F'.$k, $d['description']);
//                 //           $this->excel->getActiveSheet()->setCellValue('G'.$k, $d['income']);
//                 //             $this->excel->getActiveSheet()->setCellValue('H'.$k, $d['expense']);
//                 //               $this->excel->getActiveSheet()->setCellValue('I'.$k, $d['name']);
//                 //                 $this->excel->getActiveSheet()->setCellValue('J'.$k, $d['roll_number']);

//                 //         if($d['payment_mode']== "income")
//                 //         {
//                 //         $this->excel->getActiveSheet()->setCellValue('K'.$k, $d['amount']);
//                 //     }else
//                 //     {
//                 //          $this->excel->getActiveSheet()->setCellValue('L'.$k, $d['amount']);
//                 //      }
                   
                

                        
//                 //         $k++;
//                 // }
//                 $k++;


//         $filename='Reconciliation Report.xls'; //save our workbook as this file name
//         header('Content-Type:application/vnd.ms-excel'); //mime type
//         header('Content-Disposition:attachment;filename="'.$filename.'"'); //tell browser what's the file name
//         header('Cache-Control: max-age=0'); //no cache
//         //if you want to save it as .XLSX Excel 2007 format
//         $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  

//         //force user to download the Excel file without writing it to server's HD
//         ob_clean();
// $objWriter->save('php://output');    

//     }
}
