# Withdraw

When there is enough money in the account, you can transfer/withdraw 
it or buy something in the system.

Since the currency is virtual, you can buy any services on your website. 
For example, priority in search results.

---

## User Model

Prepare the model, add the `HasWallet` trait and `Wallet` interface.

```php
use GlorifiedKing\Wallet\Traits\HasWallet;
use GlorifiedKing\Wallet\Interfaces\Wallet;

class User extends Model implements Wallet
{
    use HasWallet;
}
```

## Make a Withdraw

Find user:

```php
$user = User::first(); 
```

As the user uses `HasWallet`, he will have `balance` property. 
Check the user's balance.

```php
$user->balance; // int(100)
```

The balance is not empty, so you can withdraw funds.

```php
$user->withdraw(10); 
$user->balance; // int(90)
```

It worked! 

## Force Withdraw

Forced withdrawal is necessary for those cases when 
the user has no funds. For example, a fine for spam.

```php
$user->balance; // int(100)
$user->forceWithdraw(101);
$user->balance; // int(-1)
```

## And what will happen if the money is not enough?

There can be two situations:

- The user's balance is zero, then we get an error
`GlorifiedKing\Wallet\Exceptions\BalanceIsEmpty`
- If the balance is greater than zero, but it is not enough
`GlorifiedKing\Wallet\Exceptions\InsufficientFunds`
