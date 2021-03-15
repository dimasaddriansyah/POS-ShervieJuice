<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script type="text/javascript">
        function startCalculate(){
        interval=setInterval("Calculate()",1);
        }
        
        function Calculate(){
        var a=document.form1.total_harga.value;
        var c=document.form1.uang_bayar.value;
        document.form1.uang_kembali.value=(c-a);
        }
        
        function stopCalc(){
        clearInterval(interval);
        }
        </script>
</head>
<body>
    
        
        Kemudian siapkan tabel berifi form di <body>
        
        <form id="form1" name="form1" method="post" action="">
        <table width="400" border="0" cellpadding="5" cellspacing="1" bgcolor="#333333">
        <tr>
        <td width="50%" bgcolor="#FFFFFF">Total Harga </td>
        <td bgcolor="#FFFFFF"><input name="total_harga" type="text" id="total_harga" style="text-align:right" onfocus="startCalculate()" onblur="stopCalc()" value="250000" readonly></td>
        </tr>
        <tr>
        <td bgcolor="#FFFFFF">Jumlah Uang Bayar </td>
        <td bgcolor="#FFFFFF"><input name="uang_bayar" type="text" id="uang_bayar" size="10" onfocus="startCalculate()" onblur="stopCalc()"></td>
        </tr>
        <tr>
        <td bgcolor="#FFFFFF">Kembali </td>
        <td bgcolor="#FFFFFF"><input name="uang_kembali" type="text" id="uang_kembali" style="text-align:right" onfocus="startCalculate()" onblur="stopCalc()"></td>
        </tr>
        </table>
    </form>
</body>
</html>