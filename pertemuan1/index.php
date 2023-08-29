<!DOCTYPE html>
<html>
<head>
   <title>Table</title>
   <style>
      table {
         border-collapse: collapse;
      }
      thead {
         background-color: yellow;
      }
      th,
      td {
         width: 70px;
         border: 1px solid black;
      }
      thead tr:nth-child(2) th:nth-child(2) {
         padding: 0 20px;
      }
      tbody tr:nth-child(1) td:nth-child(1) {
         text-align: center;
      }
      tbody tr:nth-child(2) td:nth-child(1),
      tr:nth-child(3) td:nth-child(1) {
         text-align: right;
      }
      tbody tr:nth-child(2) td:nth-child(4) {
         color: red;
      }
   </style>
</head>

<body>
   <?php
   echo "
   <table>
      <thead>
         <tr>
            <th rowspan='2'>No</th>
            <th rowspan='2'>Nama</th>
            <th colspan='2'>Alamat</th>
            <th rowspan='2'>Kota</th>
         </tr>
         <tr>
            <th>Jalan</th>
            <th>Kelurahan</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td>1</td>
            <td>Budi</td>
            <td>Sumatera</td>
            <td>Gubeng</td>
            <td>Surabaya</td>
         </tr>
         <tr>
            <td>2</td>
            <td>Iwan</td>
            <td>Telang</td>
            <td>Kamal</td>
            <td>Bangkalan</td>
         </tr>
         <tr>
            <td>3</td>
            <td>Yuni</td>
            <td>A.Yani</td>
            <td>Jember</td>
            <td>Jember</td>
         </tr>
      </tbody>
   </table>";
   ?>
</body>

</html>