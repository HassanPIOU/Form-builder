<?php


namespace FormGenerate;


interface FormInterface
{
    /**
     * @param $name
     * @param $label
     * @param array $attr
     * @param bool $required
     * @return string
     */
    public function input($name, $label, array $attr = [], bool $required = false): string ;

    /**
     * @param $name
     * @param $label
     * @param array $attr
     * @param bool $required
     * @return string
     */
    public function textarea($name, $label, array $attr = [] , bool $required = false): string ;

    /**
     * @param $name
     * @param $label
     * @param array $attr
     * @param bool $required
     * @return string
     */
    public function file($name, $label, array $attr = [] , bool $required = false): string ;

    /**
     * @param $name
     * @param $label
     * @param array $attr
     * @param bool $required
     * @return string
     */
    public function files($name, $label, array $attr = [] , bool $required = false): string ;

    /**
     * @param $name
     * @param $label
     * @param array $attr
     * @param bool $required
     * @return string
     */
    public function picture($name, $label, array $attr = [] , bool $required = false): string ;

    /**
     * @param $name
     * @param $label
     * @param array $attr
     * @param bool $required
     * @param array $selectOptions
     * @return string
     */
    public function select($name, $label, array $attr = [] , bool $required = false,array $selectOptions = []) ;


    public function radio($name, $label, array $attr = [] , bool $required = false): string ;


    public function checkbox($name, $label, array $attr = [] , bool $required = false): string ;


    public function range($name, $label, array $attr = [] , bool $required = false): string ;


    public function password($name, $label, array $attr = [] , bool $required = false): string ;


    public function hidden($name, array $attr = [], $value): string ;



    public function date($name, $label, array $attr = [] , bool $required = false): string ;


    public function submint($title, array $attr = []): string ;


}