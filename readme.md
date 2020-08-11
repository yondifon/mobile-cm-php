# PHP - Mobile Operators Cameroon

Determine mobile telephone operator from user number (Cameroon)


### Installation 
```composer require malico/mobile-cm-php```

### Usage 

```php

<?php

require 'vendor/autoload.php';

use Malico\MobileCM\Network;

$phone = '00237653956703';
// $phone = '+237653956703';
// $phone = '237653956703';
// $phone = '653956703';

echo Network::check($phone);
// nexttel | mtn | orange

if (Network::isOrange($phone)) {
    echo 'Orange';
}
// Network::isMTN($phone)
// Network::isNexttel($phone)


?>
```
Simple. But useful