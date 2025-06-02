<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Opis\JsonSchema\Errors\ErrorFormatter;
use Opis\JsonSchema\Validator;

class JsonSchemaValidator
{
    protected Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();
        $resolver = $this->validator->loader()->resolver();
        $resolver->registerPrefix(
            'http://example.com/schemas',
            resource_path('schemas') . DIRECTORY_SEPARATOR
        );
        Log::info(resource_path('schemas') . DIRECTORY_SEPARATOR);
    }


    /**
     * @param array $data - JSON data to validate
     * @param string $schemaId - The URI $id of the schema
     * @return array|null - Errors if any
     */
    public function validate(array $data, string $schemaId): array|null
    {
        $jsonData = json_decode(json_encode($data));

        $result = $this->validator->validate($jsonData, $schemaId);

        if ($result->isValid()) {
            return null;
        } else {
            $error = $result->error();
            $formatter = new ErrorFormatter();
            return $formatter->format($error, false);
        }
    }

    /**
     * Format errors into readible JSON
     *
     * @param array $errors - Array of error returned from validation
     * @return array
     */
    protected function formatErrors(array $errors): array

    {
        $messages = [];
        foreach ($errors as $error) {
            $path = implode('.', $error->dataPointer() ?? []);
            $messages[] = "{$path}: {$error->keyword()}";
        }

        return $messages;
    }
}
