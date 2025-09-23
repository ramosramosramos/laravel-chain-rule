<?php

namespace Tests\Feature\Custom\Rule;

use Illuminate\Support\Facades\Validator;
use Orchestra\Testbench\TestCase;

class SanitizeXssTest extends TestCase
{
    public function test_it_allows_safe_tags()
    {
        $rules = chainRule()->sanitizeXss(['b', 'i', 'u', 'p'])->toArray();

        $validator = Validator::make(
            ['comment' => '<p>Hello <b>World</b></p>'],
            ['comment' => $rules]
        );

        $this->assertTrue($validator->passes(), 'Safe tags should be allowed');
    }

    public function test_it_rejects_disallowed_tags()
    {
        $rules = chainRule()->sanitizeXss(['b', 'i'])->toArray();

        $validator = Validator::make(
            ['comment' => '<script>alert("xss")</script>'],
            ['comment' => $rules]
        );

        $this->assertTrue($validator->fails(), 'Script tags should be rejected');
    }

    public function test_it_rejects_event_attributes()
    {
        $rules = chainRule()->sanitizeXss(['a'])->toArray();

        $validator = Validator::make(
            ['comment' => '<a href="#" onclick="alert(1)">Click</a>'],
            ['comment' => $rules]
        );

        $this->assertTrue($validator->fails(), 'Event attributes like onclick should be rejected');
    }

    public function test_it_rejects_javascript_uri()
    {
        $rules = chainRule()->sanitizeXss(['a'])->toArray();

        $validator = Validator::make(
            ['comment' => '<a href="javascript:alert(1)">Bad link</a>'],
            ['comment' => $rules]
        );

        $this->assertTrue($validator->fails(), 'javascript: URLs should be rejected');
    }

    public function test_plain_text_passes()
    {
        $rules = chainRule()->sanitizeXss(['b', 'i'])->toArray();

        $validator = Validator::make(
            ['comment' => 'Just plain text with no HTML'],
            ['comment' => $rules]
        );

        $this->assertTrue($validator->passes(), 'Plain text should always pass');
    }
}
