<?php


namespace bouiboui\Tada\Nulls;


use bouiboui\Tada\Interfaces\ExporterInterface;
use bouiboui\Tada\Models\Todo;

class NullExporter implements ExporterInterface
{
    public function export(Todo $todo)
    {
    }
}
