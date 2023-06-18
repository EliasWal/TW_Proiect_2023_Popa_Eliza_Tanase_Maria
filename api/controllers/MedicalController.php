<?php 
require '../config.php';
require '../medical/medical-service.php';

class MedicalController
{
    public function get($id)
    {
        if ($id) {
            $medical = getOneMedical($id);
            if ($medical) {
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode([$medical['date'], $medical['doctor'], $medical['symptoms'], $medical['diagnosis'], $medical['medication']]);
            } else {
                http_response_code(404); 
                echo json_encode(['message' => 'Medical not found']);
            }
        } 
    }
    public function getAll(){
        $medical = getMedicalReports(6, 1);
        if($medical){
            header('Content-Type: application/json');
            http_response_code(200);
            foreach($medical as $medical_report){
                echo "id: " . $medical_report['id'] . " date: " . $medical_report['date'] . ", doctor: " . $medical_report['doctor'] . ", symptoms: " . $medical_report['symptoms'] . ", diagnosis: " . $medical_report['diagnosis'] . ", medication: " . $medical_report['medication'] . "<br>";
            }
        }
        else{
            http_response_code(404);
            echo json_encode(['message' => 'No medical reports found']);
        }
    }

    public function post(){
        $id_child = $_POST['id_child'];
        $date = $_POST['date'];
        $doctor = $_POST['doctor'];
        $symptoms = $_POST['symptoms'];
        $diagnosis = $_POST['diagnosis'];
        $medication = $_POST['medication'];
        $user_id = $_POST['user_id'];

        

        $medical = addMedicalReport($user_id, $id_child, $date, $doctor, $symptoms, $diagnosis, $medication);
        if($medical){
            http_response_code(201);
            echo json_encode([
                              'message' => 'Medical report created',
                              'date' => $date,
                              'doctor' => $doctor,
                              'symptoms' => $symptoms,
                              'diagnosis' => $diagnosis,
                              'medication' => $medication]);
        }
        else{
            http_response_code(404);
            echo json_encode(['message' => 'Medical report not created']);
        }
    }

    public function delete($id)
    {
        $medical = getOneMedical($id);
        if(!$medical){
            http_response_code(404);
            echo json_encode(['message' => 'Medical report not found']);
        }else

        if(deleteMedicalReport($id)){
            http_response_code(200);
            echo json_encode(['message' => 'Medical report deleted']);
        }else{
            http_response_code(500);
            echo json_encode(['message' => 'Failde to delete report']);
        }
    }

    public function put($id){
        $medical = getOneMedical($id);
        if(!$medical){
            http_response_code(404);
            echo json_encode(['message' => 'Medical report not found']);
        }
        $putData = file_get_contents('php://input');
        parse_str($putData, $requestData);
        $medical_id = $id;
        $date = $requestData['date'];
        $doctor = $requestData['doctor'];
        $symptoms = $requestData['symptoms'];
        $diagnosis = $requestData['diagnosis'];
        $medication = $requestData['medication'];
        $medical = updateMedicalReport($id, $date, $doctor, $symptoms, $diagnosis, $medication);
        if($medical){
            http_response_code(200);
            echo json_encode([
                              'message' => 'Medical report updated',
                              'date' => $date,
                              'doctor' => $doctor,
                              'symptoms' => $symptoms,
                              'diagnosis' => $diagnosis,
                              'medication' => $medication]);
        }
        else{
            http_response_code(404);
            echo json_encode(['message' => 'Medical report not updated']);
        }
    }

}