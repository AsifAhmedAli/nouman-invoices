<!DOCTYPE html>
<html>

<head>
    <?php
    // $servername = "localhost";
    // $username = "u679021239_nouman_invoice";
    // $password = "Roaala@1212";
    // $dbname = "nouman_invoices_print";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nouman_invoices_print";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // echo "Connected successfully";
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <h3 class="text-center my-5">Iqra Model School System Invoicing Platform</h3>
    <div>
        <form id="add_new_field" class="col-md-6 mx-auto my-3">
            <div class="form-group my-3">
                <label for="exampleInputEmail1">Field Value</label>
                <input type="text" class="form-control" id="fieldValue" aria-describedby="emailHelp" placeholder="Enter Field Value">
            </div>
            <div class="form-group my-3">
                <label for="exampleInputPassword1">Amount</label>
                <input type="number" class="form-control" id="amount" placeholder="Amount">
            </div>
            <button type="button" onclick="myfunction()" class="btn btn-primary">Add</button>
        </form>
    </div>
    <form id="add_new_field1" class="col-md-6 mx-auto my-3">
        <div class="form-group my-3">
            <label for="exampleInputPassword1">Starting Bill Number</label>
            <input type="number" class="form-control" id="billno" placeholder="Starting Bill Number">
        </div>
        <button type="button" onclick="addBillNumber()" class="btn btn-primary">Add</button>
    </form>

    <form id="add_new_field2" class="col-md-6 mx-auto my-3">
        <div class="form-group my-3">
            <label for="exampleInputPassword3">Today Date</label>
            <input type="date" class="form-control" id="todaydate" placeholder="Today Date">
        </div>
        <button type="button" onclick="addBilltodaydate()" class="btn btn-primary">Add</button>
    </form>
    <div class="container" id="invoice_container">
        <?php

        // $sql = "SELECT * FROM bill_details";
        // $result = $conn->query($sql);
        // $total_rows = $result->num_rows;
        // if ($result->num_rows > 0) {
        //     // output data of each row
        //     while ($row1 = $result->fetch_assoc()) {
        //         $bill_no = $row1['bill_no'];
        //     }
        // }
        // echo $total_rows;
        ?>
        <?php
        // echo date("j+10-F-Y") . "<br>";
        $current_year = date("Y");
        $current_month = date("F");
        $today_date = date("j-F-Y");
        $due_date = date("j") + 10;
        $due_whole_date = $due_date . date("-F-Y");
        // echo $current_year;
        // echo $current_month;
        // echo $today_date;
        // echo $due_whole_date;
        $sql = "SELECT * FROM details";
        $result = $conn->query($sql);
        $total_rows = $result->num_rows;
        // echo $total_rows;
        echo "<script>document.cookie = 'total_rows=$total_rows';</script>";
        $i = 0;
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {

                echo '<div class="col-12" id="invoice_body' . $i . '">
                <div class="row">
                    <div class="col-md-6" style="border: 1px dashed black;">
                        <div class="row  my-3">
                            <div class="text-start" style="width:112.73px">
                                <img src="./1.jpeg" class="mx-auto" height="100px" alt="">
                            </div>
                            <div style="width: auto;"><p>Bank Of Punjab</p><p>BOP Chechian Branch Dinga Road Gujrat</p><p>A/C Number: 6020218500100017</p></div>
                        </div>
                        <div class="row">
                        <div style="width: auto;" class="col"><p>Bill No: <span id="billnoa' . $i . '"></span></p><p>Date Created: <span id="todaydatefield' . $i . '"></span></p><p>Due Date: <span id="duedatefield' . $i . '"></span></p></div>
                        <div style="width: auto;" class="col"><p>Student Name: ' . $row['std_name'] . '</p><p>Father Name: ' . $row['fathername'] . '</p><p>Registration Number: ' . $row['Registrationnumber'] . '</p></div>
                        </div>

                        <table class="table  table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Description</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody id="invoiceTableBody' . $i . '">
                            <tr>    
                            <td>School Fee</td>
                            <td>' . $row["Actual"] . '</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="col-12 text-end">
                            <table class="table col-6 table-striped table-hover">
                                <tbody>
                                    <tr scope="row">
                                        <td>Total</td>
                                        <td id="totalamount' . $i . '">' . $row["Actual"] . '</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mb-5">
                        <h6>PAYMENT TERMS:</h6>
                            1. This bill must be deposited in any branch of The Bank of punjab (BOP) within10 days of the concerned quarter. No one else is authorized to receive the fee in cash.<br>
                            2. A fine of Rs.500/- will be charged on a daily basis after the due date for the next 10 days. Dues still unpaid after this 10-day period will result in the student`s admission being suspend.<br>
                            3. If a child is absent for more than 2 weeks without notice and the fee is not paid his/her name will be struck off the Rolls.<br>
                            4. The security will be refunded uptil six months of withdrawal/graduation and once all dues are cleared.<br>
                            5. The company reserves the right to utilize the security deposit at its sole discretion till refunded.<br>
                            6. Fee of 1st and 4th quarter i.e July to September and April to June will not be refunded in any case. However, the security is refundable.<br>
                            7. Class 11 and A 2 Students remain on the school rolls end of June and shall pay fee accordingly.<br>
                            8. There will be an increase in fee annually as per law.<br>
                            9. This voucher will remain valid for 12 months since issuance date.<br>
                        </div>
                        <h6>Student Copy</h6>
                    </div>



                    <div class="col-md-6" style="border: 1px dashed black;">
                        <div class="row  my-3">
                            <div class="text-start" style="width:112.73px">
                                <img src="./1.jpeg" class="mx-auto" height="100px" alt="">
                            </div>
                            <div style="width: auto;"><p>Bank Of Punjab</p><p>BOP Chechian Branch Dinga Road Gujrat</p><p>A/C Number: 6020218500100017</p></div>
                        </div>
                        <div class="row">
                        <div style="width: auto;" class="col"><p>Bill No: <span id="billnoaa1' . $i . '"></span></p><p>Date Created: <span id="todaydatefielda1' . $i . '"></span></p><p>Due Date: <span id="duedatefielda1' . $i . '"></p></div>
                        <div style="width: auto;" class="col"><p>Student Name: ' . $row['std_name'] . '</p><p>Father Name: ' . $row['fathername'] . '</p><p>Registration Number: ' . $row['Registrationnumber'] . '</p></div>
                        </div>

                        <table class="table  table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Description</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody id="invoiceTableBodya1' . $i . '">
                            <tr>    
                            <td>School Fee</td>
                            <td>' . $row["Actual"] . '</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="col-12 text-end">
                            <table class="table col-6 table-striped table-hover">
                                <tbody>
                                    <tr scope="row">
                                        <td>Total</td>
                                        <td id="totalamounta1' . $i . '">' . $row["Actual"] . '</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mb-5">
                        <h6>PAYMENT TERMS:</h6>
                            1. This bill must be deposited in any branch of The Bank of punjab (BOP) within10 days of the concerned quarter. No one else is authorized to receive the fee in cash.<br>
                            2. A fine of Rs.500/- will be charged on a daily basis after the due date for the next 10 days. Dues still unpaid after this 10-day period will result in the student`s admission being suspend.<br>
                            3. If a child is absent for more than 2 weeks without notice and the fee is not paid his/her name will be struck off the Rolls.<br>
                            4. The security will be refunded uptil six months of withdrawal/graduation and once all dues are cleared.<br>
                            5. The company reserves the right to utilize the security deposit at its sole discretion till refunded.<br>
                            6. Fee of 1st and 4th quarter i.e July to September and April to June will not be refunded in any case. However, the security is refundable.<br>
                            7. Class 11 and A 2 Students remain on the school rolls end of June and shall pay fee accordingly.<br>
                            8. There will be an increase in fee annually as per law.<br>
                            9. This voucher will remain valid for 12 months since issuance date.<br>
                        </div>
                        <h6>School Copy</h6>
                    </div>




                
                </div>



                <div class="row">
                <div class="col-md-6" style="border: 1px dashed black;">
                    <div class="row  my-3">
                        <div class="text-start" style="width:112.73px">
                            <img src="./1.jpeg" class="mx-auto" height="100px" alt="">
                        </div>
                        <div style="width: auto;"><p>Bank Of Punjab</p><p>BOP Chechian Branch Dinga Road Gujrat</p><p>A/C Number: 6020218500100017</p></div>
                    </div>
                    <div class="row">
                    <div style="width: auto;" class="col"><p>Bill No: <span id="billnoaaa2' . $i . '"></span></p><p>Date Created: <span id="todaydatefieldaa2' . $i . '"></span></p><p>Due Date: <span id="duedatefieldaa2' . $i . '"></p></div>
                    <div style="width: auto;" class="col"><p>Student Name: ' . $row['std_name'] . '</p><p>Father Name: ' . $row['fathername'] . '</p><p>Registration Number: ' . $row['Registrationnumber'] . '</p></div>
                    </div>

                    <table class="table  table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody id="invoiceTableBodyaa2' . $i . '">
                        <tr>    
                        <td>School Fee</td>
                        <td>' . $row["Actual"] . '</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="col-12 text-end">
                        <table class="table col-6 table-striped table-hover">
                            <tbody>
                                <tr scope="row">
                                    <td>Total</td>
                                    <td id="totalamountaa2' . $i . '">' . $row["Actual"] . '</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-5">
                    <h6>PAYMENT TERMS:</h6>
                        1. This bill must be deposited in any branch of The Bank of punjab (BOP) within10 days of the concerned quarter. No one else is authorized to receive the fee in cash.<br>
                        2. A fine of Rs.500/- will be charged on a daily basis after the due date for the next 10 days. Dues still unpaid after this 10-day period will result in the student`s admission being suspend.<br>
                        3. If a child is absent for more than 2 weeks without notice and the fee is not paid his/her name will be struck off the Rolls.<br>
                        4. The security will be refunded uptil six months of withdrawal/graduation and once all dues are cleared.<br>
                        5. The company reserves the right to utilize the security deposit at its sole discretion till refunded.<br>
                        6. Fee of 1st and 4th quarter i.e July to September and April to June will not be refunded in any case. However, the security is refundable.<br>
                        7. Class 11 and A 2 Students remain on the school rolls end of June and shall pay fee accordingly.<br>
                        8. There will be an increase in fee annually as per law.<br>
                        9. This voucher will remain valid for 12 months since issuance date.<br>
                    </div>
                    <h6>Bank Copy</h6>
                </div>



                <div class="col-md-6" style="border: 1px dashed black;">
                    <div class="row  my-3">
                        <div class="text-start" style="width:112.73px">
                            <img src="./1.jpeg" class="mx-auto" height="100px" alt="">
                        </div>
                        <div style="width: auto;"><p>Bank Of Punjab</p><p>BOP Chechian Branch Dinga Road Gujrat</p><p>A/C Number: 6020218500100017</p></div>
                    </div>
                    <div class="row">
                    <div style="width: auto;" class="col"><p>Bill No: <span id="billnoaaaa3' . $i . '"></span></p><p>Date Created: <span id="todaydatefieldaaa3' . $i . '"></span></p><p>Due Date: <span id="duedatefieldaaa3' . $i . '"></p></div>
                    <div style="width: auto;" class="col"><p>Student Name: ' . $row['std_name'] . '</p><p>Father Name: ' . $row['fathername'] . '</p><p>Registration Number: ' . $row['Registrationnumber'] . '</p></div>
                    </div>

                    <table class="table  table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody id="invoiceTableBodyaaaa3' . $i . '">
                        <tr>    
                        <td>School Fee</td>
                        <td>' . $row["Actual"] . '</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="col-12 text-end">
                        <table class="table col-6 table-striped table-hover">
                            <tbody>
                                <tr scope="row">
                                    <td>Total</td>
                                    <td id="totalamountaaaa3' . $i . '">' . $row["Actual"] . '</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-5">
                    <h6>PAYMENT TERMS:</h6>
                        1. This bill must be deposited in any branch of The Bank of punjab (BOP) within10 days of the concerned quarter. No one else is authorized to receive the fee in cash.<br>
                        2. A fine of Rs.500/- will be charged on a daily basis after the due date for the next 10 days. Dues still unpaid after this 10-day period will result in the student`s admission being suspend.<br>
                        3. If a child is absent for more than 2 weeks without notice and the fee is not paid his/her name will be struck off the Rolls.<br>
                        4. The security will be refunded uptil six months of withdrawal/graduation and once all dues are cleared.<br>
                        5. The company reserves the right to utilize the security deposit at its sole discretion till refunded.<br>
                        6. Fee of 1st and 4th quarter i.e July to September and April to June will not be refunded in any case. However, the security is refundable.<br>
                        7. Class 11 and A 2 Students remain on the school rolls end of June and shall pay fee accordingly.<br>
                        8. There will be an increase in fee annually as per law.<br>
                        9. This voucher will remain valid for 12 months since issuance date.<br>
                    </div>
                    <h6>Backup Copy</h6>
                </div>




            
            </div>
            </div>';
                $i++;
            }
        } else {
            echo "0 results";
        }
        ?>
        <div class="col-12 text-center my-5">
            <button class="btn btn-primary" onclick="print_invoice()">Print</button>
        </div>
    </div>
    <script>
        function getCookie(cname) {
            let name = cname + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let ca = decodedCookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function addBillNumber() {
            var billnumbervalue;
            var total_rows = getCookie("total_rows");
            for (var i = 0; i < total_rows; i++) {
                // console.log(i)
                billnumbervalue = document.getElementById("billno").value;
                billnumbervalue = parseInt(billnumbervalue);
                // console.log(billnumbervalue)
                totalamountcell = document.getElementById(`billnoa${i}`);
                // billnumbervalue++;
                // document.getElementById("billno").value = billnumbervalue;
                totalamountcell.innerText = billnumbervalue;

                totalamountcell = document.getElementById(`billnoaa1${i}`);
                // billnumbervalue++;
                // document.getElementById("billno").value = billnumbervalue;
                totalamountcell.innerText = billnumbervalue;
                totalamountcell = document.getElementById(`billnoaaa2${i}`);
                // billnumbervalue++;
                // document.getElementById("billno").value = billnumbervalue;
                totalamountcell.innerText = billnumbervalue;
                totalamountcell = document.getElementById(`billnoaaaa3${i}`);
                totalamountcell.innerText = billnumbervalue;
                billnumbervalue++;
                document.getElementById("billno").value = billnumbervalue;

                // totalamountcell1 = parseInt(totalamountcell.innerText)
            }
        }

        function myfunction() {
            var fieldValue = document.getElementById("fieldValue").value;
            var amount = document.getElementById("amount").value;
            var total_rows = getCookie("total_rows");
            var totalamountcell
            var totalamountcell1
            var tableBody
            var newRow
            var cell1
            var cell2
            for (var i = 0; i < total_rows; i++) {
                // console.log(i)
                totalamountcell = document.getElementById(`totalamount${i}`);
                totalamountcell1 = parseInt(totalamountcell.innerText)
                amount = parseInt(amount)
                totalamountcell.innerText = amount + totalamountcell1;
                tableBody = document.getElementById(`invoiceTableBody${i}`);
                newRow = tableBody.insertRow();
                cell1 = newRow.insertCell(0);
                cell2 = newRow.insertCell(1);
                cell1.innerHTML = fieldValue;
                cell2.innerHTML = amount;
            }

            // totalamountaaaa3

            myfunction1()
        }

        function myfunction1() {
            var fieldValue = document.getElementById("fieldValue").value;
            var amount = document.getElementById("amount").value;
            var total_rows = getCookie("total_rows");
            var totalamountcell
            var totalamountcell1
            var tableBody
            var newRow
            var cell1
            var cell2
            var asdflk;
            for (var i = 0; i < total_rows; i++) {
                // console.log(i)
                totalamountcell = document.getElementById(`totalamounta1${i}`);
                totalamountcell1 = parseInt(totalamountcell.innerText)
                amount = parseInt(amount)
                // console.log(amount)
                asdflk = amount + totalamountcell1;
                console.log(asdflk)
                totalamountcell.innerText = amount + totalamountcell1;
                tableBody = document.getElementById(`invoiceTableBodya1${i}`);
                newRow = tableBody.insertRow();
                cell1 = newRow.insertCell(0);
                cell2 = newRow.insertCell(1);
                cell1.innerHTML = fieldValue;
                cell2.innerHTML = amount;
            }
            myfunction2()
        }

        function myfunction2() {
            var fieldValue = document.getElementById("fieldValue").value;
            var amount = document.getElementById("amount").value;
            var total_rows = getCookie("total_rows");
            var totalamountcell
            var totalamountcell1
            var tableBody
            var newRow
            var cell1
            var cell2
            for (var i = 0; i < total_rows; i++) {
                // console.log(i)
                totalamountcell = document.getElementById(`totalamountaa2${i}`);
                totalamountcell1 = parseInt(totalamountcell.innerText)
                amount = parseInt(amount)
                totalamountcell.innerText = amount + totalamountcell1;
                tableBody = document.getElementById(`invoiceTableBodyaa2${i}`);
                newRow = tableBody.insertRow();
                cell1 = newRow.insertCell(0);
                cell2 = newRow.insertCell(1);
                cell1.innerHTML = fieldValue;
                cell2.innerHTML = amount;
            }
            myfunction3()
        }

        function myfunction3() {
            var fieldValue = document.getElementById("fieldValue").value;
            var amount = document.getElementById("amount").value;
            var total_rows = getCookie("total_rows");
            var totalamountcell
            var totalamountcell1
            var tableBody
            var newRow
            var cell1
            var cell2
            for (var i = 0; i < total_rows; i++) {
                // console.log(i)
                totalamountcell = document.getElementById(`totalamountaaaa3${i}`);
                totalamountcell1 = parseInt(totalamountcell.innerText)
                amount = parseInt(amount)
                totalamountcell.innerText = amount + totalamountcell1;
                tableBody = document.getElementById(`invoiceTableBodyaaaa3${i}`);
                newRow = tableBody.insertRow();
                cell1 = newRow.insertCell(0);
                cell2 = newRow.insertCell(1);
                cell1.innerHTML = fieldValue;
                cell2.innerHTML = amount;
            }
        }

        function print_invoice() {
            var content = document.getElementById("invoice_container").innerHTML;
            var printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Print</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"></head><body>');
            printWindow.document.write(content);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            setTimeout(function() {
                // console.log("Waited for 5 seconds!");
                printWindow.print();
            }, 1000); // 5000 milliseconds = 5 seconds

        }

        function addBilltodaydate() {
            var todaydate = document.getElementById("todaydate").value;
            var total_rows = getCookie("total_rows");
            for (var i = 0; i < total_rows; i++) {
                if (todaydate) {

                    document.getElementById(`todaydatefield${i}`).textContent = todaydate;
                    document.getElementById(`todaydatefielda1${i}`).textContent = todaydate;
                    document.getElementById(`todaydatefieldaa2${i}`).textContent = todaydate;
                    document.getElementById(`todaydatefieldaaa3${i}`).textContent = todaydate;
                    // <span id="duedatefield' . $i . '">
                    // Convert the input value to a Date object
                    var date = new Date(todaydate);

                    // Increase the date by 10 days
                    date.setDate(date.getDate() + 10);

                    // Format the new date to YYYY-MM-DD
                    var newDate = date.toISOString().split('T')[0];

                    // Display the new date or set it back to the input element
                    document.getElementById(`duedatefield${i}`).textContent = newDate;
                    document.getElementById(`duedatefielda1${i}`).textContent = newDate;
                    document.getElementById(`duedatefieldaa2${i}`).textContent = newDate;
                    document.getElementById(`duedatefieldaaa3${i}`).textContent = newDate;
                    // Alternatively, if you want to set it back to the input element:
                    // document.getElementById("todaydate").value = newDate;
                } else {
                    alert("Please select a date first.");
                }
            }

        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>

<!-- 
<div class="col-md-6" style="border: 1px dashed black;">
                        <div class="text-center">
                            <img src="./1.jpeg" class="mx-auto" height="150px" alt="">
                        </div>

                    <table class="table  table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody id="">

                        </tbody>
                    </table>
                    <div class="col-12 text-end">
                        <table class="table col-6 table-striped table-hover">
                            <tbody>
                                <tr scope="row">
                                    <td>Total</td>
                                    <td id="totalamounta1">0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" style="border: 1px dashed black;">
                        <div class="text-center">
                            <img src="./1.jpeg" class="mx-auto" height="150px" alt="">
                        </div>

                    <table class="table  table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody id="invoiceTableBodyaa2">

                        </tbody>
                    </table>
                    <div class="col-12 text-end">
                        <table class="table col-6 table-striped table-hover">
                            <tbody>
                                <tr scope="row">
                                    <td>Total</td>
                                    <td id="totalamountaa2">0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <div class="col-md-6" style="border: 1px dashed black;">
                        <div class="text-center">
                            <img src="./1.jpeg" class="mx-auto" height="150px" alt="">
                        </div>

                    <table class="table  table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody id="invoiceTableBodyaaaa3">

                        </tbody>
                    </table>
                    <div class="col-12 text-end">
                        <table class="table col-6 table-striped table-hover">
                            <tbody>
                                <tr scope="row">
                                    <td>Total</td>
                                    <td id="totalamountaaaa3">0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div> -->