<?php

namespace Tests\Feature\Custom\Rule;

use Illuminate\Support\Facades\Validator;
use Orchestra\Testbench\TestCase;

class StripTagsTest extends TestCase
{
    public function test_it_allows_configured_tags()
    {
        $rules = chainRule()->stripTags(['b', 'i'])->toArray();

        $validator = Validator::make(
            ['comment' => '<b>Bold</b> and <i>italic</i>'],
            ['comment' => $rules]
        );

        $this->assertTrue($validator->passes(), 'Allowed tags should be accepted');
    }

    public function test_it_rejects_disallowed_tags()
    {
        $rules = chainRule()->stripTags(['b', 'i'])->toArray();

        $validator = Validator::make(
            ['comment' => '<u>Underlined</u>'],
            ['comment' => $rules]
        );

        $this->assertTrue($validator->fails(), 'Disallowed tags should be rejected');
    }

    public function test_it_rejects_script_tags()
    {
        $rules = chainRule()->stripTags(['b', 'i'])->toArray();

        $validator = Validator::make(
            ['comment' => '<script>alert("xss")</script>'],
            ['comment' => $rules]
        );

        $this->assertTrue($validator->fails(), 'Script tags should always be rejected');
    }

    public function test_plain_text_passes()
    {
        $rules = chainRule()->stripTags(['b', 'i'])->toArray();

        $validator = Validator::make(
            ['comment' => 'Just plain text'],
            ['comment' => $rules]
        );

        $this->assertTrue($validator->passes(), 'Plain text with no HTML should pass');
    }

    public function test_non_string_values_are_ignored()
    {
        $rules = chainRule()->stripTags(['b', 'i'])->toArray();

        $validator = Validator::make(
            ['comment' => 12345],
            ['comment' => $rules]
        );

        $this->assertTrue($validator->passes(), 'Non-string values should be ignored');
    }
}
