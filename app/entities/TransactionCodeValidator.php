<?php
// Class to verify customer code of bank transaction
class TransactionCodeValidator
{
    public static function verifyKey(string $key): bool
    {
        if (strlen($key) != 10) {
            return false;
        }
        $checkDigit = self::genereateCheckCharacter(substr(strtoupper($key), 0,
                    9));
        return $key[9] == $checkDigit;
    }

    // Implementation of algorithm for check digit
    public static function genereateCheckCharacter(string $input): string
    {
        $validChars = array(
            '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B',
            'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R',
            'S',
            'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
        );
        $factor     = 2;
        $sum        = 0;
        $n          = sizeof($validChars);

        // Starting from the right and working leftwards is easier since the initial "factor" will always be "2"
        for ($i = strlen($input) - 1; $i >= 0; $i--) {
            $codePoint = array_search($input[$i], $validChars);
            $addend    = $factor * $codePoint;
            $factor    = ($factor == 2) ? 1 : 2;
            $addend    = ($addend / $n) + ($addend % $n); // Sum the digits of the "addend" as expressed in base "n"
            $sum       = (int) $sum + $addend;
        }

        // Calculate the number that must be added to the "sum" to make it divisible by "n"
        $remainder      = (int) $sum % $n;
        $checkCodePoint = (int) (($n - $remainder) % $n);
        return $validChars[$checkCodePoint];
    }
}