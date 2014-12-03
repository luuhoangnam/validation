<?php

namespace Nam\Validation;

use Illuminate\Validation\Factory;
use Illuminate\Validation\Validator;

/**
 * Trait ValidatableTrait
 *
 * @author  Nam Hoang Luu <nam@mbearvn.com>
 * @package Nam\Validation
 *
 */
trait ValidatableTrait
{
    /**
     * @var Factory
     */
    protected $validator;

    /**
     * @return Factory
     */
    public function getValidator()
    {
        if (! $this->validator instanceof Factory) {
            $this->validator = \App::make('validator');
        }

        return $this->validator;
    }

    /**
     * @param Factory $validator
     */
    public function setValidator($validator)
    {
        $this->validator = $validator;
    }

    /**
     * @var Validator
     */
    protected $validation;

    /**
     * Return Default Validation Rules
     *
     * @return array
     */
    public static function rules()
    {
        return [ ];
    }

    /**
     * @return array
     */
    public static function messages()
    {
        return [ ];
    }

    /**
     * @param mixed $data
     * @param array $rules
     * @param array $messages
     *
     * @throws ValidationException
     *
     * @return bool
     */
    public function validate($data, array $rules = [ ], array $messages = [ ])
    {
        $data = $this->normalize($data);
        $rules = array_merge(static::rules(), $rules);
        $messages = array_merge(static::messages(), $messages);

        $this->validation = $this->getValidator()->make($data, $rules, $messages);

        if ($this->validation->fails()) {
            throw new ValidationException('Validation Fails.', $this->validation->errors());
        }

        return true;
    }

    /**
     * @param $data
     *
     * @return array
     */
    private function normalize($data)
    {
        // If an object was provided, maybe the user
        // is giving us something like a DTO.
        // In that case, we'll grab the public properties
        // off of it, and use that.
        if (is_object($data)) {
            return get_object_vars($data);
        }

        // Otherwise, we'll just stick with what they provided.
        return $data;
    }
}