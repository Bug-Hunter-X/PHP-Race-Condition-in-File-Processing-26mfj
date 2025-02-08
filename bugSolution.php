This solution uses file locking to prevent race conditions:

```php
<?php

function processFile($filename) {
    $lockFile = $filename . '.lock';
    if (flock(fopen($lockFile, 'w'), LOCK_EX)) {
        // ... some file processing logic ...
        flock(fopen($lockFile, 'w'), LOCK_UN);
        unlink($lockFile);
    } else {
        echo "Could not acquire lock for $filename\n";
    }
}

function handleRequest() {
    processFile('myfile.txt');
}

?>
```

This ensures that only one process can acquire the lock and process the file at a time.  The `flock()` function provides atomic locking.