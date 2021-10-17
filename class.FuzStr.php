<?php

class FuzStr
{

    protected $str = '';
    protected $arr = array();
    protected $mng = 3;
    protected $per = false;


    /**
     * Call this function to set up options each new lookup (after instantiating the class FuzStr)
     */

    public function init(
        string $search,
        array $subject,
        int $maxNgram = 3,
        bool $percent = false
    ) {
        $this->str = $search;
        $this->arr = $subject;
        $this->mng = $maxNgram;
        $this->per = $percent;
    }


    /** Called this function after "init" function
     * 
     * @return integer if $percent is false, and in percent value if $percent is True
     * The minimum value is zero. 
     * If it returns 0, then the string $search is completely present in the glued
     * array $subject. The smaller the return value, the more $search is in the $subject array. 
     * The maximum return value is given by the function 
     * $this->fuzzyCompare($this->str, explode ('', $this->str));
     *  */

    public function fuzzy()
    {
        $f1 = $this->fuzzyCompare($this->str, explode(' ', $this->str));
        $f2 = $this->fuzzyCompare($this->str, $this->arr);

        if ($this->per)
            return 100 * $f2 / ($f1 + 1);
        else
            return $f1 - $f2;
    }


    public function Ngrams($word, $n = 3)
    {
        $len = mb_strlen($word);
        $ngram = array();
        $s = preg_split('//u', $word, -1, PREG_SPLIT_NO_EMPTY);

        for ($i = 0; $i + $n <= $len; $i++) {
            $string = "";
            for ($j = 0; $j < $n; $j++) {
                $string .= $s[$j + $i];
            }
            $ngram[$i] = $string;
        }

        return $ngram;
    }


    function countCommon($a1, $a2)
    {
        $r = 0;

        foreach ($a1 as $value1)
            foreach ($a2 as $value2)
                if ($value1 == $value2) $r++;

        return $r;
    }


    function countCommonNGram($s1, $s2)
    {
        $r = 0;

        for ($i = 1; $i <= $this->mng; $i++) {
            $r += $i * $this->countCommon($this->NGrams($s1, $i), $this->NGrams($s2, $i));
        }

        return $r;
    }


    function countStr($str, $a)
    {
        $max = 0;

        foreach ($a as $value) {
            $c = $this->countCommonNGram($str, $value);
            if ($c > $max) $max = $c;
        }

        return $max;
    }


    function fuzzyCompare($str1, $str2)
    {
        $sstr1 = explode(' ', $str1);
        $c = 0;

        foreach ($sstr1 as $value) {
            $c += $this->countStr($value, $str2);
        }

        return $c;
    }
}
