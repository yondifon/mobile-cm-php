<?php

/**
 * @author Malico <hi@malico.me>
 */

namespace Malico\MobileCM;

/**
 * Network.
 */
class Network
{
    /**
     * Country Prefix.
     */
    const PREFIX = '237';

    /**
     * Operator Prefixes.
     */
    const OPERATOR_PREFIXES = [
        'mtn' => [
            67, 650, 651, 652, 653, 654, 680, 681, 682, 683,
        ],
        'orange' => [
            69, 655, 656, 657, 658, 659,
        ],
        'nexttel' => [
            66,
        ],
        'camtel' => [
            '233', '222', '242', '243',
        ],
    ];

    /**
     * Check if phone is valid length.
     *
     * @param string|int $tel
     *
     * @return bool
     */
    protected static function validLength($tel): bool
    {
        $len = strlen($tel);

        if ($len == 9 || $len == 12 || $len = 13 || $len == 14) {
            return true;
        }

        return false;
    }

    /**
     * Match Tel to Prefix.
     *
     * @param string|int $tel
     * @param string $key
     *
     * @return bool
     */
    protected static function checkNumber(string $tel, $key)
    {
        $tel = \str_replace(' ', '', (string) $tel);

        if (! self::validLength($tel)) {
            return false;
        }

        $operator_prefixes = trim(
            implode('|', self::OPERATOR_PREFIXES[$key]),
            '|'
        );

        $expression = "/^((\+|(0{2}))?" . self::PREFIX . ')?((' . $operator_prefixes . ')([0-9]{6,7}))$/';

        return  preg_match($expression, $tel) ? true : false;
    }

    /**
     * Check if Number is Orange.
     *
     * @param string   $tel
     *
     * @return  bool
     */
    public static function isOrange(string $tel): bool
    {
        return self::checkNumber($tel, 'orange');
    }

    /**
     * Check if Number is MTN.
     *
     * @param string   $tel
     *
     * @return  bool
     */
    public static function isMTN(string $tel): bool
    {
        return self::checkNumber($tel, 'mtn');
    }

    /**
     * Check if Number is Nexttel.
     *
     * @param string   $tel
     *
     * @return bool
     */
    public static function isNexttel(string $tel): bool
    {
        return self::checkNumber($tel, 'nexttel');
    }

    /**
     * Check if Number is Camtel.
     *
     * @param   string   $tel
     *
     * @return  bool
     */
    public static function isCamtel(string $tel): bool
    {
        return self::checkNumber($tel, 'camtel');
    }

    /**
     * Match Number to Operator.
     *
     * @param string   $tel
     *
     * @return bool
     */
    public static function check($tel): string
    {
        foreach (self::OPERATOR_PREFIXES as $key => $value) {
            if (self::checkNumber($tel, $key)) {
                return $key;
            }
        }

        return null;
    }
}
