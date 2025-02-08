This code suffers from a potential race condition.  If `processFile()` takes a significant amount of time, and multiple requests come in concurrently, the `$fileProcessed` flag might not be updated atomically, leading to files being processed multiple times.

```php
<?php

function processFile($filename) {
    // ... some file processing logic ...
    $fileProcessed = true; // Race condition here!
}

function handleRequest() {
    global $fileProcessed;
    if (!$fileProcessed) {
        $fileProcessed = false; // Attempt to set flag before processing
        processFile('myfile.txt');
    }
}

// Multiple requests might call handleRequest concurrently
?>
```