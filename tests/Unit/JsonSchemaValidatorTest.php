<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\JsonSchemaValidator;

class JsonSchemaValidatorTest extends TestCase
{
    protected JsonSchemaValidator $validator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = new JsonSchemaValidator();
    }

    public function test_valid_data_passes_validation()
    {
        $data = [
            "title" => "Test",
            "priority" => "low",
            "complaint" => "test"
        ];

        $errors = $this->validator->validate($data, 'http://example.com/schemas/dispute-content.schema.json');

        $this->assertNull($errors);
    }

    public function test_missing_required_field_fails_validation()
    {
        $data = [

            "priority" => "low",
            "complaint" => "test"
        ];

        $errors = $this->validator->validate($data, 'http://example.com/schemas/dispute-content.schema.json');

        $this->assertIsArray($errors);
        $this->assertNotEmpty($errors);
        $this->assertStringContainsString('title', $errors['/']);
    }

    public function test_invalid_type_fails_validation()
    {
        $data = [
            "title" => 123,
            "priority" => "low",
            "complaint" => "test"

        ];

        $errors = $this->validator->validate($data, 'http://example.com/schemas/dispute-content.schema.json');

        $this->assertIsArray($errors);
        $this->assertNotEmpty($errors);
        $this->assertStringContainsString('integer', $errors['/title']);
    }
}
