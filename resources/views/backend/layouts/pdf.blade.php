<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    h1{
        text-align: center;
    }
    p{
        margin: 1.5rem auto;
        font-size: 1.5rem;
    }
    
    p span{
        color: #16de16;
    }
</style>
<body>
    <h1>Order Detail</h3>

    <p>Customer Name: {{$order->name}}</p>
    <p>Customer Email: {{$order->email}}</p>
    <p>Customer Phone: {{$order->phone}}</p>
    <p>Customer Address: {{$order->address}}</p>
    <p>Product Title: {{$order->product_title}}</p>
    <p>Quantity: {{$order->quantity}}</p>
    <p>Price: <span>{{$order->price}}</span></p>
    <p>Image: {{$order->image}}</p>

    <h2>Thank you for your order!!!</h2>
</body>
</html>