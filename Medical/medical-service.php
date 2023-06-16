<?php 

require '../config.php';

session_start();

function addMedicalReport($user_id, $id_child, $date, $doctor, $symptoms, $diagnosis, $medication) {
    global $mysql;
    $sql = "INSERT INTO medical_report(id_user, id_child, date, doctor, symptoms, diagnosis, medication) VALUES(?,?,?,?,?,?,?)";
    $stmtinsert = $mysql->prepare($sql);
    $stmtinsert->bind_param("iisssss", $user_id, $id_child, $date, $doctor, $symptoms, $diagnosis, $medication);
    if($stmtinsert->execute()) {
        return true;
    }
    else{
        return false;
    }
}

function getMedicalReports($user_id, $id_child) {
    global $mysql;
    $sql= "SELECT * FROM medical_report where id_user=? and id_child=? order by date desc";
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param('ii', $user_id, $id_child);
    $stmt->execute();
    $result = $stmt->get_result();
    $medical_reports = array();
    while($row = $result->fetch_assoc()) {
        $medical_reports[] = $row;
    }
    return $medical_reports;
}

function getNameChild($id_child) {
    global $mysql;
    $sql = "SELECT firstname FROM child where id=?";
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param('i', $id_child);
    $stmt->execute();
    $stmt->bind_result($name);
    $stmt->fetch();
    return $name;
}

function getMedicalReport($id_medical) {
    global $mysql;
    $sql= "SELECT * FROM medical_report where id=?";
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param('i', $id_medical);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row;
}

function updateMedicalReport($id_medical, $date, $doctor, $symptoms, $diagnosis, $medication) {
    global $mysql;
    $sql = "UPDATE medical_report SET date=?, doctor=?, symptoms=?, diagnosis=?, medication=? WHERE id=?";
    $stmtupdate = $mysql->prepare($sql);
    $stmtupdate->bind_param('sssssi', $date, $doctor, $symptoms, $diagnosis, $medication, $id_medical);
    if($stmtupdate->execute()) {
        return true;
    }
    else{
        return false;
    }
}

function deleteMedicalReport($id_medical) {
    global $mysql;
    $sql = "DELETE FROM medical_report WHERE id=$id_medical";
    $rez = mysqli_query($mysql, $sql);
    if($rez) {
        return true;
    }
    else{
        return false;
    }
}
?>