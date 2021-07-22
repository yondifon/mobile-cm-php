<?php

use Malico\MobileCM\Network;

test('test mtn numbers', function () {
    $numbers = ['676777777', '237676777777', '676 77 77 77', '+237676777777', '00237676777777'];

    expect($numbers)->each(
        fn ($number) => expect(Network::isMTN($number->value))
                            ->toBe(true)
    );
});

test('test orange numbers', function () {
    $numbers = ['699238282', '237699238282', '+237699238282', '00237699238282'];

    expect($numbers)->each(
        fn ($number) => expect(Network::isOrange($number->value))
                            ->toBe(true)
    );
});

test('test nexttel numbers', function () {
    $numbers = ['666768293', '237666768293', '+237666768293', '00237666768293'];

    expect($numbers)->each(
        fn ($number) => expect(Network::isNexttel($number->value))
                            ->toBe(true)
    );
});

test('test camtel numbers', function () {
    $numbers = ['2 33 47 99 73', '2 22 47 99 73'];

    expect($numbers)->each(
        fn ($number) => expect(Network::isCamtel($number->value))
                            ->toBe(true)
    );
});
