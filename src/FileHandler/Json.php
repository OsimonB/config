<?php

namespace Noodlehaus\FileHandler;

use Noodlehaus\Exception\ParseException;
use Noodlehaus\Exception\WriteException;

/**
 * JSON file parser
 *
 * @package    Config
 * @author     Jesus A. Domingo <jesus.domingo@gmail.com>
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/noodlehaus/config
 * @license    MIT
 */
class Json implements FileHandlerInterface
{
    /**
     * {@inheritDoc}
     * Loads a JSON file as an array
     *
     * @throws ParseException If there is an error parsing the JSON file
     */
    public function parse($path)
    {
        $data = json_decode(file_get_contents($path), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $error_message  = 'Syntax error';
            if (function_exists('json_last_error_msg')) {
                $error_message = json_last_error_msg();
            }

            $error = array(
                'message' => $error_message,
                'type'    => json_last_error(),
                'file'    => $path,
            );
            throw new ParseException($error);
        }

        return $data;
    }

    /**
     * {@inheritDoc}
     * Writes the config array to a JSON file
     *
     * @throws WriteException If there is an error writing the JSON file
     */
    public function write($config, $path)
    {
        $output = json_encode($config, JSON_PRETTY_PRINT);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $error_message  = 'Syntax error';
            if (function_exists('json_last_error_msg')) {
                $error_message = json_last_error_msg();
            }

            $error = array(
                'message' => $error_message,
                'type'    => json_last_error(),
                'file'    => $path,
            );
            throw new WriteException($error);
        }

        file_put_contents($path, $output);
    }

    /**
     * {@inheritDoc}
     */
    public function canWrite()
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSupportedExtensions()
    {
        return array('json');
    }
}
