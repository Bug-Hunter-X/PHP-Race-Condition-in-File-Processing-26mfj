# PHP Race Condition in File Processing

This repository demonstrates a race condition in a PHP function that processes files.  The `processFile()` function is not thread-safe, and concurrent requests can lead to files being processed multiple times.

The `bug.php` file shows the buggy code.  The `bugSolution.php` file provides a corrected version using file locking to prevent race conditions.

## Bug Description

The race condition occurs because the `$fileProcessed` flag is not updated atomically.  Multiple threads can read `false` simultaneously, leading to multiple executions of `processFile()` for the same file.

## Solution

The solution involves using file locking to ensure that only one thread can process a file at a time.  This prevents race conditions and ensures that files are processed only once.