<?PHP
include("../../conn.php");

if(isset($_GET["Paid"])){
    session_start();
    $Pdate = date("Y-m-d");
    $prod = $_GET["prod"];
    $quan = $_GET["quan"];
    $uprice = $_GET["uprice"];
    $purpose = $_GET["purp"];
    $tprice = $uprice*$quan;

    if($purpose == 'New Product'){
        $conn->query("INSERT INTO tblproduct (fldproduct, flddate, fldquantity, fldunitprice, fldtotalprice, fldtype)
        values ('$prod', '$Pdate', '$quan', '$uprice', '$tprice', 'Delivery')");
        $conn->query("INSERT INTO tblstock (fldproduct, fldquantity)
        values ('$prod','$quan')");
    }elseif($purpose == 'Restock'){
        $res = $conn->query("Select fldquantity from tblstock where fldproduct = '$prod'");
        while($row=$res->fetch_assoc()){
            $newquan = $row["fldquantity"] + $quan;
        }
        $conn->query("INSERT INTO tblproduct (fldproduct, flddate, fldquantity, fldunitprice, fldtotalprice, fldtype)
        values ('$prod', '$Pdate', '$quan', '$uprice', '$tprice', 'Delivery')");
        $conn->query("UPDATE tblstock set fldquantity = '$newquan' where fldproduct = '$prod'");

    }
    $conn->query("delete from tblrequest where id='$_GET[Paid]'");
    header("location: ../purchasing/account_payable.php?Paid");
}elseif(isset($_GET["txtdate"])){
    $date = $_GET['txtdate'];
    $prod = $_GET['txtproduct'];
    $quan = $_GET['txtquantity'];
    $uprice = $_GET['txtuprice'];
    $tprice = $quan * $uprice;
    if(isset($_GET["Wastages"])){
        $res = $conn->query("Select fldquantity from tblstock where fldproduct = '$prod'");
        while($row=$res->fetch_assoc()){
            $newquan = $row["fldquantity"] - $quan;
        }
        $conn->query("UPDATE tblstock set fldquantity = '$newquan' where fldproduct = '$prod'");

        $reason = $_GET["txtreason"];
        $conn->query("INSERT INTO tblproduct (fldproduct, flddate, fldquantity, fldunitprice, fldtotalprice, fldtype, fldreason)
        values ('$prod', '$date', '$quan', '$uprice', '$tprice', 'Wastages', '$reason')");
        header("location: iframe/stock_record.php?");
    }elseif(isset($_GET["Transfer"])){
        $res = $conn->query("Select fldquantity from tblstock where fldproduct = '$prod'");
        while($row=$res->fetch_assoc()){
            $newquan = $row["fldquantity"] - $quan;
        }
        $conn->query("UPDATE tblstock set fldquantity = '$newquan' where fldproduct = '$prod'");

        $destination = $_GET["txtdestination"];
        $conn->query("INSERT INTO tblproduct (fldproduct, flddate, fldquantity, fldunitprice, fldtotalprice, fldtype, flddestination)
        values ('$prod', '$date', '$quan', '$uprice', '$tprice', 'Stock Transfer', '$destination')");
        header("location: iframe/stock_record.php?");
    }elseif(isset($_GET["PhysicalCount"])){
        $res = $conn->query("Select fldquantity from tblstock where fldproduct = '$prod'");
        while($row=$res->fetch_assoc()){
            $currentstock = $row["fldquantity"];
        }

        $variance = $currentstock - $quan;
        $loss = $uprice * $variance;
        $conn->query("INSERT INTO tblproduct (fldproduct, flddate, fldquantity, fldunitprice, fldtotalprice, fldtype, fldvariance, fldcurrentstock)
        values ('$prod', '$date', '$quan', '$uprice', '$loss', 'Physical Count', '$variance', '$currentstock')");
        
        $conn->query("UPDATE tblstock set fldquantity = '$quan' where fldproduct = '$prod'");

        header("location: iframe/stock_record.php?");
    }
}
?>