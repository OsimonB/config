<?php

namespace Noodlehaus\FileHandler;

use Noodlehaus\Exception\ParseException;

/**
 * XML file parser
 *
 * @package    Config
 * @author     Jesus A. Domingo <jesus.domingo@gmail.com>
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/noodlehaus/config
 * @license    MIT
 */
class Xml implements FileHandlerInterface
{
    /**
     * {@inheritDoc}
     * Parses an XML file as an array
     *
     * @throws ParseException If there is an error parsing the XML file
     */
    public function parse($path)
    {
        libxml_use_internal_errors(true);

        $data = simplexml_load_file($path, null, LIBXML_NOERROR);

        if ($data === false) {
            $errors      = libxml_get_errors();
            $latestError = array_pop($errors);
            $error       = array(
                'message' => $latestError->message,
                'type'    => $latestError->level,
                'code'    => $latestError->code,
                'file'    => $latestError->file,
                'line'    => $latestError->line,
            );
            throw new ParseException($error);
        }

        $data = json_decode(json_encode($data), true);

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
        throw new UnsupportedFormatException('File handler does not support writing');
    }

    /**
     * {@inheritDoc}
     */
    public function canWrite()
    {
        return false;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSupportedExtensions()
    {
        return array('xml');
    }
}
