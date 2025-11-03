<!DOCTYPE html>
<html>
<head>
    <title>Stripe Checkout</title>
</head>
<body>
    <h1>Pay $20</h1>
    <form action="{{ route('admin.stripe.session') }}" method="POST">
        @csrf
        <button type="submit">Pay with Stripe</button>
    </form>
</body>
</html>
