<?php


namespace bouiboui\Tada\Interfaces;

use bouiboui\Tada\Models\Todo;

/**
 * Implement this interface to export todos to a third-party service
 *
 * @package bouiboui\Tada\Interfaces
 */
interface Exporter
{
    public function export(Todo $todo);
}