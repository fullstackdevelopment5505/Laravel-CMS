<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice - #{{$order['order_no']}}</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .information {
            background-color: #60A7A6;
            color: #FFF;
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }
    </style>

</head>
<body>

<div class="information">
    <table width="100%">
        <tr>
            <td align="left" style="width: 40%;">
                <h3>{{$order['fullname']}}</h3>
                <pre>
                    {{$order['address']}} <br>
                    {{$order['city']}} -  {{$order['zipcode']}}<br>
                    {{$order['country']}} <br>
                </pre>
            </td>
            <td align="center">
                <img src="<?php echo asset('/').'public'?>{{$sitelogo}}" alt="Logo" width="64" class="logo"/>
            </td>
            <td align="right" style="width: 40%;">
               <h3>{{$sitetitle}}</h3>
            </td>
        </tr>

    </table>
</div>


<br/>

<div class="invoice">
    <h3>Invoice specification #{{$order['order_no']}}</h3>
    <table width="100%">
        <thead>
        <tr>
            <th class="p-name">Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        </thead>
         <tbody>
                                            <?php $total_qty = 0; $total_sub_price = 0; $i = 0; ?>
                                            @foreach($carts as $row)
                                            <tr>
                                                <td class="cart-title first-row">
                                                    <h5>{{$row['product_name']}}</h5>
                                                    <div class="catagory-name sku">{{$row['product_sku']}}<br>
                                                    <?php 
                                                        if(isset($row['options'])){
                                                            $options = json_decode($row['options']);
                                                            foreach ($options as $option) {
                                                                ?>
                                                                <span>--{{$option->option_title}} = {{$option->option_value}}</span><br>
                                                                <?php
                                                            }
                                                        }   
                                                    ?>
                                                    </div>
                                                </td>
                                                <td class="p-price first-row">{{$currency}} {{$row['price']}}</td>
                                                <td class="qua-col first-row">
                                                    {{$row['qty']}}
                                                </td>
                                                <td class="total-price first-row">
                                                <?php 
                                                    $qty = (int) $row['qty'];
                                                    $price = (int) $row['price'];
                                                    $totalprice = ($qty * $price);
                                                    $total_qty = $total_qty + $qty;
                                                    $total_sub_price =  $total_sub_price + $totalprice;
                                                    $i++;
                                                ?>    
                                                {{$currency}} {{$totalprice}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="text-left">Total Qty : </td>
                                                <td class="text-right">{{$total_qty}}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="text-left">Total Price :</td>
                                                <td class="text-right">{{$currency}} {{$total_sub_price}}</td>
                                            </tr>
                                        </tfoot>
    </table>
</div>

<div class="information" style="position: absolute; bottom: 0;">
    <table width="100%">
        <tr>
            <td align="left" style="width: 50%;">
                &copy; {{ date('Y') }} {{ $siteurl }} - All rights reserved.
            </td>
            <td align="right" style="width: 50%;">
                {{$sitetitle}}
            </td>
        </tr>

    </table>
</div>
</body>
</html>