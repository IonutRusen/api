<?php

declare(strict_types=1);

use Illuminate\Http\JsonResponse;

if ( ! function_exists('sendApiResponse')) {
    function sendApiResponse($error, $data, $message, $status = 200): JsonResponse
    {
        if ($message instanceof Illuminate\Support\MessageBag) {
            $message = $message->all();
            $message = implode(' ', $message);
        } elseif (is_array($message)) {
            $message = collect($message)->flatten()->implode(' ');
        }

        $response = [
            'success' => ! $error,
            'status' => $status,
            'error' => $error,
            'message' => is_array($message) ? implode(' ', extractErrorMessages($message)) : $message,
            'data' => $error ? null : $data,

        ];

        return response()->json($response, $status);
    }
}
if ( ! function_exists('extractErrorMessages')) {
    function extractErrorMessages($messages): array
    {
        $errors = [];

        if (is_array($messages)) {
            foreach ($messages as $message) {
                if (is_string($message)) {
                    $errors[] = $message;
                } else {
                    $errors = array_merge($errors, extractErrorMessages($message));
                }
            }
        }

        return $errors;
    }
}
