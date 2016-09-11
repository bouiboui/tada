<?php


namespace bouiboui\Tada\Nulls;


use bouiboui\Tada\Interfaces\Exporter;
use bouiboui\Tada\Models\Todo;

class NullExporter implements Exporter
{
    public function export(Todo $todo)
    {
    }
}