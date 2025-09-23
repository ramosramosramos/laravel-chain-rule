<?php

declare(strict_types=1);

namespace KentJerone\ChainRule\Concerns;

trait HasParameterRule
{
    use HasAddRule;

    /**
     * @var string[]
     */
    protected array $rules = [];

    public function after(string $date): self
    {
        return $this->addRule('after:'.$date);
    }

    public function afterOrEqual(string $date): self
    {
        return $this->addRule('after_or_equal:'.$date);
    }

    public function between(int $min, int $max): self
    {
        return $this->addRule('between:'.$min.','.$max);
    }

    public function before(string $date): self
    {

        return $this->addRule('before:'.$date);
    }

    public function currentPassword(string $password): self
    {

        return $this->addRule('current_password:'.$password);
    }

    public function endsWith(string $value): self
    {

        return $this->addRule('ends_with:'.$value);
    }

    /**
     * @param  array<string, mixed>  $options
     */
    public function dimensions(array $options): self
    {

        return $this->addRule('dimensions:'.implode(',', $options));
    }

    public function dateFormat(string $format): self
    {

        return $this->addRule('date_format:'.$format);
    }

    public function dateEquals(string $date): self
    {

        return $this->addRule('date_equals:'.$date);
    }

    public function decimal(int $min, int $max): self
    {

        return $this->addRule('decimal:'.$min.','.$max);
    }

    public function declinedIf(string $otherField, string $value): self
    {

        return $this->addRule('declined_if:'.$otherField.','.$value);
    }

    public function different(string $field): self
    {

        return $this->addRule('different:'.$field);
    }

    public function digits(int $value): self
    {

        return $this->addRule('digits:'.$value);
    }

    public function digitsBetween(int $min, int $max): self
    {

        return $this->addRule('digits_between:'.$min.','.$max);
    }

    public function doesntEndWith(string $value): self
    {

        return $this->addRule('doesnt_end_with:'.$value);
    }

    public function doesntStartWith(string $value): self
    {

        return $this->addRule('doesnt_start_with:'.$value);
    }

    public function greaterThan(string $field): self
    {

        return $this->addRule('gt:'.$field);
    }

    public function greaterThanOrEqual(string $field): self
    {

        return $this->addRule('gte:'.$field);
    }

    /**
     * @param  array<string, mixed>  $values
     */
    public function in(array $values): self
    {

        return $this->addRule('in:'.implode(',', $values));
    }

    public function inArray(string $otherField): self
    {

        return $this->addRule('in_array:'.$otherField.'.*');
    }

    public function lessThan(string $field): self
    {

        return $this->addRule('lt:'.$field);
    }

    public function lessThanOrEqual(string $field): self
    {

        return $this->addRule('lte:'.$field);
    }

    public function max(int $value): self
    {

        return $this->addRule('max:'.$value);
    }

    public function maxDigits(int $value): self
    {

        return $this->addRule('max_digits:'.$value);
    }

    /**
     * @param  string[]  $value
     */
    public function mimes(array $value): self
    {

        return $this->addRule('mimes:'.implode(',', $value));
    }

    /**
     * @param  string[]  $value
     */
    public function mimeTypes(array $value): self
    {

        return $this->addRule('mimetypes:'.implode(',', $value));
    }

    public function minDigits(int $value): self
    {

        return $this->addRule('min_digits:'.$value);
    }

    public function multipleOf(int $value): self
    {

        return $this->addRule('multiple_of:'.$value);
    }

    public function min(int $value): self
    {

        return $this->addRule('min:'.$value);
    }

    /**
     * @param  array<string, mixed>  $values
     */
    public function notIn(array $values): self
    {

        return $this->addRule('not_in:'.implode(',', $values));
    }

    public function notRegex(string $pattern): self
    {

        return $this->addRule('not_regex:'.$pattern);
    }

    public function regex(string $pattern): self
    {

        return $this->addRule('regex:'.$pattern);
    }

    /**
     * @param  string[]  $keys
     */
    public function requiredArrayKeys(array $keys): self
    {

        return $this->addRule('required_array_keys:'.implode(',', $keys));
    }

    public function requiredIf(string $otherField, string $value): self
    {

        return $this->addRule('required_if:'.$otherField.','.$value);
    }

    public function requiredUnless(string $otherField, string $value): self
    {

        return $this->addRule('required_unless:'.$otherField.','.$value);
    }

    public function requiredWith(string $otherField): self
    {

        return $this->addRule('required_with:'.$otherField);
    }

    public function requiredWithout(string $otherField): self
    {

        return $this->addRule('required_without:'.$otherField);
    }

    public function requiredWithoutAll(string $otherField, string $value): self
    {

        return $this->addRule('required_without_all:'.$otherField.','.$value);
    }

    public function same(string $field): self
    {

        return $this->addRule('same:'.$field);
    }

    public function startsWith(string $value): self
    {

        return $this->addRule('starts_with:'.$value);
    }

    public function prohibitedIf(string $otherField, string $value): self
    {

        return $this->addRule('prohibited_if:'.$otherField.','.$value);
    }

    // /
    // /
    // /
    // /
    /**
     * @param  string[]  $allowedHtmlTags
     */
    public function stripTags(array $allowedHtmlTags = []): self
    {
        $this->rules[] = function ($attribute, $value, $fail) use ($allowedHtmlTags) {
            if (! is_string($value)) {
                return; // only check strings
            }

            // Keep only allowedHtmlTags tags
            $clean = strip_tags($value, '<'.implode('><', $allowedHtmlTags).'>');

            // If cleaned string != original, then it contained disallowed tags
            if ($clean !== $value) {
                $fail("The {$attribute} contains disallowed HTML tags.");
            }
        };

        return $this;
    }

