<?php

declare(strict_types=1);

namespace PhpStubs\WordPress\Core\Tests;

use function PHPStan\Testing\assertType;
use function wp_debug_backtrace_summary;

assertType('string', wp_debug_backtrace_summary());
assertType('string', wp_debug_backtrace_summary(null, 0, true));
assertType('list<string>', wp_debug_backtrace_summary(null, 0, false));
