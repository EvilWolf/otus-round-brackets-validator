<?php
namespace EvilWolf;

class RoundBracketsValidator {
    protected $data;

    public function __construct(string $data)
    {
        $this->data = $data;
    }

    public function isValid(): bool
    {
        return $this->validateLength() && $this->validateBracketsCount() && $this->validateBrackets();
    }

    public function validateLength()
    {
        return !empty($this->data);
    }

    public function validateBracketsCount()
    {
        return (substr_count($this->data, '(') === substr_count($this->data, ')'));
    }

    public function validateBrackets()
    {
        $state = 0;
        foreach (str_split($this->data) as $char) {
            if (!in_array($char, ['(', ')'])) {
                return false;
            }

            if ($char === '(') {
                $state++;
            }

            if ($char === ')') {
                $state--;
            }
        }

        return $state === 0;
    }
}
