<?php

namespace Noodlehaus\FileHandler;

use Noodlehaus\Exception\UnsupportedFormatException;

/**
 * Abstract file parser
 *
 * @package    Config
 * @author     Jesus A. Domingo <jesus.domingo@gmail.com>
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/noodlehaus/config
 * @license    MIT
 */
abstract class AbstractFileHandler implements FileHandlerInterface
{

    /**
     * Path to the config file
     *
     * @var string
     */
    protected $path;

    /**
     * Sets the path to the config file
     *
     * @param string $path
     *
     * @codeCoverageIgnore
     */
    public function __construct($path)
    {
        $this->path = $path;
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
}
