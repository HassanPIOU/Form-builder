<?php


namespace FormGenerate;


class Form implements FormInterface
{
     private  $required = false;


    public function __construct($required = false)
    {
        $this->required = $required;

    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

      private function check_required(bool $required){
          if ($required || $this->required){
             return   $required_string = "required";
          }
    }


    /**
     * @param $name
     * @param $label
     * @param array $options // Ex "id" => "your id here"
     * @param bool $required
     * @return string
     */
    public function input($name, $label, array $options = [], bool $required = false): string
    {
       $req =  $this->check_required($required);
        $input = <<<HTML

                            <div class="form-group">
                                <label for="{$name}">{$label}</label>
                                <input class="form-control" name="{$name}" type="text"  placeholder=""  {$req}>
                            </div>
HTML;

        return $input;
    }

    /**
     * @param $name
     * @param $label
     * @param array $options // Ex "id" => "your id here"
     * @param bool $required
     * @return string
     */
    public function textarea($name, $label, array $options = [], bool $required = false): string
    {
        $req =  $this->check_required($required);
        $input = <<<HTML
                            <div class="form-group">
                                <label for="{$name}">{$label}</label>
                                <textarea name="{$name}"  class="form-control"  {$req}></textarea>
                            </div>
HTML;

        return $input;
    }

    /**
     * @param $name
     * @param $label
     * @param array $options // Ex "id" => "your id here"
     * @param bool $required
     * @return string
     */
    public function file($name, $label, array $options = [], bool $required = false): string
    {
        $req =  $this->check_required($required);
        $input = <<<HTML
                            <div class="form-group">
                                <label for="{$name}">{$label}</label>
                                <input class="form-control" name="{$name}" type="file"  placeholder=""  {$req}>
                            </div>
HTML;

        return $input;
    }

    /**
     * @param $name
     * @param $label
     * @param array $options
     * @param bool $required
     * @return string
     */
    public function files($name, $label, array $options = [], bool $required = false): string
    {
        $req =  $this->check_required($required);
        $input = <<<HTML
                            <div class="form-group">
                                <label for="{$name}">{$label} <small>(multiple)</small></label>
                                <input class="form-control" name="{$name}" type="file" multiple  placeholder=""  {$req}>
                            </div>
HTML;

        return $input;
    }



    /**
     * @param $name
     * @param $label
     * @param array $options // Ex "id" => "your id here"
     * @param bool $required
     * @return string
     */
    public function picture($name, $label, array $options = [], bool $required = false): string
    {
        $req =  $this->check_required($required);
        $css = "<style>".file_get_contents(__DIR__.'/css/picture.css')."</style>";
        $js = "<script>".file_get_contents(__DIR__.'/js/picture.js')."</script>";
        $input = <<<HTML
        {$css}
              <label for="{$name}">{$label}</label>
                <label for="{$label}" class="filupp">
                  <span class="filupp-file-name js-value">Upload image</span>
                  <input type="file" class="fichierimage" name="{$name}" value="1" id="{$label}" {$req} onchange="filepicture(this.value)" />
                </label>
         {$js}            
HTML;

        return $input;
    }


    /**
     * @param $name
     * @param $label
     * @param array $options // Ex "id" => "your id here"
     * @param bool $required
     * @param array $selectOptions
     * @return string
     */
    public function select($name, $label, array $options = [], bool $required = false, array $selectOptions = []): string
    {
        $req =  $this->check_required($required);
 $select =
<<<HTML
<select name="{$name}"  class="form-control"  {$req}>
<option  disabled selected>{$label}</option> \n
HTML;
        $close = "\n</select>\n";
          return  $select.$this->makeOption($selectOptions).$close;
    }


    private function makeOption($attributes)
    {
        if (is_string($attributes)) {
            $new_attributes = array();
            foreach(explode(',', $attributes) as $randkey => $value) {
                if (strpos($value, ':')) {
                    list($name, $value) = explode(':', $value);
                    $new_attributes[$name] = $value;
                }
                elseif (trim($value) == true) {
                    $new_attributes[$randkey] = trim($value);
                }
            }
            $attributes = $new_attributes;
        }
        $arrangment = null;
        foreach ($attributes as $key => $names)
        {
            if (is_int($key)) {
                $key = 'value="' . $key . '"';
            }
            else {
                $key = 'value="' . $key . '"';
            }
            $new_name = $names;
            $selected = null;
            if (strpos($names, '|')) {
                $new_name = strstr($names, '|', true);
                $selected = ltrim(str_replace($new_name, '', $names), '|');
                $selected = ' '. $selected;
            }
            if ($arrangment != null) {
                $arrangment .= PHP_EOL;
            }
            $arrangment .= '<option ' . $key . $selected . '>' . $new_name .'</option>';
        }
        return $arrangment;
    }


    public function radio($name, $label, array $attr = [], bool $required = false): string
    {
        $req =  $this->check_required($required);
        $css = "<style>".file_get_contents(__DIR__.'/css/radio.css')."</style>";
        $input = <<<HTML
                      {$css}
                            <div class="form-group">
                                       <label class="f-radio" style='position: relative;left: 20px;top: -10px;'   >  {$label}
                                           <input type="radio" name="radio"   {$req}>
                                           <span class="circle" ></span>
                                         </label>
                            </div>
HTML;

        return $input;
    }

    public function checkbox($name, $label, array $attr = [], bool $required = false): string
    {
        $req =  $this->check_required($required);
        $css = "<style>".file_get_contents(__DIR__.'/css/checkbox.css')."</style>";
        $input = <<<HTML
                      {$css}
                          <div class="form-group">
                                 <input class="styled-checkbox" id="styled-checkbox-1" type="checkbox" {$req}>
                                     <label for="styled-checkbox-1">{$label}</label>
                            </div>
HTML;

        return $input;
    }

    public function range($name, $label, array $attr = [], bool $required = false): string
    {
        $req =  $this->check_required($required);
        $input = <<<HTML

                            <div class="form-group">
                                <label for="{$name}">{$label}</label>
                                <input class="form-control" name="{$name}" type="range"  placeholder=""  {$req}>
                            </div>
HTML;
        return $input;
    }

    public function password($name, $label, array $attr = [], bool $required = false): string
    {
        $req =  $this->check_required($required);
        $input = <<<HTML

                            <div class="form-group">
                                <label for="{$name}">{$label}</label>
                                <input class="form-control" name="{$name}" type="password"  placeholder=""  {$req}>
                            </div>
HTML;

        return $input;
    }

    public function hidden($name, array $attr = [], $value): string
    {
        $input = <<<HTML

                            <div class="form-group">
                                <input class="form-control" name="{$name}" type="hidden" value="{$value}" >
                            </div>
HTML;

        return $input;
    }

    public function date($name, $label, array $attr = [], bool $required = false): string
    {
        $req =  $this->check_required($required);
        $css = "<style>".file_get_contents(__DIR__.'/css/date.css')."</style>";
        $input = <<<HTML
                        {$css}
                            <div class="form-group">
                                <label for="{$name}">{$label}</label>
                                <input class="form-control date" name="{$name}" type="date"  placeholder=""  {$req}>
                            </div>
HTML;

        return $input;
    }

    public function submint($title, array $attr = []): string
    {
        $input = <<<HTML
     <button class="btn btn-primary">{$title}</button>
HTML;

        return $input;
    }
}