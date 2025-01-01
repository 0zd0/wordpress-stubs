<?php

declare(strict_types=1);

namespace PhpStubs\WordPress\Core\Tests;

use function is_wp_error;
use function PHPStan\Testing\assertType;

use WP_Error;

assertType('false', is_wp_error(Faker::string()));
assertType('true', is_wp_error(new WP_Error()));
assertType('bool', is_wp_error(Faker::mixed()));

$mixed = Faker::mixed();
if (is_wp_error($mixed)) {
    assertType('WP_Error', $mixed);
}
