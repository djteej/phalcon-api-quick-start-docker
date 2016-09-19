<?php
class AppValidation extends Phalcon\Validation
{
    public function initialize()
    {
        $this->add(
            'id',
            new Phalcon\Validation\Validator\Regex([
                'pattern' => '/^[0-9a-f]{13}$/i',
                'message' => 'id must be a valid 13 character hexadecimal number',
            ])
        );
        $this->add(
            'name',
            new Phalcon\Validation\Validator\PresenceOf([
                'message' => 'Please provide an application name',
            ])
        );
        $this->add(
            'key',
            new Phalcon\Validation\Validator\Regex([
                'pattern' => '/^[0-9a-f]{64}$/i',
                'message' => 'key must be a valid 64 character hexadecimal number',
            ])
        );
        $this->add(
            'secret',
            new Phalcon\Validation\Validator\Regex([
                'pattern' => '/^[0-9a-f]{64}$/i',
                'message' => 'secret must be a valid 64 character hexadecimal number',
            ])
        );
        $this->add(
            'created',
            new Phalcon\Validation\Validator\Regex([
                'pattern' => '/^[0-9]{10}$/i',
                'message' => 'created must be a valid unix timestamp',
            ])
        );
        $this->add(
            'updated',
            new Phalcon\Validation\Validator\Regex([
                'pattern' => '/^[0-9]{10}$/i',
                'message' => 'updated must be a valid unix timestamp',
                "allowEmpty" => true,
            ])
        );
    }
}
