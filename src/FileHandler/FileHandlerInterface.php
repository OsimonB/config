<?php

namespace Noodlehaus\FileHandler;

/**
 * Config file parser interface
 *
 * @package    Config
 * @author     Jesus A. Domingo <jesus.domingo@gmail.com>
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/noodlehaus/config
 * @license    MIT
 */
interface FileHandlerInterface
{
    /**
     * Parses a file from `$path` and gets its contents as an array
     *
     * @param  string $path
     *
     * @return array
     */
    public function parse($path);

    /**
     * Writes the config array to `$path`
     *
     * @param  array $config
     * @param  string $path
     */
    public function write($config, $path);

    /**
     * Returns whether or not the file handler supports writing
     * 
     * @return boolean
     */
    public function canWrite();

    /**
     * Returns an array of allowed file extensions for this parser
     *
     * @return array
     */
    public static function getSupportedExtensions();
}
