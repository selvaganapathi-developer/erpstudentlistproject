<?php
class crud_model extends CI_Model{

  //insert sigup datas in db
    public function insert_values($result){
        // echo "<pre>result";print_r($result);exit;
        $this->db->insert('inserted_data',$result);
       return $this->db->get('inserted_data')->result_array();
     }

      //email unique validation
      public function email_exists($email) {
         $query = $this->db->get_where('inserted_data', array('email' => $email));
         return $query->num_rows() > 0;
      }

      public function display_regulations(){
      $this->db->select('*');
      $this->db->FROM('regulation');
      $this->db->order_by('semester');
      $query=$this->db->get()->result_array();
      return $query;
      }


     //listing all datas in the  tables
     public function listing_data(){
      $this->db->select('*');
      $this->db->FROM('student_details');
      $query=$this->db->get()->result_array();
      return $query;
   }

   public function updating_data($id){
    $this->db->select('*');
    $this->db->Where('id',$id);
    $this->db->FROM('student_details');
    $query=$this->db->get()->row_array();
    return $query;
 }

 public function updateddata($id,$updated_data){
  $this->db->where('id',$id);
  $this->db->update('student_details',$updated_data);
}

public function delete_data($id){
   $this->db->where('id',$id);
   $this->db->delete('student_details');
}

public function checkDetails($email){
 return   $this->db->where('email',$email)->get('inserted_data')->row();
}
}
?>