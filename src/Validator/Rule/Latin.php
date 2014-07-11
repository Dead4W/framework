<?php
/**
 * Bluz Framework Component
 *
 * @copyright Bluz PHP Team
 * @link https://github.com/bluzphp/framework
 */

/**
 * @namespace
 */
namespace Bluz\Validator\Rule;

/**
 * Class String
 * @package Bluz\Validator\Rule
 */
class Latin extends AbstractFilterRule
{
    /**
     * @param mixed $input
     * @return bool
     */
    public function validateClean($input)
    {
        return (bool) preg_match('/^[a-z]+$/i', $input);
    }

    /**
     * Get error template
     *
     * @return string
     */
    public function getTemplate()
    {
        if (empty($this->additionalChars)) {
            return __('{{name}} must contain only Latin letters');
        } else {
            return __('{{name}} must contain only Latin letters and "%s"', $this->additionalChars);
        }
    }
}
