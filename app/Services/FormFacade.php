<?php

namespace App\Services;

use Spatie\Html\Elements\Form;
use Spatie\Html\Html;
// use Spatie\Html\Facades\Html;

class FormFacade
{
    public static function button($value, $params = [])
    {
        $html = html()->button($value);
        $html = self::setAttributes($html, $params);
        return $html;
    }

    public static function checkbox($name, $value = '1', $checked = false, $params = [])
    {
        $html = html()->checkbox($name, $checked, $value);
        $html = self::setAttributes($html, $params);
        return $html;
    }

    public static function close()
    {
        return html()->form()->close();
    }

    public static function email($name, $value = null, $params = [])
    {
        $html = html()->email($name, $value);
        $html = self::setAttributes($html, $params);
        return $html;
    }

    public static function hidden($name,  $value, $params = [])
    {
        $html = html()->hidden($name, $value);
        $html = self::setAttributes($html, $params);
        return $html;
    }

    public static function label($for,  $content, $params = [])
    {
        $html = html()->label($content, $for);
        $html = self::setAttributes($html, $params);
        return $html;
    }

    public static function open($params = [])
    {
        $method = array_key_exists('method', $params) ? $params['method'] : 'POST';
        $route = array_key_exists('route', $params) ? $params['route'] : null;
        $url = array_key_exists('url', $params) ? $params['url'] : null;

        $html = html()->form($method, $url);

        if ($route) {
            $html = $html->route($route);
        }

        $html = self::setAttributes($html, $params);
        return $html->open();
    }

    public static function password($name, $params = [])
    {
        $html = html()->password($name);
        $html = self::setAttributes($html, $params);
        return $html;
    }

    public static function radio($name, $value, $checked, $params = [])
    {
        $html = html()->radio($name, $checked, $value);
        $html = self::setAttributes($html, $params);
        return $html;
    }

    public static function select($name, $options, $value, $params = [])
    {
        $html = html()->select($name, $options, $value);
        $html = self::setAttributes($html, $params);
        return $html;
    }

    public static function submit($value, $params = [])
    {
        $html = html()->button($value, 'submit');
        $html = self::setAttributes($html, $params);
        return $html;
    }

    public static function text($name, $value = null, $params = [])
    {
        $html = html()->text($name, $value);
        $html = self::setAttributes($html, $params);
        return $html;
    }


    public static function textarea($name, $value = null, $params = [])
    {
        $html = html()->textarea($name, $value);
        $html = self::setAttributes($html, $params);
        return $html;
    }

    private static function setAttributes($html, $params = [])
    {
        $class = array_key_exists('class', $params) ? $params['class'] : null;
        $disabled = array_key_exists('disabled', $params) ? $params['disabled'] : null;
        $id = array_key_exists('id', $params) ? $params['id'] : null;
        $name = array_key_exists('name', $params) ? $params['name'] : null;
        $onblur = array_key_exists('onblur', $params) ? $params['onblur'] : null;
        $onclick = array_key_exists('onclick', $params) ? $params['onclick'] : '';
        $onkeydown = array_key_exists('onkeydown', $params) ? $params['onkeydown'] : null;
        $onkeyup = array_key_exists('onkeyup', $params) ? $params['onkeyup'] : null;
        $onsubmit = array_key_exists('onsubmit', $params) ? $params['onsubmit'] : null;
        $required = in_array('required', $params);

        if ($class) {
           $html = $html->class($class);
        }

        if ($disabled) {
            $html = $html->disabled();
        }

        if ($id) {
            $html = $html->id($id);
        }

        $attributes = [];
        if ($name) {
            $attributes['name'] = $name;
        }
        if ($onblur) {
            $attributes['onblur'] = $onblur;
        }
        if ($onclick) {
            $html = $html->attribute('onclick', $onclick);
        }
        if ($onkeydown) {
            $attributes['onkeydown'] = $onkeydown;
        }
        if ($onkeyup) {
            $attributes['onkeyup'] = $onkeyup;
        }
        if ($onsubmit) {
            $attributes['onsubmit'] = $onsubmit;
        }

        if (!empty($attributes)) {
            $html = $html->attributes($attributes);
        }

        if ($required) {
            $html = $html->required();
        }

        return $html;
    }

}
