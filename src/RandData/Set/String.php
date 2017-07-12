<?php

namespace RandData\Set;

/**
 * Random string generator
 */
class String extends \RandData\Set
{
    const LENGTH_MIN_MIN = 0;
    const LENGTH_MIN_MAX = 16777216;
    const LENGTH_MAX_MIN = 1;
    const LENGTH_MAX_MAX = 16777216;
    
    const CHARS_LAT_U = "ABCDEFGHIKLMNOPRSTUVWXYZ";
    const CHARS_LAT_L = "abcdefghijklmnoprstuvwxyz";
    const CHARS_DIGITS = "0123456789";
    const CHARS_PUNCTUATION = ".,!?();:";
    const CHARS_OTH = "@#$%^&*+-/";
    
    /**
     * Minimum string length
     * @var integer
     */
    protected $lengthMin;
    
    /**
     * Maximum string length
     * @var integer
     */
    protected $lengthMax;
    
    /**
     * Available chars
     * @var string
     */
    protected $chars;
    
    /**
     * Class constructor
     * @param integer $lengthMin Minimum string length
     * @param integer $lengthMax Maximum string length
     */
    public function __construct($lengthMin = 1, $lengthMax = 10)
    {
        $this->setLengthMin($lengthMin);
        $this->setLengthMax($lengthMax);
        $this->chars = self::CHARS_LAT_U . self::CHARS_LAT_L . self::CHARS_DIGITS;
    }
    
    /**
     * Returns maximum string length
     * @return integer Maximum string length
     */
    public function getLengthMax()
    {
        return $this->lengthMax;
    }

    /**
     * Returns available chars
     * @return string Available chars
     */
    public function getChars()
    {
        return $this->chars;
    }

    /**
     * Sets maximum string length
     * @param integer $length Maximum string length
     */
    public function setLengthMax($length)
    {
        if (!$length) {
            $length = self::LENGTH_MAX_MAX;
        }
        
        $this->lengthMax = \RandData\Checker::int(
            $length,
            self::LENGTH_MAX_MIN,
            self::LENGTH_MAX_MAX,
            "lengthMax"
        );
    }

    /**
     * Returns minimum string length
     * @return string Minimum string length
     */
    public function getLengthMin()
    {
        return $this->lengthMin;
    }

    /**
     * Sets minimum string length
     * @param integer $lengthMin Minimum string length
     */
    public function setLengthMin($lengthMin)
    {
        $this->lengthMin = \RandData\Checker::int(
            $lengthMin,
            self::LENGTH_MIN_MIN,
            self::LENGTH_MIN_MAX,
            "lengthMin"
        );
    }

    /**
     * Add chars to the available char list
     * @param string $chars Addition to available char list
     */
    public function addChars($chars)
    {
        $this->chars .= (string) $chars;
    }
    
    /**
     * Sets available char list
     * @param string $chars Available char list
     */
    public function setChars($chars)
    {
        $this->chars = (string) $chars;
    }

    /**
     * @inherit
     */
    public function get()
    {
        $ret = "";
        $variant = $this->getChars();
        $variantLen = mb_strlen($this->getChars());
        
        $length = $this->generateLength();
        
        for ($i = 1; $i <= $length; $i++) {
            $ret .= mb_substr($variant, mt_rand(0, $variantLen - 1), 1);
        }
        
        return $ret;
    }
    
    /**
     * Returns length of the string between minimum and maximum
     * @return string String length
     */
    protected function generateLength()
    {
        $lengthMin = $this->getLengthMin();
        $lengthMax = $this->getLengthMax();

        if ($lengthMin > $lengthMax) {
            $buffer = $lengthMin;
            $lengthMin = $lengthMax;
            $lengthMax = $buffer;
        }
        
        if ($lengthMin < 1) {
            $lengthMin = 1;
        }
        
        if ($lengthMax > 100) {
            $lengthMax = 100;
        }

        return mt_rand($lengthMin, $lengthMax);
    }

    /**
     * @inherit
     */
    public function init($params = [])
    {
        if (!empty($params["length_min"])) {
            $this->setLengthMin($params["length_min"]);
        }

        if (!empty($params["length_max"])) {
            $this->setLengthMax($params["length_max"]);
        }

        if (!empty($params["char_list"])) {
            $this->setChars($params["char_list"]);
        }
    }
}
