<?PHP
include("../conn.php");

if(isset($_POST["sendReq"])){
    // $_SESSION["req_requestor"] = $_POST["txtrequestor"];
    // $_SESSION["req_date"] = $_POST["txtdate"];
    // $_SESSION["req_datereq"] = $_POST["txtdatereq"];
    // $_SESSION["req_purpose"] = $_POST["txtpurpose"];
    // $_SESSION["req_product"] = $_POST["txtproduct"];
    // $_SESSION["req_quantity"] = $_POST["txtquantity"];
    // $_SESSION["req_description"] = $_POST["txtdescription"];
    // $_SESSION["req_unitprice"] = $_POST["txtunitprice"];
    // $_SESSION["req_totalprice"] = $_POST["txttotalprice"];
    // $_SESSION["req_supplier"] = $_POST["txtsupplier"];

    $conn -> query("INSERT INTO tblrequest (fldrequestor,flddate,flddatereq,fldpurpose,fldproduct,fldquantity,flddesc,flduprice,fldtprice,fldsupplier,fldstatus)
                    Values ('$_POST[txtrequestor]','$_POST[txtdate]','$_POST[txtdatereq]','$_POST[txtpurpose]','$_POST[txtproduct]','$_POST[txtquantity]','$_POST[txtdescription]','$_POST[txtunitprice]','$_POST[txttotalprice]','$_POST[txtsupplier]','requested')");

    header("location: purchasing/purchase_request.php?Requested_Successfully");
}elseif(isset($_GET["delid"])){
    session_start();
    if($_GET["name"] == "$_SESSION[user_lastname], $_SESSION[user_givenname]"){
        $conn->query("DELETE FROM tblrequest where id=$_GET[delid]");
        header("location: purchasing/purchase_request.php?Deleted_Successfully");
    }else{
        header("location: purchasing/purchase_request.php?Failed");
    }
}elseif(isset($_GET["Approved"])){
    $conn->query("Update tblrequest set fldstatus = 'approved' where id='$_GET[Approved]'");
    header("location: requests.php?Approved");
}elseif(isset($_GET["Declined"])){
    $conn->query("delete from tblrequest where id='$_GET[Declined]'");
    header("location: requests.php?Declined");
}elseif(isset($_GET["OrderNow"])){
    $conn->query("Update tblrequest set fldstatus = 'ordered' where id='$_GET[OrderNow]'");
    header("location: purchasing/purchase_order.php?Approved");
}elseif(isset($_GET["CancelOrder"])){
    $conn->query("delete from tblrequest where id='$_GET[CancelOrder]'");
    header("location: purchasing/purchase_order.php?CancelOrder");
}


?>