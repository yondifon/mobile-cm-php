# PHP - Mobile Operators Cameroon

Determine mobile telephone operator from user number (Cameroon)

### Installation

```bash
composer require malico/mobile-cm-php
```

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
// nexttel | mtn | orange | camtel

if (Network::isOrange($phone)) {
    echo 'Orange';
}
if (Network::IsNexttel($phone)) {
    echo 'Nextel';
}

if (Network::isCamtel($phone)) {
    echo 'Camtel';
}


?>
```

Simple. But useful

    * Camtel numbers are tricky. Not sure. Feel feel free to send in a PR for that.