    /**
     * @param  string[]  $allowedHtmlTags
     */
    public function sanitizeXss(array $allowedHtmlTags = []): self
    {
        $this->rules[] = function ($attribute, $value, $fail) use ($allowedHtmlTags) {
            if (! is_string($value)) {
                return;
            }

            // Step 1: strip disallowed tags
            $clean = strip_tags($value, '<'.implode('><', $allowedHtmlTags).'>');

            // Step 2: remove script-like things (case-insensitive)
            $patterns = [
                '/<script\b[^>]*>(.*?)<\/script>/is',   // <script>...</script>
                '/on\w+\s*=\s*"[^"]*"/i',              // onClick="..."
                '/on\w+\s*=\s*\'[^\']*\'/i',           // onClick='...'
                '/javascript\s*:/i',                   // href="javascript:..."
                '/alert\s*\(.*?\)/i',                  // alert( ... )
            ];

            $dangerous = false;
            foreach ($patterns as $pattern) {
                if (preg_match($pattern, $clean)) {
                    $dangerous = true;
                    $clean = preg_replace($pattern, '', $clean);
                }
            }

            // Step 3: compare cleaned vs original
            if ($clean !== $value || $dangerous) {
                $fail("The {$attribute} contains disallowed or unsafe content.");
            }
        };

        return $this;
    }

    public function maxYear(int $year): self
    {
        $maxYear = $year;
        $this->rules[] = 'integer';
        $this->rules[] = 'digits:4';
        $this->rules[] = 'max:'.$maxYear;

        return $this;
    }

    public function minYear(int $year): self
    {
        $minYear = $year;
        $this->rules[] = 'integer';
        $this->rules[] = 'digits:4';
        $this->rules[] = 'min:'.$minYear;

        return $this;
    }

    /**
     * Conditionally adds file validation rules only if a file is provided.
     *
     * This is useful when the field is marked as nullable — if no file is passed,
     * the rule is skipped to avoid unnecessary validation errors.
     *
     * Example:
     *   ChainRule::make()
     *       ->nullable()
     *       ->skipFileIfNo($request->file('image'))
     *       ->skipImageIfNo($request->file('image'))
     *       ->skipMimeTypesIfNo(['image/jpeg', 'image/png'], $request->file('image'));
     *
     * ⚠️ Note: You must call ->nullable() before using these methods,
     * otherwise a LogicException will be thrown.
     *
     * @param  mixed  $file
     */
    public function skipFileIfNo($file): self
    {
        // if nullable and no file provided → skip
        if ($this->shouldSkipFile($file)) {
            return $this;
        }

        return $this->addRule('file');
    }

    /**
     * @param  mixed  $file
     */
    public function skipImageIfNo($file): self
    {
        // if nullable and no file provided → skip
        if ($this->shouldSkipFile($file)) {
            return $this;
        }

        return $this->addRule('image');
    }

    /**
     * Conditionally applies `mimes` validation only if a file is provided.
     *
     * The `mimes` rule checks the file **extension**, while `mimetypes` checks the file’s
     * actual MIME type from the uploaded content. Use `mimes` when you want to allow
     * files by their common extensions (e.g., jpg, png, pdf).
     *
     * Example:
     *   ChainRule::make()
     *       ->nullable()
     *       ->skipMimesIfNo(['jpg', 'png', 'pdf'], $request->file('document'));
     *
     * @param  array<string>  $arrayValues  Allowed file extensions.
     *                                      Common examples:
     *                                      - Images: ['jpg', 'jpeg', 'png', 'gif', 'webp']
     *                                      - Documents: ['pdf', 'doc', 'docx', 'txt']
     *                                      - Spreadsheets: ['xls', 'xlsx', 'csv']
     *                                      - Archives: ['zip', 'rar', '7z']
     * @param  mixed|null  $file  The uploaded file instance or null
     */
    public function skipMimesIfNo(array $arrayValues, $file): self
    {
        if ($this->shouldSkipFile($file)) {
            return $this;
        }

        return $this->addRule('mimes:'.implode(',', $arrayValues));
    }

    /**
     * Conditionally applies `mimetypes` validation only if a file is provided.
     *
     * Use this when the field is nullable — if no file is uploaded, the rule is skipped.
     *
     * Example:
     *   ChainRule::make()
     *       ->nullable()
     *       ->skipMimeTypesIfNo(['image/jpeg', 'image/png'], $request->file('avatar'));
     *
     * @param  array<string>  $arrayValues  Allowed MIME types.
     *                                      Common examples:
     *                                      - Images: ['image/jpeg', 'image/png', 'image/gif', 'image/webp']
     *                                      - Documents: ['application/pdf', 'application/msword',
     *                                      'application/vnd.openxmlformats-officedocument.wordprocessingml.document']
     *                                      - Spreadsheets: ['application/vnd.ms-excel',
     *                                      'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']
     * @param  mixed|null  $file  The uploaded file instance or null
     */
    public function skipMimeTypesIfNo(array $arrayValues, $file): self
    {
        if ($this->shouldSkipFile($file)) {
            return $this;
        }

        return $this->addRule('mimetypes:'.implode(',', $arrayValues));
    }

    /**
     * @param  mixed  $file
     *
     * @throws \LogicException
     */
    protected function shouldSkipFile($file): bool
    {
        // if developer forgot nullable but still using skip method
        if (! in_array('nullable', $this->rules, true)) {
            throw new \LogicException(
                'You must call ->nullable() before using ->skipImageIfEmpty().'
            );
        }

        return empty($file);
    }
}
