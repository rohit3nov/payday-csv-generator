<?php

namespace Lib;

class CSV
{
    private $file;
    private $handle;

    public function __construct(string $file, string $mode = 'r')
    {
        if (!is_string($file)) {
            throw new \InvalidArgumentException('Parameter $file must be a string. Provided type: ' . gettype($file));
        }
        if ($mode == 'w') {
            $this->setOutputHeaders();
        }
        if (is_file($file) && is_readable($file) || $mode == 'w') {
            $this->handle = fopen($file, $mode);
        } else {
            throw new \RuntimeException('The provided file could not be opened for reading. File: ' . $file);
        }
        $this->file = $file;
    }

    public function get($mode)
    {
        $value = fgetcsv($this->handle, $mode);

        if ($value === false) {
            throw new \RuntimeException('Encountered an error while reading from CSV file: ' . $this->file);
        }

        return $value;
    }

    public function getArray(): array
    {
        $array = [];
        while (($columns = fgetcsv($this->handle)) !== false) {
            $rows = count($columns);
            for ($i = 0; $i <= $rows; $i++) {
                $array[] = $columns[$i];
            }
        }
        return $array;
    }

    public function setHeader(array $header = [])
    {
        if (empty($header)) {
            throw new \RuntimeException('Invalid csv header');
        }
        $value = fputcsv($this->handle, $header);

        if ($value === false) {
            throw new \RuntimeException('Encountered an error while writing to CSV file: ' . $this->file);
        }
        return $value;
    }

    public function put(array $row = [])
    {
        if (empty($row)) {
            throw new \RuntimeException('Invalid row data');
        }
        $value = fputcsv($this->handle, $row);

        if ($value === false) {
            throw new \RuntimeException('Encountered an error while writing to CSV file: ' . $this->file);
        }
        return $value;
    }

    public function setOutputHeaders()
    {
        header('Content-Type: application/csv;charset=UTF-8;');
        header('Content-Disposition: attachment; filename=' . $this->file);
    }

    public function endFile()
    {
        return feof($this->handle);
    }

    public function close()
    {
        fclose($this->handle);
    }

    public function __destruct()
    {
        if (is_resource($this->handle)) {
            $this->close();
        }
    }
}
