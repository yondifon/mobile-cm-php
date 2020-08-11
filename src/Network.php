<?php

/**
 * @author Malico <hi@malico.me>
 *
 */
namespace Malico\MobileCM;

/**
 * Network
 */
class Network
{
    /**
     * Country Prefix
     */
    const PREFIX = '237';

    /**
     * Operator Prefixes
     */
    const OPERATOR_PREFIXES = [
        'mtn' => [67, 650, 651, 652,653,654],
        'orange' => [69, 655, 656, 657,658,659],
        'nexttel' => [66]
    ];

    /**
     * Check if phone is valid length
     *
     * @param  string|int $tel
     *
     * @return bool
     */
    protected static function validLength($tel) : bool
    {
        $len = strlen($tel);

        if ($len == 9 || $len  == 12 || $len = 13 || $len == 14) {
            return true;
        }

        return false;
    }

    /**
     * Match Tel to Prefix
     *
     * @param  string|int $tel
     * @param  string $key
     *
     * @return bool
     */
    protected static function checkNumber($tel, $key)
    {
        if (!self::validLength($tel)) {
            return false;
        }

        $operator_prefixESes = trim(
            join("|", self::OPERATOR_PREFIXES[$key]),
            "|"
        );
        
        $expression = "/^((\+|(0{2}))?". self::PREFIX . ")?((". $operator_prefixESes . ")([0-9]{6,7}))$/";

        return  preg_match($expression, $tel) ? true : false;
    }

    /**
     * Check if Number is Orange
     *
     * @param string | int  $tel
     *
     * @return  bool
     */
    public static function isOrange($tel) : bool
    {
        return self::checkNumber($tel, 'orange');
    }

    /**
     * Check if Number is MTN
     *
     * @param string | int  $tel
     *
     * @return  bool
     */
    public static function isMTN($tel) : bool
    {
        return self::checkNumber($tel, 'mtn');
    }

    /**
     * Check if Number is Nexttel
     *
     * @param string | int  $tel
     *
     * @return  bool
     */
    public static function isNexttel($tel) : bool
    {
        return self::checkNumber($tel, 'nexttel');
    }

    /**
     * Match Number to Operator
     *
     * @param string | int  $tel
     *
     * @return  bool
     */
    public static function check($tel)
    {
        foreach (self::OPERATOR_PREFIXES as $key => $value) {
            if (self::checkNumber($tel, $key)) {
                return $key;
            }
        }

        return null;
    }
}
