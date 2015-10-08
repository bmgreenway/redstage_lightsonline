<?php
/**
 * This file was generated by the ConvertToLegacy class in bronto-legacy.
 * The purpose of the conversion was to maintain PSR-0 compliance while
 * the main development focuses on modern styles found in PSR-4.
 *
 * For the original:
 * @see src/Bronto/Functional/Option.php
 */

/**
 * Container type that implements Bronto_Functional_Monadic operations
 *
 * @author Philip Cali <philip.cali@bronto.com>
 */
abstract class Bronto_Functional_Option implements Bronto_Functional_Monadic
{
    /**
     * Whether or not the container contains a value
     *
     * @return boolean
     */
    public abstract function isDefined();

    /**
     * Retrieves the contained value
     *
     * @return mixed
     */
    public abstract function get();

    /**
     * Whether or not the container is empty
     *
     * @return boolean
     */
    public function isEmpty()
    {
        return !$this->isDefined();
    }

    /**
     * @see parent
     * @param callable $function
     * @return Bronto_Functional_Monadic
     */
    public function each($function)
    {
        if ($this->isDefined()) {
            call_user_func($function, $this->get());
        }
        return $this;
    }

    /**
     * @see parent
     * @param callable $function
     * @return Bronto_Functional_Monadic
     */
    public function filter($function)
    {
        if ($this->isDefined() && call_user_func($function, $this->get())) {
            return $this;
        }
        return new Bronto_Functional_None();
    }

    /**
     * @see parent
     * @param callable $function
     * @return Bronto_Functional_Monadic
     */
    public function map($function)
    {
        if ($this->isDefined()) {
            return new Bronto_Functional_Some(call_user_func($function, $this->get()));
        }
        return $this;
    }

    /**
     * Gets the contained value or a defined default
     *
     * @param mixed $default
     * @return mixed
     */
    public function getOrElse($default)
    {
        if ($this->isDefined()) {
            return $this->get();
        }
        return $default;
    }

    /**
     * Convert this potentially empty container into a full container
     *
     * @param callable $function
     * @return Bronto_Functional_Some
     */
    public function orElse($function)
    {
        if ($this->isEmpty()) {
            return new Bronto_Functional_Some(call_user_func($function));
        }
        return $this;
    }
}
