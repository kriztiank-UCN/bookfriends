<?php

// tests/Pest.php
uses(Tests\TestCase::class)->in('Feature');
 
// tests/Feature/ExampleTest.php
it('has home', function () {
    echo get_class($this); // \Tests\TestCase
});